<?php

namespace App\Http\Controllers;

use App\Repositories\MenusRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Menu;
use Illuminate\Support\Arr;

class PortfolioController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep)
    {
        parent::__construct(new MenusRepository(new Menu));

        $this->bar = 'no';
        $this->p_rep = $p_rep;

        $this->heads['title'] = 'Портфолио';
        $this->heads['keywords'] = 'Портфолио, корпоративный сайт';
        $this->heads['descr'] = 'Портфолио на корпроативном сайте';
        $this->template = config('config.theme') . '.portfolios';
    }

    public function index($alias = null)
    {
        $theme = config('config.theme');

        $portfolios = $this->getPortfolios();
        $content = view($theme . '.portfoliosContent')->with('portfolios', $portfolios)->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        return $this->renderOutput();
    }

    public function show($alias)
    {
        $theme = config('config.theme');

        $portfolio = $this->p_rep->one($alias);
        $portfolios = $this->getPortfolios(config('config.portfoliosCount'), false);

        $content = view($theme . '.portfolioContent')->with(['portfolio' => $portfolio, 'portfolios' => $portfolios])->render();
        $this->vars = Arr::add($this->vars, 'content', $content);

        $this->heads['title'] = $portfolio->title;

        return $this->renderOutput();
    }

    private function getPortfolios($take = false, $paginate = true)
    {
        $portfolios = $this->p_rep->get('*', $take, $paginate);
        if ($portfolios) {
            $portfolios->load('filter');
        }

        return $portfolios;
    }
}
