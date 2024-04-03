<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserTicketController;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\PasswordResetApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware('auth:sanctum')->get('/user/tickets', [UserTicketController::class, 'userTickets']);
Route::post('login', [UserAuthenticationController::class, 'login']);

Route::post('password/reset-link', [PasswordResetApiController::class, 'sendResetLinkEmail']);


