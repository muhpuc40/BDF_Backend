<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\News;
use App\Models\Committee;
use App\Models\Announcement;
use App\Models\Hall;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        Log::info('Dashboard accessed', [
            'ip_address' => $request->ip(),
            'Timestamp' => now(),
        ]);
        
        // Get all counts
        $totalEvents = Event::count();
        $totalNews = News::count();
        $totalCommittees = Committee::count();
        $totalAnnouncements = Announcement::count();
        // $totalUsers = User::count(); // Uncomment when you implement users
        
        // Get upcoming events (events with date >= today)
        $upcomingEvents = Event::where('date', '>=', Carbon::today())
            ->where('status', 'active') // Assuming you have a status field
            ->count();
        
        // Get recent activities - combine from different models
        $recentActivities = $this->getRecentActivities();
        
        return view('dashboard', compact(
            'totalEvents',
            'totalNews',
            'totalCommittees',
            'totalAnnouncements',
            'upcomingEvents',
            'recentActivities'
        ));
    }
    
    private function getRecentActivities($limit = 5)
    {
        $activities = collect();
        
        // Recent events
        $recentEvents = Event::latest()
            ->take($limit)
            ->get()
            ->map(function ($event) {
                return [
                    'type' => 'Event',
                    'title' => $event->title,
                    'description' => 'New event created: ' . $event->title,
                    'created_at' => $event->created_at,
                    'icon' => 'fas fa-calendar',
                    'color' => 'primary'
                ];
            });
        
        // Recent news
        $recentNews = News::latest()
            ->take($limit)
            ->get()
            ->map(function ($news) {
                return [
                    'type' => 'News',
                    'title' => $news->title,
                    'description' => 'New news published: ' . $news->title,
                    'created_at' => $news->created_at,
                    'icon' => 'fas fa-newspaper',
                    'color' => 'info'
                ];
            });
        
        // Recent announcements
        $recentAnnouncements = Announcement::latest()
            ->take($limit)
            ->get()
            ->map(function ($announcement) {
                return [
                    'type' => 'Announcement',
                    'title' => $announcement->title,
                    'description' => 'New announcement: ' . $announcement->title,
                    'created_at' => $announcement->created_at,
                    'icon' => 'fas fa-bullhorn',
                    'color' => 'warning'
                ];
            });
        
        // Recent committees
        $recentCommittees = Committee::latest()
            ->take($limit)
            ->get()
            ->map(function ($committee) {
                return [
                    'type' => 'Committee',
                    'title' => $committee->name,
                    'description' => 'New committee member added: ' . $committee->name,
                    'created_at' => $committee->created_at,
                    'icon' => 'fas fa-users',
                    'color' => 'success'
                ];
            });


        $recentHalls = Hall::latest()
            ->take($limit)
            ->get()
            ->map(function ($hall) {
                return [
                    'type' => 'Hall of Fame',
                    'title' => $hall->name,
                    'description' => 'New hall of Fame added: ' . $hall->name,
                    'created_at' => $hall->created_at,
                    'icon' => 'fas fa-building',
                    'color' => 'secondary'
                ];
            });
        
        // Combine all activities
        $activities = $activities->merge($recentEvents)
            ->merge($recentNews)
            ->merge($recentAnnouncements)
            ->merge($recentCommittees)
            ->merge($recentHalls);
        
        // Sort by creation date (newest first) and take only specified limit
        return $activities->sortByDesc('created_at')->take($limit);
    }
}