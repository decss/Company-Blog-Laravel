<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Filter;
use App\Http\Requests\MenusRequest;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\MenusRepository;
use App\Repositories\ArticlesRepository;
use App\Repositories\PortfoliosRepository;
use Gate;
use Illuminate\Support\Arr;
use Menu;


class MenusController extends AdminController
{

    protected $m_rep;

    public function __construct(MenusRepository $m_rep, ArticlesRepository $a_rep, PortfoliosRepository $p_rep)
    {
        parent::__construct();

        $this->m_rep = $m_rep;
        $this->a_rep = $a_rep;
        $this->p_rep = $p_rep;

        $this->template = $this->theme . '.admin.menus';
    }

    public function index()
    {
        $this->checkAccess('VIEW_ADMIN_MENU');

        $menu = $this->getMenus();
        $this->content = view($this->theme . '.admin.menus_content')->with('menus', $menu)->render();

        return $this->renderOutput();
    }

    public function getMenus()
    {
        $menu = $this->m_rep->get();

        if ($menu->isEmpty()) {
            return FALSE;
        }

        return Menu::make('forMenuPart', function ($m) use ($menu) {

            foreach ($menu as $item) {
                if ($item->parent_id == 0) {
                    $m->add($item->title, $item->path)->id($item->id);
                } else {
                    if ($m->find($item->parent_id)) {
                        $m->find($item->parent_id)->add($item->title, $item->path)->id($item->id);
                    }
                }
            }
        });
    }

    public function create()
    {
        $this->checkAccess('VIEW_ADMIN_MENU');

        $this->title = 'Новый пункт меню';

        $tmp = $this->getMenus()->roots();

        //null
        $menus = $tmp->reduce(function ($returnMenus, $menu) {
            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;
        }, ['0' => 'Родительский пункт меню']);

        $categories = Category::select(['title', 'alias', 'parent_id', 'id'])->get();

        $list = array();
        $list = Arr::add($list, '0', 'Не используется');
        $list = Arr::add($list, 'parent_id', 'Раздел блог');

        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $list[$category->title] = array();
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }

        $articles = $this->a_rep->get(['id', 'title', 'alias']);

        $articles = $articles->reduce(function ($returnArticles, $article) {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);

        $filters = Filter::select('id', 'title', 'alias')->get()->reduce(function ($returnFilters, $filter) {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent_id' => 'Раздел портфолио']);

        $portfolios = $this->p_rep->get(['id', 'alias', 'title'])->reduce(function ($returnPortfolios, $portfolio) {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);

        $this->content = view(env('THEME') . '.admin.menus_create_content')->with(['menus' => $menus, 'categories' => $list, 'articles' => $articles, 'filters' => $filters, 'portfolios' => $portfolios])->render();

        return $this->renderOutput();
    }

    public function store(MenusRequest $request)
    {
        $this->checkAccess('VIEW_ADMIN_MENU');

        $result = $this->m_rep->addMenu($request);
        if (is_array($result) && !empty($result['error'])) {
            return redirect('/admin/menus')->with($result);
        }

        return redirect('/admin/menus')->with($result);
    }

    public function show($id)
    {
        //
    }

    public function edit(\App\Menu $menu)
    {
        $this->checkAccess('VIEW_ADMIN_MENU');

        $this->title = 'Редактирование ссылки - ' . $menu->title;

        $type = FALSE;
        $option = FALSE;

        //path - http://corporate.loc/articles
        $route = app('router')->getRoutes()->match(app('request')->create($menu->path));

        $aliasRoute = $route->getName();
        $parameters = $route->parameters();

        // dump($aliasRoute);
        // dump($parameters);

        if ($aliasRoute == 'articles.index' || $aliasRoute == 'articlesCat') {
            $type = 'blogLink';
            $option = isset($parameters['cat_alias']) ? $parameters['cat_alias'] : 'parent';
        } else if ($aliasRoute == 'articles.show') {
            $type = 'blogLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';

        } else if ($aliasRoute == 'portfolios.index') {
            $type = 'portfolioLink';
            $option = 'parent';

        } else if ($aliasRoute == 'portfolios.show') {
            $type = 'portfolioLink';
            $option = isset($parameters['alias']) ? $parameters['alias'] : '';

        } else {
            $type = 'customLink';
        }


        //dd($type);
        $tmp = $this->getMenus()->roots();

        //null
        $menus = $tmp->reduce(function ($returnMenus, $menu) {

            $returnMenus[$menu->id] = $menu->title;
            return $returnMenus;

        }, ['0' => 'Родительский пункт меню']);

        $categories = Category::select(['title', 'alias', 'parent_id', 'id'])->get();

        $list = array();
        $list = Arr::add($list, '0', 'Не используется');
        $list = Arr::add($list, 'parent_id', 'Раздел блог');

        foreach ($categories as $category) {
            if ($category->parent_id == 0) {
                $list[$category->title] = array();
            } else {
                $list[$categories->where('id', $category->parent_id)->first()->title][$category->alias] = $category->title;
            }
        }

        $articles = $this->a_rep->get(['id', 'title', 'alias']);

        $articles = $articles->reduce(function ($returnArticles, $article) {
            $returnArticles[$article->alias] = $article->title;
            return $returnArticles;
        }, []);

        $filters = Filter::select('id', 'title', 'alias')->get()->reduce(function ($returnFilters, $filter) {
            $returnFilters[$filter->alias] = $filter->title;
            return $returnFilters;
        }, ['parent_id' => 'Раздел портфолио']);

        $portfolios = $this->p_rep->get(['id', 'alias', 'title'])->reduce(function ($returnPortfolios, $portfolio) {
            $returnPortfolios[$portfolio->alias] = $portfolio->title;
            return $returnPortfolios;
        }, []);

        $this->content = view(env('THEME') . '.admin.menus_create_content')->with(['menu' => $menu, 'type' => $type, 'option' => $option, 'menus' => $menus, 'categories' => $list, 'articles' => $articles, 'filters' => $filters, 'portfolios' => $portfolios])->render();

        return $this->renderOutput();
    }

    public function update(Request $request, \App\Menu $menu)
    {
        $this->checkAccess('VIEW_ADMIN_MENU');

        $result = $this->m_rep->updateMenu($request, $menu);

        if (is_array($result) && !empty($result['error'])) {
            return redirect('/admin/menus')->with($result);
        }

        return redirect('/admin/menus')->with($result);
    }

    public function destroy(\App\Menu $menu)
    {
        $this->checkAccess('VIEW_ADMIN_MENU');

        $result = $this->m_rep->deleteMenu($menu);

		if(is_array($result) && !empty($result['error'])) {
			return redirect('/admin/menus')->with($result);
		}

		return redirect('/admin/menus')->with($result);
    }
}
