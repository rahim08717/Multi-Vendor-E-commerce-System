<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function index()
    {

        $logs = ActivityLog::latest()->take(10)->get();

        
        return view('admin.dashboard', compact('logs'));
    }
}
