<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PortfolioController;
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

Route::resource('/', IndexController::class, [
    'only' => 'index',
    'names' => ['index' => 'home'],
]);

Route::resource('portfolios', PortfolioController::class, [
    'parameters' => [
        'portfolios' => 'alias'
    ],
]);

Route::resource('articles', ArticleController::class, [
    'parameters' => [
        'articles' => 'alias'
    ],
]);

Route::get('articles/cat/{alias?}', [
    'uses' => [ArticleController::class, 'index'],
    'as' => 'articlesCat'
])->where('alias','[\w-]+');

Route::resource('comment', CommentController::class, ['only' => ['store']]);

Route::match(['get','post'],'/contacts',['uses' => 'App\Http\Controllers\ContactsController@index','as'=>'contacts']);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');


// Admin section
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {

    Route::get('/', ['uses' => 'App\Http\Controllers\Admin\IndexController@index', 'as' => 'adminIndex']);
    Route::resource('/articles', 'App\Http\Controllers\Admin\ArticlesController', ['names' => 'admin.articles']);
    Route::resource('/permissions', 'App\Http\Controllers\Admin\PermissionsController', ['names' => 'admin.permissions']);
    Route::resource('/menus', 'App\Http\Controllers\Admin\MenusController', ['names' => 'admin.menus']);

});
