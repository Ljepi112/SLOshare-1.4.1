<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Bookmark;
use App\Models\FeaturedTorrent;
use App\Models\FreeleechToken;
use App\Models\Group;
use App\Models\PersonalFreeleech;
use App\Models\Poll;
use App\Models\Post;
use App\Models\Topic;
use App\Models\Torrent;
use App\Models\User;
//SLOshare
//SLOshare
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\Staff\HomeControllerTest
 */
class HomeController extends Controller
{
    /**
     * Display Home Page.
     *
     * @throws \Exception
     */
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        // For Cache
        $current = Carbon::now();
        $expiresAt = $current->addMinutes(1);

        // Authorized User
        $user = $request->user();

        // Latest Articles/News Block
        $articles = \cache()->remember('latest_article', $expiresAt, fn () => Article::latest()->take(5)->get());

        // Latest Torrents Block
        $personalFreeleech = PersonalFreeleech::where('user_id', '=', $user->id)->first();

        $newest = \cache()->remember('newest_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->latest()
            ->take(5)
            ->get());

        $video = \cache()->remember('video_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('category_id', '=', 1)
            ->latest()
            ->take(20)
            ->get());

        $xxx = \cache()->remember('xxx_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('category_id', '=', 13)
            ->latest()
            ->take(20)
            ->get());

        $tvserie = \cache()->remember('tvserie_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('category_id', '=', 2)
            ->latest()
            ->take(20)
            ->get());

        $game = \cache()->remember('game_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type'])
            ->withCount(['thanks', 'comments'])
            ->where('category_id', '=', 8)
            ->latest()
            ->take(20)
            ->get());

        $applications = \cache()->remember('applications_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type'])
            ->withCount(['thanks', 'comments'])
            ->where('category_id', '=', 9)
            ->latest()
            ->take(20)
            ->get());

        $cartoones = \cache()->remember('cartoones_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('category_id', '=', 3)
            ->latest()
            ->take(20)
            ->get());

        $newsloshare = \cache()->remember('newsloshare_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->whereIn('category_id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12])
            ->latest()
            ->take(20)
            ->get());

        $slorecommended = \cache()->remember('slorecommended_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('sticky', '=', 1)
            ->latest()
            ->take(5)
            ->get());

        $videorecommended = \cache()->remember('videorecommended_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('category_id', '=', 1)
            ->where('sticky', '=', 1)
            ->latest()
            ->take(5)
            ->get());

        $seeded = \cache()->remember('seeded_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('seeders', '>=', 1)
            ->latest('seeders')
            ->take(20)
            ->get());

        $leeched = \cache()->remember('leeched_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('leechers', '>=', 1)
            ->latest('leechers')
            ->take(20)
            ->get());

        $dying = \cache()->remember('dying_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('seeders', '=', 1)
            ->where('times_completed', '>=', 1)
            ->latest('leechers')
            ->take(5)
            ->get());

        $dead = \cache()->remember('dead_torrents', $expiresAt, fn () => Torrent::with(['user', 'category', 'type', 'resolution'])
            ->withCount(['thanks', 'comments'])
            ->where('seeders', '=', 0)
            ->latest('leechers')
            ->take(5)
            ->get());

        // Latest Topics Block
        $topics = \cache()->remember('latest_topics', $expiresAt, fn () => Topic::with('forum')->latest()->take(5)->get());

        // Latest Posts Block
        $posts = \cache()->remember('latest_posts', $expiresAt, fn () => Post::with('topic', 'user')->latest()->take(5)->get());

        // Online Block
        $users = \cache()->remember('online_users', $expiresAt, fn () => User::with('group', 'privacy')
            ->withCount([
                'warnings' => function (Builder $query) {
                    $query->whereNotNull('torrent')->where('active', '1');
                },
            ])
            ->where('last_action', '>', \now()->subMinutes(5))
            ->get());

        $groups = \cache()->remember('user-groups', $expiresAt, fn () => Group::select(['name', 'color', 'effect', 'icon'])->oldest('position')->get());

        // Featured Torrents Block
        $featured = \cache()->remember('latest_featured', $expiresAt, fn () => FeaturedTorrent::with('torrent', 'user')->get());

        // Latest Poll Block
        $poll = \cache()->remember('latest_poll', $expiresAt, fn () => Poll::latest()->first());

        // Top Uploaders Block
        $uploaders = \cache()->remember('top_uploaders', $expiresAt, fn () => Torrent::with('user', 'user.group')
            ->select(DB::raw('user_id, count(*) as value'))
            ->groupBy('user_id')
            ->latest('value')
            ->take(10)
            ->get());

        $pastUploaders = \cache()->remember('month_uploaders', $expiresAt, fn () => Torrent::with('user', 'user.group')
            ->where('created_at', '>', $current->copy()->subDays(30)->toDateTimeString())
            ->select(DB::raw('user_id, count(*) as value'))
            ->groupBy('user_id')
            ->latest('value')
            ->take(10)
            ->get());

        //SLOshare
        // Total Members Count (All Groups)
        $allUser = \cache()->remember('all_user', $expiresAt, fn () => User::withTrashed()->get());
        //SLOshare

        $freeleechTokens = FreeleechToken::where('user_id', $user->id)->get();
        $bookmarks = Bookmark::where('user_id', $user->id)->get();

        return \view('home.index', [
            'user'               => $user,
            'personal_freeleech' => $personalFreeleech,
            'users'              => $users,
            'groups'             => $groups,
            'articles'           => $articles,
            'newest'             => $newest,
            'video'              => $video,
            'xxx'                => $xxx,
            'tvserie'            => $tvserie,
            'game'               => $game,
            'applications'       => $applications,
            'cartoones'          => $cartoones,
            'newsloshare'        => $newsloshare,
            'slorecommended'     => $slorecommended,
            'videorecommended'   => $videorecommended,
            'seeded'             => $seeded,
            'dying'              => $dying,
            'leeched'            => $leeched,
            'dead'               => $dead,
            'topics'             => $topics,
            'posts'              => $posts,
            'featured'           => $featured,
            'poll'               => $poll,
            'uploaders'          => $uploaders,
            'past_uploaders'     => $pastUploaders,
            'freeleech_tokens'   => $freeleechTokens,
            'bookmarks'          => $bookmarks,
            //SLOshare
            'all_user'          => $allUser,
            //SLOshare
        ]);
    }
}
