<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class LogAuthEvents
{
    public function handle($event)
    {
        if ($event instanceof Login) {
            ActivityLog::create([
                'user_id'     => $event->user->id,
                'name'        => $event->user->name,
                'role'        => $event->user->role,
                'description' => 'User Logged In',
            ]);
        }

        if ($event instanceof Logout && $event->user) {
            ActivityLog::create([
                'user_id'     => $event->user->id,
                'name'        => $event->user->name,
                'role'        => $event->user->role,
                'description' => 'User Logged Out',
            ]);
        }
    }
}
