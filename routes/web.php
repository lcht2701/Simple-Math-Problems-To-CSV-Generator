<?php

use App\Http\Controllers\MathController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/export', [MathController::class, 'export']);
