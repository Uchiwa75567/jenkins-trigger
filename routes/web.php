<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/jenkins-test', [TestController::class, 'index']);
