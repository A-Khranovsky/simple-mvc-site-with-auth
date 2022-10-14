<?php

namespace App\Config;

use App\Router\Route;

Route::get('home', null, 'home');
Route::post('home', 'login', 'login');

