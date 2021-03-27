<?php

use Illuminate\Support\Facades\Route;
use LaravelGenesis\Genesis\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Genesis Web Routes
|--------------------------------------------------------------------------
|
| Here are basic routs that genesis package needs.
|
*/

Route::get(config('genesis.path'), [MainController::class, 'dashboard']);
