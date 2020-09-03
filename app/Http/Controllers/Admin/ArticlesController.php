<?php

namespace App\Http\Controllers\Admin;

use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\ArticleRequest;
use App\Repositories\ArticlesRepository;
use Gate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArticlesController extends AdminController
{

    public function __construct(ArticlesRepository $a_rep)
    {
        parent::__construct();

        $this->a_rep = $a_rep;
        $this->template = $this->theme . '.admin.articles';
    }

    public function index()
    {
        $this->checkAccess('VIEW_ADMIN_ARTICLES');

        $this->title = 'Менеджер статтей';

        $articles = $this->getArticles();
        $this->content = view($this->theme . '.admin.articles_content')->with('articles', $articles)->render();

        return $this->renderOutput();
    }

    public function getArticles()
    {
        $this->checkAccess('VIEW_ADMIN_ARTICLES');

        return $this->a_rep->get();
    }

    public function create()
    {
        if (Gate::denies('save', new Article)) {
            abort(403);
        }

        $this->title = "Добавить новый материал";

        $categories = Category::select(['title', 'alias', 'parent_id', 'id'])->get();

        $lists = array();

        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $lists[$category->title] = array();
            } else {
                $lists[$categories->where('id', $category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }

        $this->content = view($this->theme . '.admin.articles_create_content')->with('categories', $lists)->render();

        return $this->renderOutput();
    }

    public function store(ArticleRequest $request)
    {
        $result = $this->a_rep->addArticle($request);

        if (is_array($result) && !empty($result['error'])) {
            return redirect('/admin/articles')->with($result);
        }

        return redirect('/admin')->with($result);
    }

    public function show($id)
    {
        //
    }

    public function edit(Article $article)
    {
        //$article = Article::where('alias', $alias);
        if (Gate::denies('edit', new Article)) {
            abort(403);
        }

        $article->img = json_decode($article->img);
        $categories = Category::select(['title', 'alias', 'parent_id', 'id'])->get();

        $lists = array();
        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $lists[$category->title] = array();
            } else {
                $lists[$categories->where('id', $category->parent_id)->first()->title][$category->id] = $category->title;
            }
        }

        $this->title = 'Реадактирование материала - ' . $article->title;
        $this->content = view($this->theme . '.admin.articles_create_content')->with(['categories' => $lists, 'article' => $article])->render();

        return $this->renderOutput();
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $result = $this->a_rep->updateArticle($request, $article);

        if (is_array($result) && !empty($result['error'])) {
            return redirect('/admin/articles')->with($result);
        }

        return redirect('/admin/articles')->with($result);
    }

    public function destroy(Article $article)
    {
        $result = $this->a_rep->deleteArticle($article);

		if(is_array($result) && !empty($result['error'])) {
			return redirect('/admin/articles')->with($result);
		}

		return redirect('/admin/articles')->with($result);
    }
}
