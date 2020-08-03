<?php


namespace App\Repositories;

use App\Article;
use Config;
use Gate;
use Intervention\Image\Facades\Image;


class ArticlesRepository extends Repository
{
    public function __construct(Article $article)
    {
        $this->model = $article;
    }

    public function one($alias, $withComments = false)
    {
        $article = parent::one($alias);

        if ($article && $withComments) {
            $article->load('comments');
            $article->comments->load('user');
        }

        return $article;
    }

    public function addArticle($request)
    {
        if (Gate::denies('save', $this->model)) {
            abort(403);
        }

        $data = $request->except('_token', 'image');
        if (empty($data)) {
            return array('error' => 'Нет данных');
        }

        if (empty($data['alias'])) {
            $data['alias'] = str_slug($data['title']);
        }

        if ($this->one($data['alias'], FALSE)) {
            $request->merge(array('alias' => $data['alias']));
            $request->flash();

            return ['error' => 'Данный псевдоним уже успользуется'];
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');

            if ($image->isValid()) {

                $str = str_random(8);

                $obj = new \stdClass;

                $obj->mini = $str . '_mini.jpg';
                $obj->max = $str . '_max.jpg';
                $obj->path = $str . '.jpg';

                $img = Image::make($image);

                $img->fit(Config::get('config.image')['width'],
                    Config::get('config.image')['height'])->save(public_path() . '/' . config('config.theme') . '/images/articles/' . $obj->path);

                $img->fit(Config::get('config.articles_img')['max']['width'],
                    Config::get('config.articles_img')['max']['height'])->save(public_path() . '/' . config('config.theme') . '/images/articles/' . $obj->max);

                $img->fit(Config::get('config.articles_img')['mini']['width'],
                    Config::get('config.articles_img')['mini']['height'])->save(public_path() . '/' . config('config.theme') . '/images/articles/' . $obj->mini);


                $data['img'] = json_encode($obj);

                $this->model->fill($data);

                if ($request->user()->articles()->save($this->model)) {
                    return ['status' => 'Материал добавлен'];
                }
            }

        }

    }
}