<?php

use App\Http\Controllers\SinglePageAppController;
use Illuminate\Support\Facades\Route;

Route::get('{any}', [SinglePageAppController::class, 'index'])->where('any', '.*');
Route::auth();
