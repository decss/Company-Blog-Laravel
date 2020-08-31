<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/', 'IndexController', [
    'only' => 'index',
    'names' => ['index' => 'home'],
]);

Route::resource('portfolios', 'PortfolioController', [
    'parameters' => [
        'portfolios' => 'alias'
    ],
]);

Route::resource('articles', 'ArticleController', [
    'parameters' => [
        'articles' => 'alias'
    ],
]);

Route::get('articles/cat/{alias?}', [
    'uses' => 'ArticleController@index',
    'as' => 'articlesCat'
])->where('alias','[\w-]+');

Route::resource('comment', 'CommentController', ['only' => ['store']]);

Route::match(['get','post'],'/contacts',['uses'=>'ContactsController@index','as'=>'contacts']);

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');


// Admin section
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::get('/', ['uses' => 'Admin\IndexController@index', 'as' => 'adminIndex']);
    Route::resource('/articles', 'Admin\ArticlesController', ['names' => 'admin.articles']);
    Route::resource('/permissions', 'Admin\PermissionsController', ['names' => 'admin.permissions']);
    Route::resource('/menus', 'Admin\MenusController', ['names' => 'admin.menus']);

});
