<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/athenticated', function () {
    return true;
});
Route::post('register', 'RegisterController@register');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout');


Route::get('/get_total', 'HomeController@get_total');
Route::get('/get_enrol_methods', 'HomeController@get_enrol_methods');
Route::get('/get_enrol_vs_completion', 'HomeController@get_enrol_vs_completion');
Route::get('/get_user_erolment_list', 'HomeController@get_user_erolment_list');

