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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(['prefix' => '','as'=>'web.'], function() {
    Route::get('', ['as' => 'home', 'uses' => 'WebpageController@index']);
    Route::get('cat/{id}', ['as' => 'category', 'uses' => 'WebpageController@news_category']);
    Route::get('news/{id}', ['as' => 'show', 'uses' => 'WebpageController@show']);
    Route::get('search/', ['as' => 'search', 'uses' => 'WebpageController@search']);
});

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::prefix('management')->group(function () {
        Route::get('', ['as' => 'admin_home', 'uses' => 'HomeController@index'])->middleware('auth');
        Route::resource('roles','RoleController');
        Route::resource('users','UserController');
        Route::resource('perm','PermController');
        Route::resource('category_news','News_categoryController');
        Route::resource('news','NewsController');

        Route::group(['prefix' => 'news','as'=>'news.'], function() {
            Route::get('cat/{id}', ['as' => 'category', 'uses' => 'NewsController@category']);
            Route::get('create/{id}', ['as' => 'create_ref', 'uses' => 'NewsController@create_ref']);
            Route::get('{id}/{ref_id}/edit', ['as' => 'edit_ref', 'uses' => 'NewsController@edit_ref']);
            Route::post('upload_pic', ['as' => 'upload_pic', 'uses' => 'NewsController@upload_pic']);
            Route::post('show_pic', ['as' => 'show_pic', 'uses' => 'NewsController@show_pic']);
            Route::post('delete_pic', ['as' => 'delete_pic', 'uses' => 'NewsController@delete_pic']);
            Route::post('setcover_pic', ['as' => 'setcover_pic', 'uses' => 'NewsController@setcover_pic']);
        });

        require __DIR__ . '/profile/profile.php';
    });
});


