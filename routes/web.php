<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAuth;
use App\Http\Middleware\CheckProfile;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AuthController::class, 'login']);
Route::post('/authenticate', [AuthController::class, 'authenticate']);
Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(IsAuth::class)->group(function () {
    Route::get('/home', function () {
        return view('home');
    });
    Route::prefix('customers')->middleware(['Profile:1'])->group(function () {
        Route::get('/', [CustomerController::class, 'index']);
        Route::get('/create', [CustomerController::class, 'create']);
        Route::get('/edit/{customer}', [CustomerController::class, 'edit']);
        Route::post('/store', [CustomerController::class, 'store']);
        Route::post('/update/{customer}', [CustomerController::class, 'update']);
        Route::delete('/delete/{customer}', [CustomerController::class, 'delete']);
    }); 

    Route::get('profile/{customer}', [ProfileController::class, 'edit']);
    Route::post('profile/update/{customer}', [ProfileController::class, 'update']);
    
});
    

    

      






/*Route::middleware([CheckProfile::class])->group(function () {
    Route::get('/', );
 
    Route::get('/user/profile', function () {
        // Uses first & second middleware...
    });
});
*/