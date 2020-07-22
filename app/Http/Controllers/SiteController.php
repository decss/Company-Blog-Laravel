<?php

namespace App\Http\Controllers;

use \Menu;
use App\Repositories\MenusRepository;
use Illuminate\Http\Request;

use App\Http\Requests;

class SiteController extends Controller
{
    protected $p_rep;
    protected $s_rep;
    protected $a_rep;
    protected $m_rep;
    protected $c_rep;

    protected $heads = [
        'title' => null,
        'keywords' => null,
        'descr' => null,
    ];

    protected $template;
    protected $vars;
    protected $bar = 'right';
    protected $contentRightBar = false;
    protected $contentLeftBar = false;

    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    protected function renderOutput()
    {
        $theme = config('config.theme');
        $menuBuilder = $this->getMenu();

        $navigation = view($theme . '.navigation')->with('menu', $menuBuilder)->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        if ($this->contentRightBar) {
            $rightBar = view($theme . '.rightBar')->with('contentRightBar', $this->contentRightBar)->render();
            $this->vars = array_add($this->vars, 'rightBar', $rightBar);
        }
        if ($this->contentLeftBar) {
            $leftBar = view($theme . '.leftBar')->with('contentLeftBar', $this->contentLeftBar)->render();
            $this->vars = array_add($this->vars, 'leftBar', $leftBar);
        }
        
        $this->vars = array_add($this->vars, 'bar', $this->bar);
        $this->vars = array_add($this->vars, 'heads', $this->heads);

        $footer = view($theme . '.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        return view($this->template)->with($this->vars);
    }

    protected function getMenu()
    {
        $menu = $this->m_rep->get();
        $menuBuilder = Menu::make('MyNav', function ($mBuilder) use ($menu) {
            foreach ($menu as $item) {
                // First level menu
                if ($item->parent_id == 0) {
                    $mBuilder->add($item->title, $item->path)->id($item->id);

                    // Parent menu items
                } else {
                    if ($mBuilder->find($item->parent_id)) {
                        $mBuilder->find($item->parent_id)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });

        return $menuBuilder;
    }


}