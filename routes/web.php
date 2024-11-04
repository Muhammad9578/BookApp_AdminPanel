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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/register', 'Auth\RegisterController@register');
Route::resource('/all_users', 'AllUsersController');
Route::resource('/chapters', 'ChapterController');
Route::resource('/poems', 'PoemController');
Route::resource('/plays', 'PlayController');
Route::resource('/results', 'ResultController');
Route::resource('/poem_results', 'PoemResultController');
Route::resource('/play_results', 'PlayResultController');
Route::resource('/quizzes', 'QuizController');
Route::resource('/poem_quiz', 'PoemQuizController');
Route::resource('/play_quiz', 'PlayQuizController');
