<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\Http\Controllers\DashboardController;
use Modules\Home\Http\Controllers\TeamController;


Route::group(['module' => 'Home', 'middleware' => ['authenticateUser'], 'namespace' => 'App\Modules\Home\Controllers'], function () {

    // show user dashboard page
    Route::group(['middleware' => ['authenticateUser']], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        // show admin page
//    Route::get('/admin', [DashboardController::class, 'index'])
//        ->name('admin')
//        ->middleware('role:admin');


//        Route::get('/view-accounts', [DashboardController::class, 'accountsView']);
        Route::get('/add-twitter-accounts', [DashboardController::class, 'addTwitterAccounts']);
        Route::post('/update-rating', [DashboardController::class, 'updateRating']);
        Route::post('/update-cron', [DashboardController::class, 'updateCron']);

        Route::get('/lock-accounts/{id}', [DashboardController::class, 'lockAccount']);
        Route::get('/unlock-accounts/{id}', [DashboardController::class, 'unlockAccount']);
        Route::get('/view-accounts', [DashboardController::class, 'getSocialAccountsDetails']);
        Route::get('/add-accounts/{network}', [DashboardController::class, 'addSocialAccounts']);
        Route::get('/twitter/callback', [DashboardController::class, 'addTwitterCallback']);
        Route::get('/facebook/callback', [DashboardController::class, 'addfacebookCallback']);
        Route::get('/linkedin/callback', [DashboardController::class, 'addLinkedInCallback']);
        Route::get('/get-social-accounts-details', [DashboardController::class, 'getSocialAccountsDetails']);

    });


});
