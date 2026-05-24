<?php

namespace App\Listeners;

use App\Events\ServiceAccessed;
use App\Models\Log;
use Illuminate\Support\Facades\Request;

class LogServiceAccess
{
    public function handle(ServiceAccessed $event): void
    {
        Log::create([
            'user_id'    => auth()->id(),
            'service_id' => $event->service->id,
            'event_type' => $event->eventType,
            'ip'         => Request::ip(),
        ]);
    }
}
