<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\FeaturedTorrent;
use App\Models\Graveyard;
use App\Models\History;
use App\Models\Movie;
use App\Models\Cartoon;
use App\Models\Peer;
use App\Models\PersonalFreeleech;
use App\Models\PlaylistTorrent;
use App\Models\PrivateMessage;
use App\Models\Subtitle;
use App\Models\Torrent;
use App\Models\TorrentFile;
use App\Models\TorrentRequest;
use App\Models\Tv;
use App\Models\Cartoontv;
use App\Models\Warning;
use Livewire\Component;

class SimilarTorrent extends Component
{
    public $categoryId;

    public $tmdbId;

    public $reason;

    public $checked = [];

    public bool $selectPage = false;

    public bool $selectAll = false;

    public string $sortField = 'bumped_at';

    public string $sortDirection = 'desc';

    protected $listeners = ['destroy' => 'deleteRecords'];

    final public function updatedSelectPage($value): void
    {
        $this->checked = $value ? $this->torrents->pluck('id')->map(fn ($item) => (string) $item)->toArray() : [];
    }

    final public function selectAll(): void
    {
        $this->selectAll = true;
        $this->checked = $this->torrents->pluck('id')->map(fn ($item) => (string) $item)->toArray();
    }

    final public function updatedChecked(): void
    {
        $this->selectPage = false;
    }

    final public function isChecked($torrentId): bool
    {
        return in_array($torrentId, $this->checked);
    }

    final public function getTorrentsProperty(): \Illuminate\Support\Collection
    {
        $category = Category::findOrFail($this->categoryId);

        $query = Torrent::query();
        $query = $query->with(['user:id,username,group_id', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments']);
        if ($category->movie_meta) {
            $query = $query->whereHas('category', function ($q) {
                $q->where('movie_meta', '=', true);
            });
        }

        if ($category->cartoon_meta) {
            $query = $query->whereHas('category', function ($q) {
                $q->where('cartoon_meta', '=', true);
            });
        }

        if ($category->tv_meta) {
            $query = $query->whereHas('category', function ($q) {
                $q->where('tv_meta', '=', true);
            });
        }

        if ($category->cartoontv_meta) {
            $query = $query->whereHas('category', function ($q) {
                $q->where('cartoontv_meta', '=', true);
            });
        }

        $query = $query->where('tmdb', '=', $this->tmdbId);
        $query = $query->orderBy($this->sortField, $this->sortDirection);

        return $query->get();
    }

    final public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortField = $field;
    }

    final public function alertConfirm(): void
    {
        $torrents = Torrent::whereKey($this->checked)->pluck('name')->toArray();
        $names = $torrents;
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'    => 'OPOZORILO',
            'message' => 'Ali si prepričan?',
            'body'    => 'Če jih izbrišete, ne boste mogli obnoviti naslednjih datotek!'.\nl2br("\n")
                        .\nl2br(\implode("\n", $names)),
        ]);
    }

    final public function deleteRecords(): void
    {
        $torrents = Torrent::whereKey($this->checked)->get();
        $names = [];
        $users = [];
        $titleids = [];
        $titles = [];
        foreach ($torrents as $torrent) {
            $names[] = $torrent->name;
            foreach (History::where('torrent_id', '=', $torrent->id)->get() as $pm) {
                if (! in_array($pm->user_id, $users)) {
                    $users[] = $pm->user_id;
                }
            }

            if (! in_array($torrent->tmdb, $titleids)) {
                $titleids[] = $torrent->tmdb;
                $title = null;
                $cat = $torrent->category;
                $meta = 'none';

                if ($cat->tv_meta === 1) {
                    $meta = 'tv';
                } elseif ($cat->cartoontv_meta === 1) {
                    $meta = 'cartoontv';
                } elseif ($cat->movie_meta === 1) {
                    $meta = 'movie';
                } elseif ($cat->cartoon_meta === 1) {
                    $meta = 'cartoon';
                }

                switch ($meta) {
                    case 'movie':
                        $title = Movie::find($torrent->tmdb);
                        $titles[] = $title->title.' ('.substr($title->release_date, 0, 4).')';
                        break;
                    case 'cartoon':
                        $title = Cartoon::find($torrent->tmdb);
                        $titles[] = $title->name.' ('.substr($title->first_air_date, 0, 4).')';
                        break;
                    case 'tv':
                        $title = Tv::find($torrent->tmdb);
                        $titles[] = $title->name.' ('.substr($title->first_air_date, 0, 4).')';
                        break;
                    case 'cartoontv':
                        $title = Cartoontv::find($torrent->tmdb);
                        $titles[] = $title->name.' ('.substr($title->first_air_date, 0, 4).')';
                        break;
                    default:
                        break;
                }
            }

            // Reset Requests
            $torrentRequest = TorrentRequest::where('filled_hash', '=', $torrent->info_hash)->get();
            foreach ($torrentRequest as $req) {
                if ($req) {
                    $req->filled_by = null;
                    $req->filled_when = null;
                    $req->filled_hash = null;
                    $req->approved_by = null;
                    $req->approved_when = null;
                    $req->save();
                }
            }

            //Remove Torrent related info
            \cache()->forget(\sprintf('torrent:%s', $torrent->info_hash));
            Peer::where('torrent_id', '=', $torrent->id)->delete();
            History::where('torrent_id', '=', $torrent->id)->delete();
            Warning::where('torrent', '=', $torrent->id)->delete();
            TorrentFile::where('torrent_id', '=', $torrent->id)->delete();
            PlaylistTorrent::where('torrent_id', '=', $torrent->id)->delete();
            Subtitle::where('torrent_id', '=', $torrent->id)->delete();
            Graveyard::where('torrent_id', '=', $torrent->id)->delete();
            if ($torrent->featured === 1) {
                FeaturedTorrent::where('torrent_id', '=', $torrent->id)->delete();
            }

            $torrent->delete();
        }

        foreach ($users as $user) {
            $pmuser = new PrivateMessage();
            $pmuser->sender_id = 1;
            $pmuser->receiver_id = $user;
            $pmuser->subject = 'Torrenti v velikem obsegu izbrisani - '.\implode(', ', $titles).'! ';
            $pmuser->message = '[b]POZOR: [/b] Naslednji torrenti so bili odstranjeni z našega spletnega mesta.
            [list]
                [*]'.\implode(' [*]', $names).'
            [/list]
            Naš sistem kaže, da ste bili na omenjenem hudourniku bodisi nalagalec, sejalec ali leecher. Želeli smo vas samo obvestiti, da ga lahko varno odstranite iz svoje stranke.
                                    [b]Razlog za odstranitev: [/b] '.$this->reason.'
                                    [color=red][b]TO JE AVTOMATIZOVANO SISTEMSKO SPOROČILO, PROSIMO, NE ODGOVARAJTE![/b][/color]';
            $pmuser->save();
        }

        $this->checked = [];
        $this->selectAll = false;
        $this->selectPage = false;

        $this->dispatchBrowserEvent('swal:modal', [
            'type'    => 'USPEŠNO',
            'message' => 'Torrenti so bili uspešno izbrisani!',
            'text'    => 'Osebno sporočilo je bilo poslano vsem uporabnikom, ki so prenesli te torrente.',
        ]);
    }

    final public function deleteSingleRecord($torrentId): void
    {
        $torrent = Torrent::findOrFail($torrentId);
        $torrent->delete();
        $this->checked = array_diff($this->checked, [$torrentId]);

        $this->dispatchBrowserEvent('swal:modal', [
            'type'    => 'USPEŠNO',
            'message' => 'Torrent je uspešno izbrisan!',
            'text'    => 'Osebno sporočilo je bilo poslano vsem uporabnikom, ki so prenesli ta torrent.',
        ]);
    }

    final public function getPersonalFreeleechProperty()
    {
        return PersonalFreeleech::where('user_id', '=', \auth()->user()->id)->first();
    }

    final public function render(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return \view('livewire.similar-torrent', [
            'user'              => \auth()->user(),
            'torrents'          => $this->torrents,
            'personalFreeleech' => $this->personalFreeleech,
        ]);
    }
}
