<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\MenusRepository;
use App\Repositories\ArticlesRepository;
use App\Repositories\PortfoliosRepository;
use Gate;
use Menu;


class MenusController extends AdminController
{

    protected $m_rep;

    public function __construct(MenusRepository $m_rep, ArticlesRepository $a_rep, PortfoliosRepository $p_rep)
    {
        parent::__construct();

        if(Gate::denies('VIEW_ADMIN_MENU')) {
			abort(403);
		} 
        
        $this->m_rep = $m_rep;
        $this->a_rep = $a_rep;
        $this->p_rep = $p_rep;
        
        $this->template = $this->theme.'.admin.menus';
    }
    
    public function index()
    {
        $menu = $this->getMenus();
        $this->content = view($this->theme.'.admin.menus_content')->with('menus',$menu)->render();
        
        return $this->renderOutput();
    }
    
    public function getMenus()
    {
        $menu = $this->m_rep->get();
        
        if($menu->isEmpty()) {
			return FALSE;
		}
		
		return Menu::make('forMenuPart', function($m) use($menu) {
			
			foreach($menu as $item) {
				if($item->parent == 0) {
					$m->add($item->title,$item->path)->id($item->id);
				}
				
				else {
					if($m->find($item->parent)) {
						$m->find($item->parent)->add($item->title,$item->path)->id($item->id);
					}
				}
			}
		});
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
