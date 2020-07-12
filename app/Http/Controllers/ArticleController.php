<?php

namespace App\Http\Controllers;

use App\Repositories\ArticlesRepository;
use App\Repositories\MenusRepository;
use App\Repositories\PortfoliosRepository;
use App\Menu;

class ArticleController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep, ArticlesRepository $a_rep)
    {
        parent::__construct(new MenusRepository(new Menu));

        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;

        $this->bar = 'right';
        $this->template = config('config.theme') . '.articles';
    }

    public function index()
    {
        $theme = config('config.theme');

        /*
        $slidersItems = $this->getSliders();
        $sliders = view($theme . '.slider')->with('sliders', $slidersItems)->render();
        $this->vars = array_add($this->vars, 'sliders', $sliders);

        $portfoliosItems = $this->getPortfolios();
        $portfolios = view($theme . '.content')->with('portfolios', $portfoliosItems)->render();
        $this->vars = array_add($this->vars, 'content', $portfolios);

        $articles = $this->getArticles();
        $this->contentRightBar = view($theme . '.indexBar')->with('articles', $articles)->render();
        */

        $articles = $this->getArticles();
        $content = view($theme . '.articlesContent')->with('articles', $articles)->render();
        $this->vars = array_add($this->vars, 'content', $content);

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
}
