<?php

namespace App\Events;

use App\Models\Service;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ServiceAccessed
{
    use Dispatchable, SerializesModels;

    public $service;
    public $eventType;

    public function __construct(Service $service, string $eventType = 'Acceso a servicio')
    {
        $this->service = $service;
        $this->eventType = $eventType;
    }
}
