<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;

Route::get('/', function () {
    return redirect()->route('guests.index');
});

// 🔧 Pindahkan ini ke atas untuk mencegah bentrok dengan {guest}
Route::get('/guests/search', [GuestController::class, 'search'])->name('guests.search');

Route::resource('guests', GuestController::class);
