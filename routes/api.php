<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CommitteeController;
use App\Http\Controllers\NewsAnnouncementController;
use App\Http\Controllers\HallController;

Route::get('/hall', [HallController::class, 'apiIndex']);

Route::get('/events', [EventController::class, 'apiIndex']);

Route::get('/committees', [CommitteeController::class, 'apiIndex']);

Route::get('/news', [NewsAnnouncementController::class, 'apiNews']);

Route::get('/announcements', [NewsAnnouncementController::class, 'apiAnnouncements']);

Route::get('/', function () {
    return response()->json([
        'status' => 'success',
        'message' => 'BDF API running',
        'host_info' => [
            'hostname' => gethostname(),

            'ip_address' => gethostbyname(gethostname()),
            'server_addr' => $_SERVER['SERVER_ADDR'] ?? 'N/A',
            'server_name' => $_SERVER['SERVER_NAME'] ?? 'N/A',
        ],
        'server_info' => [
            'php_version' => phpversion(),
            'laravel_version' => app()->version(),
            'os' => PHP_OS_FAMILY,
            'server_software' => $_SERVER['SERVER_SOFTWARE'] ?? 'N/A',
        ],
        'system_info' => [
            'memory_usage' => [
                'used' => round(memory_get_usage() / 1024 / 1024, 2) . ' MB',
                'peak' => round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB',
            ],
            'disk_space' => [
                'total' => round(disk_total_space('/') / 1024 / 1024 / 1024, 2) . ' GB',
                'free' => round(disk_free_space('/') / 1024 / 1024 / 1024, 2) . ' GB',
            ],
        ],
        'app_info' => [
            'app_name' => config('app.name'),
            'environment' => config('app.env'),
            'debug_mode' => config('app.debug') ? 'Enabled' : 'Disabled',
            'database_connected' => 'Connected',
        ],


        'timestamp' => now(),
        'Developer' => "Minhaj Uddin Hassan"
    ]);
});