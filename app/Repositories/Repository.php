<?php


namespace App\Repositories;

use App\Menu;

abstract class Repository
{
    protected $model = false;

    public function get($select = '*', $take = false)
    {
        // Get builder by calling select() on model
        $builder = $this->model->select($select);

        if ($take) {
            $builder->take($take);
        }

        return $builder->get();
    }

}