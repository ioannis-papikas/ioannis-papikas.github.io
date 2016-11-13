<?php

use App\Controllers\IndexController;
use App\Controllers\PageController;
use Panda\Support\Facades\Route;

/**
 * Handle the incoming requests using the application router.
 */
Route::get("/", IndexController::class . '@index');
Route::get("/{section}", PageController::class . '@page');
