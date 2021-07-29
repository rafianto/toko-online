<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Please use Prefix to your group route.
|
*/

Route::get('/', function () {
    return redirect('admin/login');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function() {

    Route::get('/dashboard', 'DashboardController@index');

    // Master
    Route::group(['prefix' => 'master'], function() {

        // Route for Category
        Route::get("/category/search", 'CategoryController@search');
        Route::resource('/category', 'CategoryController');

        // Route for product
        Route::group(['prefix' => 'product'], function() {
            Route::get('/search', ['as' => 'search.product', 'uses' => 'ProductController@search']);

            // images route
            Route::group(['prefix' => '{productId}/images'], function() {

                Route::get('/', ['as' => 'images.product', 'uses' => 'ProductController@images']);
                Route::get('add-images', ['as' => 'add.images.product', 'uses' => 'ProductController@addImages']);
                Route::post('/add-images', ['as' => 'post.images.product', 'uses' => 'ProductController@uploadImages']);

            });

            Route::delete('images/{imageId}/delete', ['as' => 'delete.images.product', 'uses' => 'ProductController@destroyImages']);

        });
        Route::resource('/product', 'ProductController');

        /**
         * this route for attribute
         */
        // use resource for base template route
        Route::group(['prefix' => 'attribute'], function() {
            Route::get('/', ['as' => 'index.attribute', 'uses' => 'AttributeController@index']);
            Route::get('search', ['as' => 'search.attribute', 'uses' => 'AttributeController@search']);
            Route::get('create', ['as' => 'create.attribute', 'uses' => 'AttributeController@create']);
            Route::get('{attributeId}', ['as' => 'show.attribute', 
                'uses' => 'AttributeController@show']);
            Route::post('/', ['as' => 'post.data.attribute', 'uses' => 'AttributeController@store']);
            
            Route::put('{id}', ['as' => 'update.attribute', 
                'uses' => 'AttributeController@update']);
            Route::delete('{attributeId}', ['as' => 'delete.attribute', 
                'uses' => 'AttributeController@destroy']);
            
            // route group for attributeId/option view
            Route::group(['prefix' => '{attributeId}/options'], function(){

                Route::get('/', ['as' => 'options.attribute.index', 
                    'uses' => 'AttributeController@options']);
                Route::get("search", ['as' => 'search.options.attribute', 
                    'uses' => 'AttributeController@searchOptions']);
                Route::get('/add-option', ['as' => 'option.attribute.create',
                    'uses' => 'AttributeController@createOptions']);
                    
            });

            // route group option
            Route::group(['prefix' => 'options'], function() {
                Route::post('/', ['as' => 'option.attribute.store',
                    'uses' => 'AttributeController@storeOptions']);
                Route::delete('{optionId}', ['as' => 'option.attribute.delete',
                    'uses' => 'AttributeController@destroyOptions']);

            });
            
        });

    });

});