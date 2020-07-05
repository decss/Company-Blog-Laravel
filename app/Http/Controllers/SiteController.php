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

    protected $template;
    protected $vars;
    protected $bar = false;
    protected $contentRightBar = false;
    protected $contentLeftBar = false;

    public function __construct(MenusRepository $m_rep)
    {
        $this->m_rep = $m_rep;
    }

    protected function renderOutput()
    {
        $menuBuilder = $this->getMenu();

        $navigation = view(config('config.theme') . '.navigation')->with('menu', $menuBuilder)->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

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
