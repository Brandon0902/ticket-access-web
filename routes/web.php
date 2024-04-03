<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewPurchaseController;
use App\Http\Controllers\Auth\ProviderController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/{provider}/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [ProviderController::class, 'callback']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/perfil', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/user-tickets', [TicketController::class, 'userTickets'])->name('user.tickets');
    Route::post('/comprar/boleto', [NewPurchaseController::class, 'store'])->name('comprar.boleto');

    Route::get('/paypal', [PayPalController::class, 'index'])->name('paypal');
    Route::post('/paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
    Route::get('/paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
    Route::get('/paypal/payment/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment.cancel');
    Route::get('purchases', [NewPurchaseController::class, 'show'])->name('purchases.show');
    
});

Route::view('/loginclient', 'views_client.logginclient')->name('cliente.login');
Route::view('/forgot-password-client', 'views_client.forgot-password-client')->name('password.cliente');
Route::view('/registerclient', 'views_client.registerclient')->name('cliente.register');
Route::get('/inicio', [EventController::class, 'showEvents'])->name('events.showEvents');
Route::get('/evento/{id}', [EventController::class, 'show'])->name('events.show');


require __DIR__.'/auth.php';
