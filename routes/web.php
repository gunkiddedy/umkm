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


// Auth::routes();


// Route::view('/', 'welcome');

// Route::get('/login', 'HomeController@login')->name('login');


// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/company-page/{id}', 'WebController@companyPage')->name('company.page');
// Route::get('/company-list', 'WebController@companyList')->name('company.list');
// Route::get('/product-detail/{id}', 'WebController@productDetail')->name('product.page');

Route::get('/{any}', function(){
    return view('layouts.app');
})->where('any', '.*');