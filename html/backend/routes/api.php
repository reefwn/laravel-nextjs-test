<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\PropertyController;

Route::get('/properties', [PropertyController::class, 'index']);
