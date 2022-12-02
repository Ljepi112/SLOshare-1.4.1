<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\HomeVideo;
use Illuminate\Http\Request;

/**
 * @see \Tests\Feature\Http\Controllers\Staff\GroupControllerTest
 */
class HomeVideoController extends Controller
{
    /**
     * Display All Blacklisted Clients.
     */
    public function index(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        \abort_unless($request->user()->group->is_modo, 403);

        $clients = HomeVideo::latest()->get();

        return \view('Staff.home.videos.index', ['clients' => $clients]);
    }

    /**
     * Home Video Edit Form.
     */
    public function edit(Request $request, int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        \abort_unless($request->user()->group->is_modo, 403);

        $client = HomeVideo::findOrFail($id);

        return \view('Staff.home.videos.edit', ['client' => $client]);
    }

    /**
     * Edit A Home Video.
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        \abort_unless($request->user()->group->is_modo, 403);

        $client = HomeVideo::findOrFail($id);
        $client->name = $request->input('name');
        $client->link = $request->input('link');

        $v = \validator($client->toArray(), [
            'name'   => 'required|string',
            'link'   => 'sometimes|string',
        ]);

        if ($v->fails()) {
            return \to_route('staff.homes.videos.index')
                ->withErrors($v->errors());
        }

        $client->save();

        return \to_route('staff.homes.videos.index')
            ->withSuccess('Odjemalec na črnem seznamu je bil uspešno posodobljen!');
    }

    /**
     * Home Video Add Form.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('Staff.home.videos.create');
    }

    /**
     * Store A New Home Video.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        \abort_unless($request->user()->group->is_admin, 403);

        $client = new HomeVideo();
        $client->name = $request->input('name');
        $client->link = $request->input('link');

        $v = \validator($client->toArray(), [
            'name'   => 'required|string|unique:home_videos',
            'link'   => 'sometimes|string',
        ]);

        if ($v->fails()) {
            return \to_route('staff.homes.videos.index')
                ->withErrors($v->errors());
        }

        $client->save();

        return \to_route('staff.homes.videos.index')
            ->withSuccess('Video na domači strani je bil uspešno shranjen!');
    }

    /**
     * Delete A Home Video.
     */
    public function destroy(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        \abort_unless($request->user()->group->is_admin, 403);

        $client = HomeVideo::findOrFail($id);
        $client->delete();

        return \to_route('staff.homes.videos.index')
            ->withSuccess('Video na domači strani je bil uspešno odstranjen!');
    }
}
