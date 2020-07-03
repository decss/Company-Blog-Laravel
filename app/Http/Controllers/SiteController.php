<?php

namespace App\Http\Controllers;

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
    protected $contentRightBar  = false;
    protected $contentLeftBar   = false;

    public function __construct()
    {
    }

    protected function renderOutput()
    {
        $navigation = view(config('config.theme') . '.navigation')->render();
        $this->vars = array_add($this->vars, 'navigation', $navigation);
        return view($this->template)->with($this->vars);
    }


}
