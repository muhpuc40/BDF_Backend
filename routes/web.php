<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\NewsAnnouncementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\ContactEmailController;
use Illuminate\Support\Facades\Artisan;

Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return 'Cache Cleared!';
});

// ── AUTH ROUTES (guests only) ─────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── PROTECTED ROUTES (must be logged in) ─────────────────────
Route::middleware('auth')->group(function () {

    Route::get('/', fn() => redirect()->route('dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Events
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

    // Committees
    Route::get('/committees', [CommitteeController::class, 'index'])->name('committees.index');
    Route::get('/committees/create', [CommitteeController::class, 'create'])->name('committees.create');
    Route::post('/committees', [CommitteeController::class, 'store'])->name('committees.store');
    Route::get('/committees/{committee}', [CommitteeController::class, 'show'])->name('committees.show');

    // News
    Route::get('/news', [NewsAnnouncementController::class, 'newsIndex'])->name('news.index');
    Route::get('/news/create', [NewsAnnouncementController::class, 'newsCreate'])->name('news.create');
    Route::post('/news', [NewsAnnouncementController::class, 'newsStore'])->name('news.store');
    Route::get('/news/{news}', [NewsAnnouncementController::class, 'newsShow'])->name('news.show');

    // Announcements
    Route::get('/announcements', [NewsAnnouncementController::class, 'announcementIndex'])->name('announcements.index');
    Route::get('/announcements/create', [NewsAnnouncementController::class, 'announcementCreate'])->name('announcements.create');
    Route::post('/announcements', [NewsAnnouncementController::class, 'announcementStore'])->name('announcements.store');
    Route::get('/announcements/{announcement}', [NewsAnnouncementController::class, 'announcementShow'])->name('announcements.show');

    // Hall
    Route::get('/hall', [HallController::class, 'index'])->name('hall.index');
    Route::get('/hall/create', [HallController::class, 'create'])->name('hall.create');
    Route::post('/hall', [HallController::class, 'store'])->name('hall.store');
    Route::get('/hall/{hall}', [HallController::class, 'show'])->name('hall.show');

    // Directory
    Route::get('/directory', [DirectoryController::class, 'index'])->name('directory.index');
    Route::get('/directory/create', [DirectoryController::class, 'create'])->name('directory.create');
    Route::post('/directory', [DirectoryController::class, 'store'])->name('directory.store');
    Route::get('/directory/{directory}', [DirectoryController::class, 'show'])->name('directory.show');

    // Emails
    Route::get('/emails', [ContactEmailController::class, 'index'])->name('emails.index');
    Route::get('/emails/{id}', [ContactEmailController::class, 'show'])->name('emails.show');
    Route::post('/emails/{id}/reply', [ContactEmailController::class, 'reply'])->name('emails.reply');


    

});