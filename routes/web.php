<?php

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

Route::get('/', 'PagesController@getHome');

Route::get('./', 'PagessController@getHome');

Route::get('/addCategory', 'CategoriesController@getCategoriesSelect');

Route::get('/viewCategories', 'CategoriesController@getCategoriesTreeList');

Route::post('/contact/submit', 'CategoriesController@submit');