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
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\PresidiumController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


// ── AUTH ROUTES (guests only) ─────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// ── PROTECTED ROUTES (must be logged in + admin) ──────────────
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/', fn() => redirect()->route('dashboard'));
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Events
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    // Committees
    Route::get('/committees', [CommitteeController::class, 'index'])->name('committees.index');
    Route::get('/committees/create', [CommitteeController::class, 'create'])->name('committees.create');
    Route::post('/committees', [CommitteeController::class, 'store'])->name('committees.store');
    Route::get('/committees/{committee}', [CommitteeController::class, 'show'])->name('committees.show');
    Route::get('/committees/{committee}/edit', [CommitteeController::class, 'edit'])->name('committees.edit');
    Route::put('/committees/{committee}', [CommitteeController::class, 'update'])->name('committees.update');
    Route::delete('/committees/{committee}', [CommitteeController::class, 'destroy'])->name('committees.destroy');

    // News
    Route::get('/news', [NewsAnnouncementController::class, 'newsIndex'])->name('news.index');
    Route::get('/news/create', [NewsAnnouncementController::class, 'newsCreate'])->name('news.create');
    Route::post('/news', [NewsAnnouncementController::class, 'newsStore'])->name('news.store');
    Route::get('/news/{news}', [NewsAnnouncementController::class, 'newsShow'])->name('news.show');
    Route::get('/news/{news}/edit', [NewsAnnouncementController::class, 'newsEdit'])->name('news.edit');
    Route::put('/news/{news}', [NewsAnnouncementController::class, 'newsUpdate'])->name('news.update');
    Route::delete('/news/{news}', [NewsAnnouncementController::class, 'newsDestroy'])->name('news.destroy');

    // Announcements
    Route::get('/announcements', [NewsAnnouncementController::class, 'announcementIndex'])->name('announcements.index');
    Route::get('/announcements/create', [NewsAnnouncementController::class, 'announcementCreate'])->name('announcements.create');
    Route::post('/announcements', [NewsAnnouncementController::class, 'announcementStore'])->name('announcements.store');
    Route::get('/announcements/{announcement}', [NewsAnnouncementController::class, 'announcementShow'])->name('announcements.show');
    Route::get('/announcements/{announcement}/edit', [NewsAnnouncementController::class, 'announcementEdit'])->name('announcements.edit');
    Route::put('/announcements/{announcement}', [NewsAnnouncementController::class, 'announcementUpdate'])->name('announcements.update');
    Route::delete('/announcements/{announcement}', [NewsAnnouncementController::class, 'announcementDestroy'])->name('announcements.destroy');

    // Hall
    Route::get('/hall', [HallController::class, 'index'])->name('hall.index');
    Route::get('/hall/create', [HallController::class, 'create'])->name('hall.create');
    Route::post('/hall', [HallController::class, 'store'])->name('hall.store');
    Route::get('/hall/{hall}', [HallController::class, 'show'])->name('hall.show');
    Route::get('/hall/{hall}/edit', [HallController::class, 'edit'])->name('hall.edit');
    Route::put('/hall/{hall}', [HallController::class, 'update'])->name('hall.update');
    Route::delete('/hall/{hall}', [HallController::class, 'destroy'])->name('hall.destroy');

    // Directory
    Route::get('/directory', [DirectoryController::class, 'index'])->name('directory.index');
    Route::get('/directory/create', [DirectoryController::class, 'create'])->name('directory.create');
    Route::post('/directory', [DirectoryController::class, 'store'])->name('directory.store');
    Route::get('/directory/{directory}', [DirectoryController::class, 'show'])->name('directory.show');
    Route::get('/directory/{directory}/edit', [DirectoryController::class, 'edit'])->name('directory.edit');
    Route::put('/directory/{directory}', [DirectoryController::class, 'update'])->name('directory.update');
    Route::patch('/directory/{directory}/status', [DirectoryController::class, 'updateStatus'])->name('directory.update-status');
    Route::delete('/directory/{directory}', [DirectoryController::class, 'destroy'])->name('directory.destroy');

    // Advisors
    Route::get('/advisors', [AdvisorController::class, 'index'])->name('advisors.index');
    Route::get('/advisors/create', [AdvisorController::class, 'create'])->name('advisors.create');
    Route::post('/advisors', [AdvisorController::class, 'store'])->name('advisors.store');
    Route::get('/advisors/{advisor}', [AdvisorController::class, 'show'])->name('advisors.show');
    Route::get('/advisors/{advisor}/edit', [AdvisorController::class, 'edit'])->name('advisors.edit');
    Route::put('/advisors/{advisor}', [AdvisorController::class, 'update'])->name('advisors.update');
    Route::delete('/advisors/{advisor}', [AdvisorController::class, 'destroy'])->name('advisors.destroy');

    // Presidium
    Route::get('/presidium', [PresidiumController::class, 'index'])->name('presidium.index');
    Route::get('/presidium/create', [PresidiumController::class, 'create'])->name('presidium.create');
    Route::post('/presidium', [PresidiumController::class, 'store'])->name('presidium.store');
    Route::get('/presidium/{presidium}', [PresidiumController::class, 'show'])->name('presidium.show');
    Route::get('/presidium/{presidium}/edit', [PresidiumController::class, 'edit'])->name('presidium.edit');
    Route::put('/presidium/{presidium}', [PresidiumController::class, 'update'])->name('presidium.update');
    Route::delete('/presidium/{presidium}', [PresidiumController::class, 'destroy'])->name('presidium.destroy');

    // Emails
    Route::get('/emails', [ContactEmailController::class, 'index'])->name('emails.index');
    Route::get('/emails/{id}', [ContactEmailController::class, 'show'])->name('emails.show');
    Route::post('/emails/{id}/reply', [ContactEmailController::class, 'reply'])->name('emails.reply');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{id}/status', [UserController::class, 'updateStatus'])->name('users.update-status');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');




});




Route::get('/db-backup', function () {
        $db = env('DB_DATABASE');
        $tables = DB::select('SHOW TABLES');
        $key = "Tables_in_$db";
        $sql = '';
        foreach ($tables as $table) {
            $name = $table->$key;
            $sql .= "\n\n" . DB::select("SHOW CREATE TABLE `$name`")[0]->{'Create Table'} . ";\n\n";
            foreach (DB::table($name)->get() as $row) {
                $values = array_map(
                    fn($v) => isset($v) ? "'" . addslashes($v) . "'" : 'NULL',
                    (array) $row
                );
                $sql .= "INSERT INTO `$name` VALUES (" . implode(',', $values) . ");\n";
            }
        }
        return response($sql)
            ->header('Content-Type', 'application/sql')
            ->header('Content-Disposition', 'attachment; filename="db_backup_' . now()->format('Y-m-d_H-i-s') . '.sql"');
    });

    Route::get('/storage-backup', function () {
        $tar = storage_path('app/storage.tar');
        $phar = new PharData($tar);
        $phar->buildFromDirectory(storage_path('app/public'));
        $phar->compress(Phar::GZ);
        unlink($tar);
        return response()->download($tar . '.gz', 'storage_backup_' . now()->format('Y-m-d_H-i-s') . '.tar.gz')->deleteFileAfterSend(true);
    });

    Route::get('/storage-link', function () {
        Artisan::call('storage:link');
        return 'Storage link created successfully!';
    });

    Route::get('/seed-user', function () {
        Artisan::call('db:seed', ['--class' => 'Database\\Seeders\\UserSeeder']);
        return 'UserSeeder executed successfully!';
    });

    Route::get('/flush-system', function () {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $tables = DB::select('SHOW TABLES');
        $dbName = env('DB_DATABASE');
        $key = "Tables_in_$dbName";
        foreach ($tables as $table) {
            DB::table($table->$key)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Storage::disk('public')->deleteDirectory('/');
        Storage::disk('public')->makeDirectory('/');
        Artisan::call('optimize:clear');
        return 'Database flushed & images cleared successfully!';
    });

    Route::get('/clear-cache', function () {
        Artisan::call('optimize:clear');
        return 'Cache Cleared!';
    });