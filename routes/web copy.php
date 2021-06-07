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
Route::get('/','FrontController@index');

Route::prefix('news')->group(function ()
{
    Route::get('/','FrontController@newsIndex');
    Route::get('/content/{id}','FrontController@newsContent');
});

Route::prefix('admin')->middleware('auth')->group(function ()
{
   Route::get('/','HomeController@index'); 
   Route::prefix('news')->group(function() {
        Route::get('/','NewsController@index');
        Route::get('/create','NewsController@create');          
        Route::post('/store','NewsController@store');          
        Route::get('/edit/{id}','NewsController@edit');          
        Route::post('/update/{id}','NewsController@update');          
        Route::get('/delete/{id}','NewsController@delete');          

   });
});

Route::prefix('products')->group(function ()
{
    Route::get('/','ProductFrontController@productIndex');
    Route::get('/content/{id}','ProductFrontController@productContent');
});

Route::prefix('admin')->middleware('auth')->group(function ()
{
   Route::get('/','HomeController@index'); 
   Route::prefix('products')->group(function() {
        Route::get('/','ProductAdminController@index');
        Route::get('/create','ProductAdminController@create');          
        Route::post('/store','ProductAdminController@store');          
        Route::get('/edit/{id}','ProductAdminController@edit');          
        Route::post('/update/{id}','ProductAdminController@update');          
        Route::get('/delete/{id}','ProductAdminController@delete');  
        // 新東西
        Route::post('/delete_img','ProductAdminController@delete_img');
   });
});

Route::prefix('product_type')->group(function ()
{
    Route::get('/','FrontController@productTypeIndex');
});
Route::prefix('admin')->middleware('auth')->group(function ()
{
   Route::get('/','HomeController@index'); 
   Route::prefix('product_types')->group(function() {
        Route::get('/','ProductTypeController@index');
        Route::get('/create','ProductTypeController@create');          
        Route::post('/store','ProductTypeController@store');          
        Route::get('/edit/{id}','ProductTypeController@edit');          
        Route::post('/update/{id}','ProductTypeController@update');          
        Route::get('/delete/{id}','ProductTypeController@delete');  
   });
});






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
