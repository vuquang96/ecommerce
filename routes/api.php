<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:api', 'namespace' => 'api'], function(){
	Route::get('/tags', ['uses' => 'ProductTagsController@index']);


});

Route::group(['prefix' => 'auth', 'namespace' => 'api'], function(){
	Route::post('/login', 'AuthController@login');
	Route::post('/signup', ['uses' => 'AuthController@signup']);
	
	Route::group(['middleware' => 'auth:api'], function(){
		Route::get('logout', ['uses' => 'AuthController@logout']);
		Route::get('user', ['uses' => 'AuthController@user']);
	});
});


/*Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::resource('companies', 'CompaniesController', ['except' => ['create', 'edit']]);
});*/