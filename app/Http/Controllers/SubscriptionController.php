<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Subscription;
use App\Models\Topic;
use Illuminate\Http\Request;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\SubscriptionControllerTest
 */
class SubscriptionController extends Controller
{
    /**
     * Subscribe To A Topic.
     */
    public function subscribeTopic(Request $request, string $route, Topic $topic): \Illuminate\Http\RedirectResponse
    {
        $params = null;
        if ($route === 'subscriptions') {
            $logger = 'forum_subscriptions';
            $params = [];
        }

        if (! isset($logger)) {
            $logger = 'forum_topic';
            $params = ['id' => $topic->id];
        }

        if ($request->user()->subscriptions()->ofTopic($topic->id)->doesntExist()) {
            $subscription = new Subscription();
            $subscription->user_id = $request->user()->id;
            $subscription->topic_id = $topic->id;
            $subscription->save();

            return \to_route($logger, $params)
                ->withSuccess('Zdaj ste naročeni na temo, '.$topic->name.'. Zdaj boste prejemali obvestila spletnega mesta, ko boste prejeli odgovor.');
        }

        return \to_route($logger, $params)
            ->withErrors('Na to temo ste že naročeni');
    }

    /**
     * Unsubscribe To A Topic.
     */
    public function unsubscribeTopic(Request $request, string $route, Topic $topic): \Illuminate\Http\RedirectResponse
    {
        $params = null;
        if ($route === 'subscriptions') {
            $logger = 'forum_subscriptions';
            $params = [];
        }

        if (! isset($logger)) {
            $logger = 'forum_topic';
            $params = ['id' => $topic->id];
        }

        if ($request->user()->subscriptions()->ofTopic($topic->id)->exists()) {
            $subscription = $request->user()->subscriptions()->ofTopic($topic->id)->first();
            $subscription->delete();

            return \to_route($logger, $params)
                ->withSuccess('Niste več naročeni na temo, '.$topic->name.'. Ko boste prejeli odgovor, ne boste več prejemali obvestil spletnega mesta.');
        }

        return \to_route($logger, $params)
            ->withErrors('Za začetek niste naročeni na to temo...');
    }

    /**
     * Subscribe To A Forum.
     */
    public function subscribeForum(Request $request, string $route, Forum $forum): \Illuminate\Http\RedirectResponse
    {
        $params = null;
        if ($route === 'subscriptions') {
            $logger = 'forum_subscriptions';
            $params = [];
        }

        if (! isset($logger)) {
            $logger = 'forums.show';
            $params = ['id' => $forum->id];
        }

        if ($request->user()->subscriptions()->ofForum($forum->id)->doesntExist()) {
            $subscription = new Subscription();
            $subscription->user_id = $request->user()->id;
            $subscription->forum_id = $forum->id;
            $subscription->save();

            return \to_route($logger, $params)
                ->withSuccess('Zdaj ste naročeni na forum, '.$forum->name.'. Zdaj boste prejemali obvestila spletnega mesta, ko se odpre tema.');
        }

        return \to_route($logger, $params)
            ->withErrors('Na ta forum ste že prijavljeni');
    }

    /**
     * Unsubscribe To A Forum.
     */
    public function unsubscribeForum(Request $request, string $route, Forum $forum): \Illuminate\Http\RedirectResponse
    {
        $params = null;
        if ($route === 'subscriptions') {
            $logger = 'forum_subscriptions';
            $params = [];
        }

        if (! isset($logger)) {
            $logger = 'forums.show';
            $params = ['id' => $forum->id];
        }

        if ($request->user()->subscriptions()->ofForum($forum->id)->exists()) {
            $subscription = $request->user()->subscriptions()->ofForum($forum->id)->first();
            $subscription->delete();

            return \to_route($logger, $params)
                ->withSuccess('Niste več naročeni na forum, '.$forum->name.'. Ob zagonu teme ne boste več prejemali obvestil spletnega mesta.');
        }

        return \to_route($logger, $params)
            ->withErrors('Za začetek niste prijavljeni na ta forum...');
    }
}
