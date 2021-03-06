<?php


namespace App\Repositories;

use App\Models\Menu;
use Config;

abstract class Repository
{
    protected $model = false;

    public function get($select = '*', $take = false, $pagination = false, $where = false)
    {
        // Get builder by calling select() on model
        $builder = $this->model->select($select);

        if ($take) {
            $builder->take($take);
        }

        if ($where) {
            $builder->where($where[0], $where[1]);
        }

        if ($pagination) {
            return $this->check($builder->paginate(Config::get('config.paginate')));
        }

        return $this->check($builder->get());
    }

    protected function check($result)
    {
        if ($result->isEmpty()) {
            return false;
        }

        $result->transform(function ($item, $key) {
            // If img fiels is really JSON string
            if (is_string($item->img)) {
                $json = json_decode($item->img);
                if (is_object($json) && json_last_error() == JSON_ERROR_NONE) {
                    $item->img = json_decode($item->img);
                }
            }
            return $item;
        });

        return $result;
    }

    public function one($alias)
    {
        $result = $this->model->where('alias', $alias)->first();

        return $result;
    }

}
