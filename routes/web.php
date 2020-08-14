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

Route::get('/admin/login', ['as' => 'admin.login.get', 'uses' => 'admin\LoginController@login' ]);
Route::post('/admin/login', ['as' => 'admin.login.post', 'uses' => 'admin\LoginController@postLogin']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'admin\LoginController@logout']);

Route::group(['middleware' => 'CheckLoginAdmin', 'prefix' => 'admin', 'namespace' => 'admin'], function(){

	Route::get('/', ['as' => 'admin.index', 'uses' => 'IndexController@index']);


	Route::get('product', ['as' => 'admin.product', 'uses' => 'ProductController@index']);
	Route::get('product/edit/{id}', ['as' => 'admin.product.edit', 'uses' => 'ProductController@edit']);
	Route::get('product/create', ['as' => 'admin.product.create', 'uses' => 'ProductController@create']);
	Route::post('product/store', ['as' => 'admin.product.create.post', 'uses' => 'ProductController@store']);
	Route::post('product/update/{id}', ['as' => 'admin.product.update', 'uses' => 'ProductController@update']);
	Route::get('product/del/{id}', ['as' => 'admin.product.del', 'uses' => 'ProductController@destroy']);
	Route::post('product/load-media', ['as' => 'admin.product.media.loadmore', 'uses' => 'ProductController@loadMoreMedia']);

	Route::group(['prefix' => 'product-tag'], function(){
		Route::get('/', ['as' => 'admin.product.tag', 'uses' => 'ProductTagsController@index']);
		Route::post('store', ['as' => 'admin.product.tag.post', 'uses' => 'ProductTagsController@store']);
		Route::post('destroy', ['as' => 'admin.product.tag.destroy', 'uses' => 'ProductTagsController@destroy']);
		Route::post('update', ['as' => 'admin.product.tag.update', 'uses' => 'ProductTagsController@update']);
	});

	Route::get('slide', ['as' => 'admin.slide', 'uses' => 'SlideController@index']);
	Route::get('slide/create', ['as' => 'admin.slide.create', 'uses' => 'SlideController@create']);
	Route::post('slide/store', ['as' => 'admin.slide.create.post', 'uses' => 'SlideController@store']);
	Route::get('slide/edit/{id}', ['as' => 'admin.slide.edit', 'uses' => 'SlideController@edit']);
	Route::post('slide/update/{id}', ['as' => 'admin.slide.update', 'uses' => 'SlideController@update']);
	Route::get('slide/destroy/{id}', ['as' => 'admin.slide.del', 'uses' => 'SlideController@destroy']);

	Route::get('page', ['as' => 'admin.page', 'uses' => 'PageController@index']);
	Route::get('page/create', ['as' => 'admin.page.create', 'uses' => 'PageController@create']);
	Route::post('page/store', ['as' => 'admin.page.create.post', 'uses' => 'PageController@store']);
	Route::get('page/edit/{id}', ['as' => 'admin.page.edit', 'uses' => 'PageController@edit']);
	Route::post('page/update/{id}', ['as' => 'admin.page.update', 'uses' => 'PageController@update']);
	Route::get('page/del/{id}', ['as' => 'admin.page.destroy', 'uses' => 'PageController@destroy']);


	Route::group(['prefix' => 'category'], function(){
		Route::get('/', ['as' => 'admin.category', 'uses' => 'CategoryController@index']);
		Route::get('create', ['as' => 'admin.category.create', 'uses' => 'CategoryController@create']);
		Route::post('store', ['as' => 'admin.category.create.post', 'uses' => 'CategoryController@store']);
		Route::get('edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit']);
		Route::post('update/{id}', ['as' => 'admin.category.update', 'uses' => 'CategoryController@update']);
		Route::get('del/{id}', ['as' => 'admin.category.destroy', 'uses' => 'CategoryController@destroy']);
	});


	Route::group(['prefix' => 'media'], function(){
		Route::get('/', ['as' => 'admin.media', 'uses' => 'MediaController@index']);
		Route::post('store', ['as' => 'admin.media.create.post', 'uses' => 'MediaController@store']);
		Route::post('del', ['as' => 'admin.media.destroy', 'uses' => 'MediaController@destroy']);
		Route::post('update', ['as' => 'admin.media.update', 'uses' => 'MediaController@update']);
		Route::post('load-more', ['as' => 'admin.media.loadmore', 'uses' => 'MediaController@loadMore']);
	});
	


});
//Route::get('/admin', 'admin\IndexController@index');
Route::group(['namespace' => 'front'], function(){
	Route::get('/', ['as' => 'home', 'uses' => 'IndexController@index']);
});


