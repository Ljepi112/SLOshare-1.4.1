<?php

namespace App\Jobs;

use App\Models\Cast;
use App\Models\Collection;
use App\Models\Company;
use App\Models\Crew;
use App\Models\Genre;
use App\Models\Cartoon;
use App\Models\Person;
use App\Models\Recommendation;
use App\Services\Tmdb\Client;
use App\Services\Tmdb\TMDB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessCartoonJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * ProcessCartoonJob constructor.
     */
    public function __construct(public $cartoon)
    {
    }

    public function handle(): void
    {
        $tmdb = new TMDB();

        foreach ($this->cartoon['genres'] as $genre) {
            if (isset($genre['name'])) {
                Genre::updateOrCreate(['id' => $genre['id']], $genre)->cartoon()->syncWithoutDetaching([$this->cartoon['id']]);
            }
        }

        foreach ($this->cartoon['production_companies'] as $productionCompany) {
            $client = new Client\Company($productionCompany['id']);
            $productionCompany = $client->getData();

            if (isset($productionCompany['name'])) {
                $productionCompanyArray = [
                    'description'    => $productionCompany['description'] ?? null,
                    'headquarters'   => $productionCompany['headquarters'] ?? null,
                    'homepage'       => $productionCompany['homepage'] ?? null,
                    'logo'           => $tmdb->image('logo', $productionCompany),
                    'name'           => $productionCompany['name'] ?? null,
                    'origin_country' => $productionCompany['origin_country'],
                ];
                Company::updateOrCreate(['id' => $productionCompany['id']], $productionCompanyArray)->cartoon()->syncWithoutDetaching([$this->cartoon['id']]);
            }
        }

        if (isset($this->cartoon['belongs_to_collection']['id'])) {
            $client = new Client\Collection($this->cartoon['belongs_to_collection']['id']);
            $belongsToCollection = $client->getData();
            if (isset($belongsToCollection['name'])) {
                $titleSort = \addslashes(\str_replace(['The ', 'An ', 'A ', '"'], [''], $belongsToCollection['name']));

                $belongsToCollectionArray = [
                    'name'      => $belongsToCollection['name'] ?? null,
                    'name_sort' => $titleSort,
                    'parts'     => is_countable($belongsToCollection['parts']) ? \count($belongsToCollection['parts']) : 0,
                    'overview'  => $belongsToCollection['overview'] ?? null,
                    'poster'    => $tmdb->image('poster', $belongsToCollection),
                    'backdrop'  => $tmdb->image('backdrop', $belongsToCollection),
                ];
                Collection::updateOrCreate(['id' => $belongsToCollection['id']], $belongsToCollectionArray)->cartoon()->syncWithoutDetaching([$this->cartoon['id']]);
            }
        }

        if (isset($this->cartoon['credits']['cast'])) {
            foreach ($this->cartoon['credits']['cast'] as $cast) {
                Cast::updateOrCreate(['id' => $cast['id']], $tmdb->cast_array($cast))->cartoon()->syncWithoutDetaching([$this->cartoon['id']]);
                Person::updateOrCreate(['id' => $cast['id']], $tmdb->person_array($cast))->cartoon()->syncWithoutDetaching([$this->cartoon['id']]);
            }
        }

        if (isset($this->cartoon['credits']['crew'])) {
            foreach ($this->cartoon['credits']['crew'] as $crew) {
                Crew::updateOrCreate(['id' => $crew['id']], $tmdb->person_array($crew))->cartoon()->syncWithoutDetaching([$this->cartoon['id']]);
            }
        }

        if (isset($this->cartoon['recommendations'])) {
            foreach ($this->cartoon['recommendations']['results'] as $recommendation) {
                if (Cartoon::where('id', '=', $recommendation['id'])->count() !== 0) {
                    Recommendation::updateOrCreate(
                        ['recommendation_cartoon_id' => $recommendation['id'], 'cartoon_id' => $this->cartoon['id']],
                        ['title' => $recommendation['title'], 'vote_average' => $recommendation['vote_average'], 'poster' => $tmdb->image('poster', $recommendation), 'release_date' => $recommendation['release_date']]
                    );
                }
            }
        }
    }
}
