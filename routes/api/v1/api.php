<?php

use Illuminate\Support\Facades\Route;

Route::get('/ping', 'App\Http\Controllers\Api\V1\PingController@index')->name('ping_index');
