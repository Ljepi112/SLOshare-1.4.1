<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Category;
use App\Models\PersonalFreeleech;
use App\Models\Torrent;
use Illuminate\Http\Request;

/**
 * @see \Tests\Feature\Http\Controllers\CategoryControllerTest
 */
class CategoryController extends Controller
{
    /**
     * Display All Categories.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $categories = Category::withCount('torrents')->get()->sortBy('position');

        return \view('category.index', ['categories' => $categories]);
    }

    /**
     * Show A Category.
     *
     * @param \App\Models\Category $id
     */
    public function show(Request $request, $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $user = $request->user();
        $category = Category::select(['id', 'name'])->findOrFail($id);
        $torrents = Torrent::with(['user', 'category', 'type'])->withCount(['thanks', 'comments'])->where('category_id', '=', $id)->orderBy('sticky', 'desc')->latest()->paginate(25);
        $personalFreeleech = PersonalFreeleech::where('user_id', '=', $user->id)->first();
        $bookmarks = Bookmark::where('user_id', $user->id)->get();

        return \view('category.show', [
            'torrents'           => $torrents,
            'user'               => $user,
            'category'           => $category,
            'personal_freeleech' => $personalFreeleech,
            'bookmarks'          => $bookmarks,
        ]);
    }
}
