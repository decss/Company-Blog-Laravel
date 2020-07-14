<?php


namespace App\Repositories;

use App\Article;


class ArticlesRepository extends Repository
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function one($alias, $withComments = false)
    {
        $article = $this->model->where('alias', $alias)->first();

        if ($article && $withComments) {
            $article->load('comments');
            $article->comments->load('user');
        }

        return $article;
    }

}