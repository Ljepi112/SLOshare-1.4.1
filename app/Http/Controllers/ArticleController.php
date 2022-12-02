<?php

namespace App\Http\Controllers;

use App\Models\Article;

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
        $articles = Article::latest()->paginate(6);

        return \view('article.index', ['articles' => $articles]);
    }

    /**
     * Show A Article.
     */
    public function show(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    {
        $article = Article::with(['user', 'comments'])->findOrFail($id);

        return \view('article.show', ['article' => $article]);
    }
}
