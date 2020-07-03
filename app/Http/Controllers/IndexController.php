<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends SiteController
{
    public function __construct()
    {
        parent::__construct();

        $this->bar = 'right';
        $this->template = config('config.theme') . '.index';
    }


    public function index()
    {
        return $this->renderOutput();
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
