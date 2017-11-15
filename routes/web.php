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

Route::get('/', 'PagesController@index');

//Route::group(['middleware' => 'auth'], function()
//{
    Route::get('/controlpanel', 'PagesController@controlpanel');
    Route::get('/answers/create/{a_id}/{q_id}', 'PagesController@createAnswer');
    Route::get('/answers/edit/{a_id}/{id}', 'PagesController@editAnswer');
    Route::get('/answers/{id}/{type}', 'PagesController@showAnswers');

    Route::get('applicants/filter', 'ApplicantsController@filter');
    Route::resource('applicants', 'ApplicantsController');
    Route::resource('questions', 'QuestionsController');
    Route::resource('answers', 'AnswersController');
    Route::resource('jobs', 'JobsController');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('change-password', 'Auth\UpdatePasswordController@index')->name('password.form');
Route::post('change-password', 'Auth\UpdatePasswordController@update')->name('password.update');