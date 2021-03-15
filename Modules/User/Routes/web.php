<?php

use Illuminate\Support\Facades\Route;
use Modules\User\Http\Controllers\RegistrationController;
use Modules\User\Http\Controllers\LoginController;

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
Route::group(['module' => 'User', 'middleware' => ['web'], 'namespace' => 'App\Modules\User\Controllers'], function () {
    // show login page
    Route::get('/', [LoginController::class, 'show']);
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    // login to acc
    Route::post('/login', [LoginController::class, 'show']);
    // show register page
    Route::get('/register', [RegistrationController::class, 'show'])->name('register')->middleware('guest');
    // registration function
    Route::post('/register', [RegistrationController::class, 'show']);
    //verify email route
    Route::get('/verifyEmails', [RegistrationController::class, 'verify']);

    // logout function
    Route::get('/logout', [LoginController::class, 'logout']);
    // Log out User
    Route::get('/logout', [LoginController::class, 'logout'])->middleware('authenticateUser');

    Route::get('/forgot-password', [LoginController::class, 'forgotPassword']);

    Route::get('social/{network}', [LoginController::class, 'social']);
    Route::get('facebook-callback', [LoginController::class, 'facebookCallBack']);
    Route::get('google-callback', [LoginController::class, 'googleCallBack']);
    Route::get('github-callback', [LoginController::class, 'gitHubCallBack']);
    Route::get('/twitter-callback', [LoginController::class, 'twitterCallBack']);
//    Route::get('/twitter/callback', [LoginController::class, 'twitterCallBack']);
//    Route::get('/facebook/callback', [LoginController::class, 'twitterCallBack']);
//    Route::get('/youtube/callback', [LoginController::class, 'twitterCallBack']);
//    Route::get('/linkedin/callback', [LoginController::class, 'twitterCallBack']);
//    Route::get('/pinterest/callback', [LoginController::class, 'twitterCallBack']);

    // Forgot Password
    Route::get('/forgot-password', [LoginController::class, 'forgotPassword']);
    Route::post('/forgot-password-email', [LoginController::class, 'forgotPasswordEmail']);
    Route::get('/verify-password-token', [LoginController::class, 'verifyPasswordToken']);

//  New Password
    Route::get('/reset-password', [LoginController::class, 'resetPassword']);
    Route::post('/new-password', [LoginController::class, 'newPassword']);

//  Email Login
    Route::post('/email-login', [LoginController::class, 'emailLogin']);
    Route::get('/verify-direct-login', [LoginController::class, 'verifyDirectLogin']);
});
