<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', 'App\Http\Controllers\Api\V1\PingController@index')->name('ping_index');
// Roles
Route::get('/roles', 'App\Http\Controllers\Api\V1\RolesController@index')->name('roles_index');
// Users
Route::get('/users', 'App\Http\Controllers\Api\V1\UsersController@index')->name('users_index');
