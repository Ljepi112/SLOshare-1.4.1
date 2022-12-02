<?php

namespace App\Http\Controllers;

use App\Models\BlacklistClient;
use App\Models\Group;
use App\Models\Internal;
use App\Models\Page;

/**
 * @see \Tests\Todo\Feature\Http\Controllers\PageControllerTest
 */
class PageController extends Controller
{
    /**
     * Display All Pages.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $pages = Page::all();

        return \view('page.index', ['pages' => $pages]);
    }

    /**
     * Show A Page.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $page = Page::findOrFail($id);

        return \view('page.page', ['page' => $page]);
    }

    /**
     * Show Staff Page.
     */
    public function staff(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $staff = Group::query()
            ->with('users:id,username,group_id,title')
            ->where('is_modo', '=', 2)
            ->orWhere('is_admin', '=', 1)
            ->get()
            ->sortByDesc('position');

        return \view('page.staff', ['staff' => $staff]);
    }

    /**
     * Show User Page.
     */
    public function users(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $users = Group::with('users:id,username,group_id,title')->where('id', '=', 5)->get()->sortByDesc('position');

        return \view('page.users', ['users' => $users]);
    }

    /**
     * Show Internals Page.
     */
    public function internal(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $internals = Internal::query()
            ->with('users')
            ->get()
            ->sortBy('name');

        return \view('page.internal', ['internals' => $internals]);
    }

    /**
     * Show Client-Blacklist Page.
     */
    public function clientblacklist(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $clients = BlacklistClient::all();

        return \view('page.blacklist.client', ['clients' => $clients]);
    }

    /**
     * Show About Us Page.
     */
    public function about(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('page.aboutus');
    }

    /**
     * Show About FAQ.
     */
    public function faqs(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('page.faq');
    }

    /**
     * Show About Pravilnik.
     */
    public function policys(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('page.policy');
    }

    /**
     * Show About Navodila za nalaganje.
     */
    public function instructions(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('page.instruction');
    }

    /**
     * Show About Pravni Pouk.
     */
    public function legals(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('page.legal');
    }

    /**
     * Show About Pogoji Uporabe.
     */
    public function conditionsofuses(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('page.conditionsofuse');
    }

    /**
     * Show About Donacije.
     */
    public function donationslos(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('page.donationslo');
    }

    /**
     * Show About Chat.
     */
    public function chat(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('page.chat');
    }
}
