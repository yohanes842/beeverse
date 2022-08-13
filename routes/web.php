<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\TopupController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

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
Route::post('/lang/{locale?}', [LangController::class, 'lang'])->name('lang');

Route::get('/', function () {
    return redirect()->route('home');
});

Route::controller(AccountController::class)->group(function() {
    Route::middleware('guest')->group(function () {
        Route::get('/login', 'login_index')->name('login');
        Route::post('/login', 'login_process')->name('login');
        Route::get('/register', 'register_index')->name('register');
        Route::post('/register', 'register_process')->name('register');
        Route::get('/registration-payment/{user}', 'payment_index')->name('payment');
        Route::post('/registration-payment/{user}', 'payment_process')->name('payment');
    });
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/topup', [TopupController::class, 'index'])->name('topup');
Route::post('/topup/{user}', [TopupController::class, 'add_coin'])->name('topup-process');


Route::controller(UserController::class)->group(function() {
    Route::middleware('auth')->group(function () {
        Route::post('/change-account-settings/{user}', 'accountSetting')->name('set-account');
    });
});

Route::controller(AvatarController::class)->group(function(){
    Route::middleware('auth')->group(function () {
        Route::post('/shop/purchase-avatar/{avatar}', 'purchase')->name('purchase');
        Route::post('/set-profile/{avatar}', 'set_as_profile')->name('set-avatar');
        Route::get('/shop', 'shop_index')->name('shop');
        Route::get('/collection/{user}', 'collection_index')->name('collection');
        Route::post('/send-avatar/{user}', 'send_avatar')->name('send-avatar');
    });
});

Route::controller(WishlistController::class)->group(function(){
    Route::middleware('auth')->group(function () {
        Route::post('/thumb/{user}', 'wishlist')->name('thumb');
        Route::get('/friends', 'friends_index')->name('friends');
    });
});

Route::controller((ChatController::class))->group(function(){
    Route::middleware('auth')->group(function () {
        Route::get('/chat/{user}', 'index')->name('chat');
        Route::post('/chat/{user}', 'add')->name('chat');
    });
});

