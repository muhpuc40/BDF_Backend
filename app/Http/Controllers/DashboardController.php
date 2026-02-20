<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\News;
use App\Models\Committee;
use App\Models\Announcement;
use App\Models\Hall;
use App\Models\Directory;
use App\Models\ContactEmail;
use App\Models\Presidium;
use App\Models\Advisor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get all counts
        $totalEvents = Event::count();
        $totalNews = News::count();
        $totalCommittees = Committee::count();
        $totalAnnouncements = Announcement::count();
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
                    'color' => 'success'
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
                    'color' => 'danger'
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

        // Recent Halls of Fame
        $recentHalls = Hall::latest()
            ->take($limit)
            ->get()
            ->map(function ($hall) {
                return [
                    'type' => 'Hall of Fame',
                    'title' => $hall->name,
                    'description' => 'New hall of Fame added: ' . $hall->name,
                    'created_at' => $hall->created_at,
                    'icon' => 'fas fa-trophy',
                    'color' => 'warning'
                ];
            });

        // Recent Club Directories
        $recentdirectories = Directory::latest()
            ->take($limit)
            ->get()
            ->map(function ($directories) {
                return [
                    'type' => 'Club Directory',
                    'title' => $directories->club_name,
                    'description' => 'New Club Directory added: ' . $directories->club_name,
                    'created_at' => $directories->created_at,
                    'icon' => 'fas fa-address-book',
                    'color' => 'primary'
                ];
            });

        // Recent Presidium Members
        $recentPresidium = Presidium::latest()
            ->take($limit)
            ->get()
            ->map(function ($presidium) {
                return [
                    'type' => 'Presidium',
                    'title' => $presidium->name,
                    'description' => 'New Presidium member added: ' . $presidium->name,
                    'created_at' => $presidium->created_at,
                    'icon' => 'fas fa-user-tie',
                    'color' => 'info'
                ];
            });

        // Recent Advisors
        $recentAdvisors = Advisor::latest()
            ->take($limit)
            ->get()
            ->map(function ($advisor) {
                return [
                    'type' => 'Advisor',
                    'title' => $advisor->name,
                    'description' => 'New Advisor added: ' . $advisor->name,
                    'created_at' => $advisor->created_at,
                    'icon' => 'fas fa-chalkboard-teacher',
                    'color' => 'secondary'
                ];
            });

        // Recent Contact Emails
        $recentEmails = ContactEmail::latest()
            ->take($limit)
            ->get()
            ->map(function ($email) {
                return [
                    'type' => 'Contact Email',
                    'title' => $email->subject ?? 'New Contact Message',
                    'description' => 'New message from: ' . $email->name . ' (' . $email->email . ')',
                    'created_at' => $email->created_at,
                    'icon' => 'fas fa-envelope',
                    'color' => 'info'
                ];
            });


        // Combine all activities
        $activities = $activities->merge($recentEvents)
            ->merge($recentNews)
            ->merge($recentAnnouncements)
            ->merge($recentCommittees)
            ->merge($recentHalls)
            ->merge($recentdirectories)
            ->merge($recentAdvisors)
            ->merge($recentPresidium)
            ->merge($recentEmails);

        // Sort by creation date (newest first) and take only specified limit
        return $activities->sortByDesc('created_at')->take($limit);
    }
}