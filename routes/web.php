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
    return view('welcome');
});

Auth::routes();

Route::get('/reviewers', 'HomeController@reviewers');
Route::get('/journals', 'HomeController@journals');
Route::get('/publications', 'HomeController@publications');
Route::get('/institutions', 'HomeController@institutions');
Route::get('/countries', 'HomeController@countries');
Route::post('get_country_name','HomeController@get_country_name');
//After Auth...................Reviewers...
Route::get('/home', 'ReviewerController@index')->name('home');
Route::post('/get_organization_name','ReviewerController@get_organization_name');
Route::post('/submit_employment','ReviewerController@submit_employment');
Route::post('/delete_employment','ReviewerController@delete_employment');
Route::post('/submit_name','ReviewerController@submit_name');
Route::post('/submit_country','ReviewerController@submit_country');
Route::post('/submit_keywords','ReviewerController@submit_keywords');
