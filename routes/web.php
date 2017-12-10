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

Route::get('/', function () {
    return view('home');
});
Route::get('/menu', 'HomeController@menu');
Route::get('/menu1', 'HomeController@menu1');
Route::get('/menu2', 'HomeController@menu2');
Route::get('/menu3', 'HomeController@menu3');
Route::get('/menu4', 'HomeController@menu4');
Route::get('/menu5', 'HomeController@menu5');
Route::post('/startjob1', 'HomeController@startjob1');
Route::post('/startjob2', 'HomeController@startjob2');
Route::post('/startjob3', 'HomeController@startjob3');
Route::post('/startjob4', 'HomeController@startjob4');
Route::post('/startjob5', 'HomeController@startjob5');
Route::get('/clearfile', 'HomeController@clearfile');
Route::post('/upload', 'HomeController@upload');
