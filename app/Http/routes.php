<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => 'web'], function () {
Route::auth();
    
    // Index page (everybody)
    Route::get('/', 'IndexController@index');
    // Index page -> Adding item into Cart (loged user)
    Route::post('/', 'IndexController@post');
    // Index page -> Removing item from DB (Admin)
    Route::delete('/', 'IndexController@delete');    


    // Show page -> show specific item (everybody)
    Route::get('/show/{id}', 'ShowController@index');


    // Edit page -> show editing product (Admin)
    Route::get('/edit/{id}','EditController@index');
    // Edit page -> update product information (Admin)
    Route::put('/edit/{id}','EditController@update');

    // Create page -> show creating form (Admin)
    Route::get('/create','CreateController@index');    
    // Create page -> create new product (Admin)
    Route::post('/create','CreateController@post');    
    

    // Order page -> show specific order (loged user)
    Route::get('/order','OrderController@index');
    // Order page -> remove specific order (loged user)
    Route::delete('/order','OrderController@delete');
    // Order page -> update specific order's information (Admin)
    Route::put('/order','OrderController@update');

    // Cart page -> show user's cart and his orders (loged user)
    Route::get('/cart', 'HomeController@index');
    // Cart page -> remove specific ordered product from Cart (loged User)
    Route::delete('/cart', 'HomeController@delete');

});