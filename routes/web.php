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

Route::middleware(['web', 'auth'])->prefix(config('genesis.path'))->group(function () {
    Route::get('', [MainController::class, 'dashboard'])->name('genesis::dashboard');
    GenesisFacade::registerResourcesRoutes(app_path('Http/Livewire/Genesis'));
});
