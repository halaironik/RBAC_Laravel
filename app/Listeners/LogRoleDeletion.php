<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use App\Events\RoleDeleted;

class LogRoleDeletion
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RoleDeleted $event): void
    {
        DB::table('activity_logs')->insert([
            'action' => 'delete',
            'role_name' => $event->role->name,
            'user_id' => $event->user->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
