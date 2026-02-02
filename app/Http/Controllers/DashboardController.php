<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        Log::info('Dashboard accessed', [
            'ip_address' => $request->ip(),
            'Timestamp' => now(),
        ]);
        return view('dashboard');




    }

    
}