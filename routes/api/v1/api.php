<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', 'App\Http\Controllers\Api\V1\PingController@index')->name('ping_index');
// Login
Route::post('/login', 'App\Http\Controllers\Api\V1\AuthController@login')->name('login');
Route::post('/refresh', 'App\Http\Controllers\Api\V1\AuthController@refresh')->name('refresh');
// Roles
Route::get('/roles', 'App\Http\Controllers\Api\V1\RolesController@index')->name('roles_index');
Route::get('/roles/{id}', 'App\Http\Controllers\Api\V1\RolesController@show')->name('roles_show');
Route::post('/roles', 'App\Http\Controllers\Api\V1\RolesController@store')->name('roles_store');
// Users
Route::get('/users', 'App\Http\Controllers\Api\V1\UsersController@index')->name('users_index');
// Stats
Route::get('/stats', 'App\Http\Controllers\Api\V1\StatsController@index')->name('stats_index');
