<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class ArticleRequest extends Request
{

    public function authorize()
    {
        return Auth::user()->canDo('ADD_ARTICLES');
    }

    protected function getValidatorInstance()
    {
        $validator = parent::getValidatorInstance();
        $validator->sometimes('alias', 'unique:articles|max:255', function ($input) {
            if ($this->route()->hasParameter('article')) {
                $model = $this->route()->parameter('article');

                // Ignore article uniq alias for self
                return ($model->alias !== $input->alias)  && !empty($input->alias);
            }
            return !empty($input->alias);
        });

        return $validator;
    }

    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'text' => 'required',
            'category_id' => 'required|integer'
        ];
    }
}
