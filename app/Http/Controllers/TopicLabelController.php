<?php

namespace App\Http\Controllers;

use App\Models\Topic;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\TopicLabelControllerTest
 */
class TopicLabelController extends Controller
{
    /**
     * Apply/Remove Approved Label.
     */
    public function approve(int $id): \Illuminate\Http\RedirectResponse
    {
        $topic = Topic::findOrFail($id);
        $topic->approved = $topic->approved == 0 ? '1' : '0';
        $topic->save();

        return \to_route('forum_topic', ['id' => $topic->id])
            ->withInfo(\trans('forum.info-message'));
    }

    /**
     * Apply/Remove Denied Label.
     */
    public function deny(int $id): \Illuminate\Http\RedirectResponse
    {
        $topic = Topic::findOrFail($id);
        $topic->denied = $topic->denied == 0 ? '1' : '0';
        $topic->save();

        return \to_route('forum_topic', ['id' => $topic->id])
            ->withInfo(\trans('forum.info-message'));
    }

    /**
     * Apply/Remove Solved Label.
     */
    public function solve(int $id): \Illuminate\Http\RedirectResponse
    {
        $topic = Topic::findOrFail($id);
        $topic->solved = $topic->solved == 0 ? '1' : '0';
        $topic->save();

        return \to_route('forum_topic', ['id' => $topic->id])
            ->withInfo(\trans('forum.info-message'));
    }

    /**
     * Apply/Remove Invalid Label.
     */
    public function invalid(int $id): \Illuminate\Http\RedirectResponse
    {
        $topic = Topic::findOrFail($id);
        $topic->invalid = $topic->invalid == 0 ? '1' : '0';
        $topic->save();

        return \to_route('forum_topic', ['id' => $topic->id])
            ->withInfo(\trans('forum.info-message'));
    }

    /**
     * Apply/Remove Bug Label.
     */
    public function bug(int $id): \Illuminate\Http\RedirectResponse
    {
        $topic = Topic::findOrFail($id);
        $topic->bug = $topic->bug == 0 ? '1' : '0';
        $topic->save();

        return \to_route('forum_topic', ['id' => $topic->id])
            ->withInfo(\trans('forum.info-message'));
    }

    /**
     * Apply/Remove Suggestion Label.
     */
    public function suggest(int $id): \Illuminate\Http\RedirectResponse
    {
        $topic = Topic::findOrFail($id);
        $topic->suggestion = $topic->suggestion == 0 ? '1' : '0';
        $topic->save();

        return \to_route('forum_topic', ['id' => $topic->id])
            ->withInfo(\trans('forum.info-message'));
    }

    /**
     * Apply/Remove Implemented Label.
     */
    public function implement(int $id): \Illuminate\Http\RedirectResponse
    {
        $topic = Topic::findOrFail($id);
        $topic->implemented = $topic->implemented == 0 ? '1' : '0';
        $topic->save();

        return \to_route('forum_topic', ['id' => $topic->id])
            ->withInfo(\trans('forum.info-message'));
    }
}
