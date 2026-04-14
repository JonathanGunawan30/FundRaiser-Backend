<?php 

use App\Http\Controllers\Api\UserAuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('auth/user/{provider}')->group(function () {
    Route::get('redirect', [UserAuthController::class, 'redirectToProvider']);
    Route::get('callback', [UserAuthController::class, 'handleProviderCallback']);
})->where('provider', 'google|github');
