<?php

namespace App\Http\Controllers\Admin;

use App\Article;
use App\Category;
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

        if (Gate::denies('VIEW_ADMIN_ARTICLES')) {
            abort(403);
        }

        $this->a_rep = $a_rep;
        $this->template = $this->theme . '.admin.articles';
    }

    public function index()
    {
        $this->title = 'Менеджер статтей';

        $articles = $this->getArticles();
        $this->content = view($this->theme . '.admin.articles_content')->with('articles', $articles)->render();

        return $this->renderOutput();
    }

    public function getArticles()
    {
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

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
