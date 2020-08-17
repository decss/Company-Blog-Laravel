<?php

namespace App\Http\Controllers\Admin;

use Auth;
use Gate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Menu;

class AdminController extends Controller
{
    protected $p_rep;
    protected $a_rep;
    protected $user;
    protected $template;
    protected $content = false;
    protected $title;
    protected $vars;
    protected $theme;

    public function __construct()
    {
        $this->user = Auth::user();

        if (!$this->user) {
            abort(403);
        }

        $this->theme = config('config.theme');
    }

    protected function renderOutput()
    {
        $this->vars = array_add($this->vars, 'title', $this->title);

        $menu = $this->getMenu();

        $navigation = view($this->theme . '.admin.navigation')->with('menu', $menu)->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);

        $footer = view($this->theme . '.admin.footer')->render();
        $this->vars = array_add($this->vars, 'footer', $footer);

        if ($this->content) {
            $this->vars = array_add($this->vars, 'content', $this->content);
        }

        return view($this->template)->with($this->vars);
    }

    private function getMenu()
    {
        return Menu::make('adminMenu', function ($menu) {

            if (Gate::allows('VIEW_ADMIN_ARTICLES')) {
                $menu->add('Статьи', array('route' => 'admin.articles.index'));
            }

            if (Gate::allows('VIEW_ADMIN_MENU')) {
                $menu->add('Меню', array('route' => 'admin.menus.index'));
            }

            // if (Gate::allows('VIEW_ADMIN_ARTICLES')) {
            //     $menu->add('Портфолио', array('route' => 'admin.articles.index'));
            // }

            // if (Gate::allows('VIEW_ADMIN_ARTICLES')) {
            //     $menu->add('Пользователи', array('route' => 'admin.articles.index'));
            // }

            if (Gate::allows('EDIT_USERS')) {
                $menu->add('Привилегии', array('route' => 'admin.permissions.index'));
            }

            $menu->add('Сайт', array('route' => 'home'));

        });
    }


}
