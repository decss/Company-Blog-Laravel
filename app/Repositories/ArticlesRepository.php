<?php


namespace App\Repositories;

use App\Article;
use Gate;


class ArticlesRepository extends Repository
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function one($alias, $withComments = false)
    {
        $article = parent::one($alias);

        if ($article && $withComments) {
            $article->load('comments');
            $article->comments->load('user');
        }

        return $article;
    }

    public function addArticle($request)
    {
        if (Gate::denies('save', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token', 'image');
        if (empty($data)) {
            return array('error' => 'Нет данных');
        }

        if (empty($data['alias'])) {
            $data['alias'] = str_slug($data['title']);
        }

        // dd($data);
    }
}