<?php

namespace App\Http\Controllers\Admin;

use Gate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends AdminController
{
    public function __construct()
    {
        parent::__construct();

        $this->template = $this->theme . '.admin.index';

        if (Gate::denies('VIEW_ADMIN')) {
            abort(403);
        }
    }

    public function index()
    {
        $this->title = 'Панель администратора';

        return $this->renderOutput();
    }
}

