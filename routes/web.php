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

Auth::routes([
	'register' => false,
    'reset' => false,
]);

Route::get('/', 'HomeController@index')->middleware('auth');

Route::resource('campaign', 'CampaignController')->middleware(['auth','admin']);
Route::post('campaign/adduser', 'CampaignController@adduser')->middleware(['auth','admin']);

Route::resource('template', 'TemplateController')->middleware(['auth','admin']);
Route::resource('user', 'UserController')->middleware(['auth','admin']);
Route::resource('lead', 'LeadController')->middleware(['auth']);

Route::get('/{slug}', 'CampaignController@show');
Route::post('/save/{slug}', 'LeadController@store');

