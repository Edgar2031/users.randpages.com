<?php

 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\LoginController;
 use App\Http\Controllers\RegistrationController;
 use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return redirect('/login');
});


// // Show Register Page & Login Page
// Route::get('/login', [LoginController::class, 'show'])
//     ->name('login')
//     ->middleware('guest');
// Route::get('/register', [RegistrationController::class, 'show'])
//     ->name('register')
//     ->middleware('guest');


// // Register & Login User
// Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/register', [RegistrationController::class, 'register']);

// // Route::middleware(['auth'])->group(function () {
// Route::get('/admin', [DashboardController::class, 'index'])
//     ->name('admin')
//     ->middleware('role:admin');
// Route::get('/dashboard', [DashboardController::class, 'index'])
//     ->name('dashboard')
//     ->middleware('role:user');
// Route::get('/logout', [LoginController::class, 'logout']);
// });
