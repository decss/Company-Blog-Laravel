<?php


namespace App\Repositories;

use App\Menu;

abstract class Repository
{
    protected $model = false;

    public function get()
    {
        // Get builder by calling select() on model
        $builder = $this->model->select('*');

        return $builder->get();
    }

}