<?php
use App\Controllers;
use App\Routes\Route;

Route::get('/', 'GroupeController@index');
// Route::get('/home-test', 'HomeController@test');

Route::get('/groupe', 'GroupeController@index');
Route::get('/groupe/create', 'GroupeController@create');
Route::post('/groupe/create', 'GroupeController@store');
Route::get('/groupe/show', 'GroupeController@show');
Route::get('/groupe/edit', 'GroupeController@edit');
Route::post('/groupe/edit', 'GroupeController@update');
Route::post('/groupe/delete', 'GroupeController@update');

Route::dispatch();