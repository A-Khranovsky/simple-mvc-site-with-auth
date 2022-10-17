<?php

namespace App\Config;

use App\Router\Route;

Route::get('auth', null, 'auth', 'HomeController');
Route::get('home', null, 'home');
Route::post('home', 'login', 'login');
