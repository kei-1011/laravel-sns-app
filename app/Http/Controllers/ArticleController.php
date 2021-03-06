<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::all()->sortByDesc('created_at');

        return view('articles.index', ['articles' => $articles]);
    }

    // 記事作成画面
    public function create()
    {
        return view('articles.create');
    }

    /**
     * 記事作成
     */
    public function store(ArticleRequest $request, Article $article)
    {
        $article->title = $request->title;
        $article->body = $request->body;
        $article->user_id = $request->user()->id;
        $article->save();
        return redirect()->route('articles.index');
    }

    /**
     * 記事更新画面
     */
    public function edit(Article $article)
    {
        return view('articles.edit', ['article' => $article]);
    }

    /**
     * 記事更新
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->title = $request->title;
        $article->body = $request->body;
        $article->save();
        return redirect()->route('articles.index');
    }

    /**
     * 記事削除
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index');
    }

    /**
     * 記事詳細画面
     */
    public function show(Article $article)
    {
        return view('articles.show', ['article' => $article]);
    }
}
