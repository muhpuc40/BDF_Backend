<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\NewsAnnouncementController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\DirectoryController;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Event Routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

// Committee Routes
Route::get('/committees', [CommitteeController::class, 'index'])->name('committees.index');
Route::get('/committees/create', [CommitteeController::class, 'create'])->name('committees.create');
Route::post('/committees', [CommitteeController::class, 'store'])->name('committees.store');
Route::get('/committees/{committee}', [CommitteeController::class, 'show'])->name('committees.show');

// News Routes
Route::get('/news', [NewsAnnouncementController::class, 'newsIndex'])->name('news.index');
Route::get('/news/create', [NewsAnnouncementController::class, 'newsCreate'])->name('news.create');
Route::post('/news', [NewsAnnouncementController::class, 'newsStore'])->name('news.store');
Route::get('/news/{news}', [NewsAnnouncementController::class, 'newsShow'])->name('news.show');

// Announcement Routes
Route::get('/announcements', [NewsAnnouncementController::class, 'announcementIndex'])->name('announcements.index');
Route::get('/announcements/create', [NewsAnnouncementController::class, 'announcementCreate'])->name('announcements.create');
Route::post('/announcements', [NewsAnnouncementController::class, 'announcementStore'])->name('announcements.store');
Route::get('/announcements/{announcement}', [NewsAnnouncementController::class, 'announcementShow'])->name('announcements.show');

// Hall Routes
Route::get('/hall', [HallController::class, 'index'])->name('hall.index');
Route::get('/hall/create', [HallController::class, 'create'])->name('hall.create');
Route::post('/hall', [HallController::class, 'store'])->name('hall.store');
Route::get('/hall/{hall}', [HallController::class, 'show'])->name('hall.show');

//Directory Routes
Route::get('/directory', [DirectoryController::class, 'index'])->name('directory.index');
Route::get('/directory/create', [DirectoryController::class, 'create'])->name('directory.create');
Route::post('/directory', [DirectoryController::class, 'store'])->name('directory.store');
Route::get('/directory/{directory}', [DirectoryController::class, 'show'])->name('directory.show');