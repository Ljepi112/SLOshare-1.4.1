<?php

namespace App\Jobs;

use App\Models\Cast;
use App\Models\Company;
use App\Models\Crew;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\GuestStar;
use App\Models\Network;
use App\Models\Person;
use App\Models\Recommendation;
use App\Models\Season;
use App\Models\Cartoontv;
use App\Services\Tmdb\Client;
use App\Services\Tmdb\TMDB;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ProcessCartoontvJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * ProcessCartoontvJob Constructor.
     */
    public function __construct(public $cartoontv, public $id)
    {
    }

    public function handle(): void
    {
        $tmdb = new TMDB();

        foreach ($this->cartoontv['production_companies'] as $productionCompany) {
            if (isset($productionCompany['name'])) {
                $productionCompanyArray = [
                    'description'    => $tmdb->ifExists('description', $productionCompany),
                    'name'           => $productionCompany['name'],
                    'headquarters'   => $tmdb->ifExists('headquarters', $productionCompany),
                    'homepage'       => $tmdb->ifExists('homepage', $productionCompany),
                    'logo'           => $tmdb->image('logo', $productionCompany),
                    'origin_country' => $tmdb->ifExists('origin_country', $productionCompany),
                ];
                Company::updateOrCreate(['id' => $productionCompany['id']], $productionCompanyArray)->cartoontv()->syncWithoutDetaching([$this->cartoontv['id']]);
            }
        }

        foreach ($this->cartoontv['created_by'] as $person) {
            if (isset($person['id'])) {
                Person::updateOrCreate(['id' => $person['id']], $tmdb->person_array($person))->cartoontv()->syncWithoutDetaching([$this->id]);
            }
        }

        foreach ($this->cartoontv['networks'] as $network) {
            $client = new Client\Network($network['id']);
            $network = $client->getData();
            if (isset($network['name'])) {
                if (isset($network['images']['logos'][0]) && \array_key_exists('file_path', $network['images']['logos'][0])) {
                    $logo = 'https://image.tmdb.org/t/p/original'.$network['images']['logos'][0]['file_path'];
                } else {
                    $logo = null;
                }

                $networkArray = [
                    'headquarters'   => $tmdb->ifExists('headquarters', $network),
                    'homepage'       => $tmdb->ifExists('homepage', $network),
                    'logo'           => $logo,
                    'name'           => $network['name'],
                    'origin_country' => $network['origin_country'],
                ];
                Network::updateOrCreate(['id' => $network['id']], $networkArray)->cartoontv()->syncWithoutDetaching([$this->id]);
            }
        }

        foreach ($this->cartoontv['genres'] as $genre) {
            if (isset($genre['name'])) {
                Genre::updateOrCreate(['id' => $genre['id']], $genre)->cartoontv()->syncWithoutDetaching([$this->id]);
            }
        }

        if (isset($this->cartoontv['credits']['cast'])) {
            foreach ($this->cartoontv['credits']['cast'] as $cast) {
                Cast::updateOrCreate(['id' => $cast['id']], $tmdb->cast_array($cast))->cartoontv()->syncWithoutDetaching([$this->cartoontv['id']]);
                Person::updateOrCreate(['id' => $cast['id']], $tmdb->person_array($cast))->cartoontv()->syncWithoutDetaching([$this->cartoontv['id']]);
            }
        }

        if (isset($this->cartoontv['credits']['crew'])) {
            foreach ($this->cartoontv['credits']['crew'] as $crew) {
                Crew::updateOrCreate(['id' => $crew['id']], $tmdb->person_array($crew))->cartoontv()->syncWithoutDetaching([$this->cartoontv['id']]);
            }
        }

        foreach ($this->cartoontv['seasons'] as $season) {
            $client = new Client\Season($this->id, \sprintf('%02d', $season['season_number']));
            $season = $client->getData();
            if (isset($season['season_number'])) {
                $seasonArray = [
                    'air_date'      => $tmdb->ifExists('air_date', $season),
                    'poster'        => $tmdb->image('poster', $season),
                    'name'          => $tmdb->ifExists('name', $season),
                    'overview'      => $tmdb->ifExists('overview', $season),
                    'season_number' => \sprintf('%02d', $season['season_number']),
                    'cartoontv_id'  => $this->id,
                ];

                Season::updateOrCreate(['id' => $season['id']], $seasonArray)->cartoontv();

                foreach ($season['episodes'] as $episode) {
                    $client = new Client\Episode($this->id, \sprintf('%02d', $season['season_number']), $episode['episode_number']);
                    $episode = $client->getData();
                    if (isset($episode['episode_number'])) {
                        $episodeArray = [
                            'cartoontv_id'    => $this->id,
                            'air_date'        => $tmdb->ifExists('air_date', $episode),
                            'name'            => Str::limit($tmdb->ifExists('name', $episode), 200),
                            'episode_number'  => \sprintf('%02d', $episode['episode_number']),
                            'overview'        => $tmdb->ifExists('overview', $episode),
                            'still'           => $tmdb->image('still', $episode),
                            'production_code' => $episode['production_code'],
                            'season_number'   => \sprintf('%02d', $episode['season_number']),
                            'vote_average'    => $episode['vote_average'],
                            'vote_count'      => $episode['vote_count'],
                            'season_id'       => $season['id'],
                        ];

                        Episode::updateOrCreate(['id' => $episode['id']], $episodeArray)->season();

                        foreach ($episode['credits']['guest_stars'] as $person) {
                            if (isset($person['id'])) {
                                GuestStar::updateOrCreate(['id' => $person['id']], $tmdb->person_array($person))->episode()->syncWithoutDetaching([$episode['id']]);
                                Person::updateOrCreate(['id' => $person['id']], $tmdb->person_array($person))->cartoontv()->syncWithoutDetaching([$this->id]);
                            }
                        }
                    }
                }

                foreach ($season['credits']['cast'] as $person) {
                    if (isset($person['id'])) {
                        Cast::updateOrCreate(['id' => $person['id']], $tmdb->cast_array($person))->season()->syncWithoutDetaching([$season['id']]);
                        Cast::updateOrCreate(['id' => $person['id']], $tmdb->cast_array($person))->cartoontv()->syncWithoutDetaching([$this->id]);
                        Person::updateOrCreate(['id' => $person['id']], $tmdb->person_array($person))->cartoontv()->syncWithoutDetaching([$this->id]);
                        $client = new Client\Person($person['id']);
                        $people = $client->getData();
                        Crew::updateOrCreate(['id' => $people['id']], $tmdb->person_array($people))->season()->syncWithoutDetaching([$season['id']]);
                    }
                }

                foreach ($season['credits']['crew'] as $crew) {
                    if (isset($crew['id'])) {
                        Crew::updateOrCreate(['id' => $crew['id']], $tmdb->person_array($crew))->season()->syncWithoutDetaching([$season['id']]);
                        Person::updateOrCreate(['id' => $crew['id']], $tmdb->person_array($crew))->cartoontv()->syncWithoutDetaching([$this->id]);
                    }
                }
            }
        }

        if (isset($this->cartoontv['recommendations'])) {
            foreach ($this->cartoontv['recommendations']['results'] as $recommendation) {
                if (Cartoontv::where('id', '=', $recommendation['id'])->count() !== 0) {
                    Recommendation::updateOrCreate(
                        ['recommendation_cartoontv_id' => $recommendation['id'], 'cartoontv_id' => $this->cartoontv['id']],
                        ['title' => $recommendation['name'], 'vote_average' => $recommendation['vote_average'], 'poster' => $tmdb->image('poster', $recommendation), 'first_air_date' => $recommendation['first_air_date']]
                    );
                }
            }
        }
    }
}
