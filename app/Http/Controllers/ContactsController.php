<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Repositories\MenusRepository;
use Config;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Arr;
use Mail;

class ContactsController extends SiteController
{
    public function __construct() {

    	parent::__construct(new MenusRepository(new Menu));

    	$this->bar = 'left';

    	$this->template = config('config.theme') . '.contacts';

        $this->heads['title'] = 'Контакты';
        $this->heads['keywords'] = 'Контакты, корпоративный сайт';
        $this->heads['descr'] = 'Контакты на корпроативном сайте';
	}

	 public function index(Request $request) {
	 	$theme = config('config.theme');

	 	if ($request->isMethod('post')) {
			$messages = [
			    'required' => 'Поле :attribute Обязательно к заполнению',
			    'email'    => 'Поле :attribute должно содержать правильный email адрес',
			];

			 $this->validate($request, [
		        'name' => 'required|max:255',
		        'email' => 'required|email',
				'text' => 'required'
		    ]/*, $messages*/);

			$data = $request->all();

			$result = Mail::send($theme . '.email', ['data' => $data], function ($m) use ($data) {
	            $m->from($data['email'], $data['name']);
	            $m->to(Config::get('config.mailAdmin'), 'Mr. Admin')->subject('Question');
	        });
			if($result) {
				return redirect()->route('contacts')->with('status', 'Email is send');
			} else {
				return redirect()->route('contacts')->with('status', 'Send Error');
            }
		}


	 	$content = view($theme . '.contactContent')->render();
	 	$errors = '';
	 	$this->vars = Arr::add($this->vars, 'content', $content);
	 	$this->vars = Arr::add($this->vars, 'errors', $errors);

	 	$this->contentLeftBar = view($theme . '.contactBar')->render();

	 	return $this->renderOutput();
    }


}
