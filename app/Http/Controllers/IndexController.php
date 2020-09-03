<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Repositories\ArticlesRepository;
use App\Repositories\MenusRepository;
use App\Repositories\PortfoliosRepository;
use App\Repositories\SlidersRepository;
use Illuminate\Http\Request;
use Config;

use App\Http\Requests;
use Illuminate\Support\Arr;

class IndexController extends SiteController
{
    public function __construct(SlidersRepository $s_rep, PortfoliosRepository $p_rep, ArticlesRepository $a_rep)
    {
        parent::__construct(new MenusRepository(new Menu));

        $this->s_rep = $s_rep;
        $this->p_rep = $p_rep;
        $this->a_rep = $a_rep;

        $this->bar = 'right';
        $this->template = config('config.theme') . '.index';
    }


    public function index()
    {
        $theme = config('config.theme');

        $slidersItems = $this->getSliders();
        $sliders = view($theme . '.slider')->with('sliders', $slidersItems)->render();
        $this->vars = Arr::add($this->vars, 'sliders', $sliders);

        $portfoliosItems = $this->getPortfolios();
        $portfolios = view($theme . '.content')->with('portfolios', $portfoliosItems)->render();
        $this->vars = Arr::add($this->vars, 'content', $portfolios);

        $articles = $this->getArticles();
        $this->contentRightBar = view($theme . '.indexBar')->with('articles', $articles)->render();

        $this->heads['title'] = 'Главная страница';
        $this->heads['keywords'] = 'Главная страница, корпоративный сайт';
        $this->heads['descr'] = 'Главная страница корпроативного сайта';

        return $this->renderOutput();
    }

    private function getSliders()
    {
        $sliders = $this->s_rep->get();

        if ($sliders->isEmpty()) {
            return false;
        }

        // Map for each $sliders element
        $sliders->transform(function ($item, $key) {
            $item->img = Config::get('config.sliderPath') . '/' . $item->img;
            return $item;
        });

        return $sliders;
    }

    private function getPortfolios()
    {
        $portfolios = $this->p_rep->get('*', Config::get('config.indexPortfolioCount'));

        return $portfolios;
    }

    private function getArticles()
    {
        $articles = $this->a_rep->get(['title', 'created_at', 'img', 'alias'], Config::get('config.indexArticlesCount'));

        return $articles;
    }

    public function create()
    {
        //
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
