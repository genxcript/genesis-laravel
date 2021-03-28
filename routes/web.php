<?php

use Illuminate\Support\Facades\Route;
use LaravelGenesis\Genesis\GenesisFacade;
use LaravelGenesis\Genesis\Http\Controllers\MainController;

/*
|--------------------------------------------------------------------------
| Genesis Web Routes
|--------------------------------------------------------------------------
|
| Here are basic routs that genesis package needs.
|
*/

Route::prefix(config('genesis.path'))->group(function () {
    Route::get('', [MainController::class, 'dashboard']);
    GenesisFacade::registerResources(app_path('Http/Livewire/Genesis'));
});
