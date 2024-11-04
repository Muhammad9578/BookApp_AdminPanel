<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'Api\AuthController@register');
Route::post('/login', 'Api\AuthController@login');
Route::get('/get_chapters', 'Api\ChaptersController@get_chapters');
Route::post('/get_quiz', 'Api\QuizController@get_quiz');
Route::post('/submit_quiz', 'Api\ResultController@get_result');
Route::post('/result_history', 'Api\ResultController@result_history');
Route::post('/delete_history', 'Api\ResultController@delete_history');
Route::get('/attempted_chapters', 'Api\ResultController@attempted_chapters');
Route::get('/answer_sheet', 'Api\ResultController@answer_sheet');
