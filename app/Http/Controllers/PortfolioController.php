<?php

namespace App\Http\Controllers;

use App\Repositories\MenusRepository;
use App\Repositories\PortfoliosRepository;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Menu;

class PortfolioController extends SiteController
{
    public function __construct(PortfoliosRepository $p_rep)
    {
        parent::__construct(new MenusRepository(new Menu));

        $this->bar = 'no';
        $this->p_rep = $p_rep;

        $this->template = config('config.theme') . '.portfolios';
    }

    public function index($alias = null)
    {
        $theme = config('config.theme');

        $portfolios = $this->getPortfolios();
        $content = view($theme . '.portfoliosContent')->with('portfolios', $portfolios)->render();
        $this->vars = array_add($this->vars, 'content', $content);

        $this->heads['title'] = 'Портфолио';
        $this->heads['keywords'] = 'Портфолио, корпоративный сайт';
        $this->heads['descr'] = 'Портфолио на корпроативном сайте';

        return $this->renderOutput();
    }

    private function getPortfolios()
    {
        $portfolios = $this->p_rep->get('*', false, true);

        return $portfolios;
    }
}
