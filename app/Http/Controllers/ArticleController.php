<?php

namespace App\Http\Controllers;

use App\Repositories\ArticlesRepository;
use App\Repositories\CommentsRepository;
use App\Repositories\MenusRepository;
use App\Repositories\PortfoliosRepository;
use App\Menu;
use Config;

class ArticleController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep, ArticlesRepository $a_rep, CommentsRepository $c_rep)
    {
        parent::__construct(new MenusRepository(new Menu));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;
        $this->c_rep = $c_rep;

        $this->bar = 'right';
        $this->template = config('config.theme') . '.articles';
    }

    public function index()
    {
        $theme = config('config.theme');

        $articles = $this->getArticles();
        $content = view($theme . '.articlesContent')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $comments = $this->getComments(Config::get('config.recentComments'));
        $portfolios = $this->getPortfolios(Config::get('config.recentPortfolios'));
        $this->contentRightBar = view($theme . '.articlesBar')
            ->with(['comments', $comments, 'portfolios' => $portfolios])
            ->render();

        $this->heads['title'] = 'Главная страница';
        $this->heads['keywords'] = 'Главная страница, корпоративный сайт';
        $this->heads['descr'] = 'Главная страница корпроативного сайта';

        return $this->renderOutput();
    }

    private function getArticles($alias = false)
    {
        $articles = $this->a_rep->get('*', false, true);

        // Load articles related tables rows
        if ($articles) {
            // $articles->load('user', 'category', 'comments');
        }

        return $articles;
    }

    private function getComments($take)
    {
        $comments = $this->c_rep->get('*', $take);

        return $comments;
    }

    private function getPortfolios($take)
    {
        $portfolios = $this->p_rep->get('*', $take);

        return $portfolios;
    }

}
