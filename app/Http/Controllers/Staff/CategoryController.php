<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
        $categories = Category::all()->sortBy('position');

        return \view('Staff.category.index', ['categories' => $categories]);
    }

    /**
     * Show Form For Creating A New Category.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('Staff.category.create');
    }

    /**
     * Store A Category.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->slug = Str::slug($category->name);
        $category->position = $request->input('position');
        $category->icon = $request->input('icon');
        $category->movie_meta = $request->input('movie_meta');
        $category->cartoon_meta = $request->input('cartoon_meta');
        $category->tv_meta = $request->input('tv_meta');
        $category->game_meta = $request->input('game_meta');
        $category->music_meta = $request->input('music_meta');
        $category->no_meta = $request->input('no_meta');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'category-'.\uniqid('', true).'.'.$image->getClientOriginalExtension();
            $path = \public_path('/files/img/'.$filename);
            Image::make($image->getRealPath())->fit(50, 50)->encode('png', 100)->save($path);
            $category->image = $filename;
        } else {
            $category->image = null;
        }

        $v = \validator($category->toArray(), [
            'name'          => 'required',
            'slug'          => 'required',
            'position'      => 'required',
            'icon'          => 'required',
            'movie_meta'    => 'required',
            'cartoon_meta'  => 'required',
            'tv_meta'       => 'required',
            'game_meta'     => 'required',
            'music_meta'    => 'required',
            'no_meta'       => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('staff.categories.index')
                ->withErrors($v->errors());
        }

        $category->save();

        return \to_route('staff.categories.index')
            ->withSuccess('Kategorija uspešno dodana');
    }

    /**
     * Category Edit Form.
     */
    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $category = Category::findOrFail($id);

        return \view('Staff.category.edit', ['category' => $category]);
    }

    /**
     * Update A Category.
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->slug = Str::slug($category->name);
        $category->position = $request->input('position');
        $category->icon = $request->input('icon');
        $category->movie_meta = $request->input('movie_meta');
        $category->cartoon_meta = $request->input('cartoon_meta');
        $category->tv_meta = $request->input('tv_meta');
        $category->game_meta = $request->input('game_meta');
        $category->music_meta = $request->input('music_meta');
        $category->no_meta = $request->input('no_meta');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'category-'.\uniqid('', true).'.'.$image->getClientOriginalExtension();
            $path = \public_path('/files/img/'.$filename);
            Image::make($image->getRealPath())->fit(50, 50)->encode('png', 100)->save($path);
            $category->image = $filename;
        }

        $v = \validator($category->toArray(), [
            'name'          => 'required',
            'slug'          => 'required',
            'position'      => 'required',
            'icon'          => 'required',
            'movie_meta'    => 'required',
            'cartoon_meta'  => 'required',
            'tv_meta'       => 'required',
            'game_meta'     => 'required',
            'music_meta'    => 'required',
            'no_meta'       => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('staff.categories.index')
                ->withErrors($v->errors());
        }

        $category->save();

        return \to_route('staff.categories.index')
            ->withSuccess('Kategorija uspešno spremenjena');
    }

    /**
     * Destroy A Category.
     *
     * @throws \Exception
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return \to_route('staff.categories.index')
            ->withSuccess('Kategorija uspešno izbrisana');
    }
}
