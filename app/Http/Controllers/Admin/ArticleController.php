<?php

namespace App\Http\Controllers\Admin;

use App\Domain\Article\Commands\CreateArticleCommand;
use App\Domain\Article\Commands\DeleteArticleCommand;
use App\Domain\Article\Commands\UpdateArticleCommand;
use App\Domain\Article\Queries\GetAllArticlesQuery;
use App\Domain\Article\Queries\GetArticleByIdQuery;
use App\Http\Controllers\Controller;
use Domain\Article\Requests\CreateArticleRequest;
use Domain\Article\Requests\UpdateArticleRequest;

/**
 * Class ArticleController
 * @package App\Http\Controllers\Admin
 */
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = $this->dispatch(new GetAllArticlesQuery());

        return view('admin.articles.index', [
            'articles' => $articles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CreateArticleRequest $request)
    {
        $this->dispatch(new CreateArticleCommand($request));

        return redirect(route('admin.articles.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->dispatch(new GetArticleByIdQuery($id));

        return view('admin.articles.edit', [
            'article' => $article
        ]);
    }

    /**
     * @param $id
     * @param UpdateArticleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update($id, UpdateArticleRequest $request)
    {
        $this->dispatch(new UpdateArticleCommand($id, $request));

        return redirect(route('admin.articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dispatch(new DeleteArticleCommand($id));

        return redirect(route('admin.articles.index'));
    }
}
