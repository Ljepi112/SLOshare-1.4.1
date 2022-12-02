<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * @see \Tests\Feature\Http\Controllers\ArticleControllerTest
 */
class ArticleController extends Controller
{
    /**
     * Display All Articles.
     */
    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $articles = Article::latest()->paginate(25);

        return \view('Staff.article.index', ['articles' => $articles]);
    }

    /**
     * Article Add Form.
     */
    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        return \view('Staff.article.create');
    }

    /**
     * Store A New Article.
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $article = new Article();
        $article->title = $request->input('title');
        $article->slug = Str::slug($article->title);
        $article->content = $request->input('content');
        $article->user_id = $request->user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'article-'.\uniqid('', true).'.'.$image->getClientOriginalExtension();
            $path = \public_path('/files/img/'.$filename);
            Image::make($image->getRealPath())->fit(75, 75)->encode('png', 100)->save($path);
            $article->image = $filename;
        } else {
            // Use Default /public/img/missing-image.png
            $article->image = null;
        }

        $v = \validator($article->toArray(), [
            'title'   => 'required',
            'slug'    => 'required',
            'content' => 'required|min:20',
            'user_id' => 'required',
        ]);

        if ($v->fails()) {
            return \to_route('staff.articles.index')
                ->withErrors($v->errors());
        }

        $article->save();

        return \to_route('staff.articles.index')
            ->withSuccess('Vaš članek je bil uspešno objavljen!');
    }

    /**
     * Article Edit Form.
     */
    public function edit(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $article = Article::findOrFail($id);

        return \view('Staff.article.edit', ['article' => $article]);
    }

    /**
     * Edit A Article.
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $article = Article::findOrFail($id);
        $article->title = $request->input('title');
        $article->slug = Str::slug($article->title);
        $article->content = $request->input('content');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'article-'.\uniqid('', true).'.'.$image->getClientOriginalExtension();
            $path = \public_path('/files/img/'.$filename);
            Image::make($image->getRealPath())->fit(75, 75)->encode('png', 100)->save($path);
            $article->image = $filename;
        } else {
            // Use Default /public/img/missing-image.png
            $article->image = null;
        }

        $v = \validator($article->toArray(), [
            'title'   => 'required',
            'slug'    => 'required',
            'content' => 'required|min:20',
        ]);

        if ($v->fails()) {
            return \to_route('staff.articles.index')
                ->withErrors($v->errors());
        }

        $article->save();

        return \to_route('staff.articles.index')
            ->withSuccess('Spremembe vašega članka so uspešno objavljene!');
    }

    /**
     * Delete A Article.
     *
     * @throws \Exception
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        $article = Article::with('comments')->findOrFail($id);
        foreach ($article->comments as $comment) {
            $comment->delete();
        }
        $article->delete();

        return \to_route('staff.articles.index')
            ->withSuccess('Članek je bil uspešno izbrisan');
    }
}
