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

// Checks to see if user is logged in. If not, they will be redirected to the login view.
Route::group(['middleware' => 'auth'], function()
{
    // Routes regarding the Interview/Phone Screen questions and answers.
    Route::get('/answers/create/{a_id}/{q_id}', 'PagesController@createAnswer');
    Route::get('/answers/edit/{a_id}/{id}', 'PagesController@editAnswer');
    Route::get('/answers/{id}/{type}', 'PagesController@showAnswers');

    // Any user can access these routes.
    Route::get('applicants/filter', 'ApplicantsController@filter');
    Route::resource('applicants', 'ApplicantsController');

    // Only an Admin can access these routes.
    Route::get('questions/filter', 'QuestionsController@filter');
    Route::resource('questions', 'QuestionsController');
    Route::resource('answers', 'AnswersController');
    Route::resource('jobs', 'JobsController');
    Route::resource('sources', 'SourcesController');
    Route::resource('users', 'UsersController');
});

// Routes dealing with login system.
Auth::routes();

// Route for the home view. Contains Admin control panel.
Route::get('/home', 'HomeController@index')->name('home');

// Routes dealing with the change password functionality.
Route::get('change-password', 'Auth\UpdatePasswordController@index')->name('password.form');
Route::post('change-password', 'Auth\UpdatePasswordController@update')->name('password.update');