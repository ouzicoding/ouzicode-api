<?php

use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return 'hello admin';
});


Route::post('/login', [LoginController::class, 'login']);
