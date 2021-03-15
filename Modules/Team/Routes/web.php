<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Team\Http\Controllers\TeamController;

Route::group(['module' => 'Team', 'middleware' => ['web'], 'namespace' => 'App\Modules\User\Controllers'], function () {
    Route::get('/view-teams', [TeamController::class, 'viewTeams']);
    Route::get('/team', [TeamController::class, 'teamView']);
    Route::get('/create-team', [TeamController::class, 'createTeam']);

});
