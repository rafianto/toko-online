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
    return redirect('admin/login');
});
Auth::routes();


Route::group(['middleware' => 'auth'], function() {

    Route::get('/dashboard', 'DashboardController@index');

    // Route for Category
    Route::get("/category/search", 'CategoryController@search');
    Route::resource('/category', 'CategoryController');

    // Route for product
    Route::group(['prefix' => 'product'], function() {
        Route::get('/search', ['as' => 'search.product', 'uses' => 'ProductController@search']);
        Route::get('{productId}/images', ['as' => 'images.product', 'uses' => 'ProductController@images']);
        Route::get('{productId}/add-images', ['as' => 'add.images.product', 'uses' => 'ProductController@addImages']);
        Route::post('images/{productId}', ['as' => 'post.images.product', 'uses' => 'ProductController@uploadImages']);
        Route::delete('images/{productId}/delete', ['as' => 'delete.images.product', 'uses' => 'ProductController@destroyImages']);
    });
    Route::resource('/product', 'ProductController');

});