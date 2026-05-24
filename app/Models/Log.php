<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    protected $fillable = [
        'user_id',
        'service_id',
        'event_type',
        'ip',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    // Datos de reportes
    public function getBrowserAttribute()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "Desconocido";

        // Lista de navegadores y sus patrones (regex)
        $browsers = [
            '/Edge/i' => 'Edge',
            '/Edg/i' => 'Edge (Chromium)',
            '/Chrome/i' => 'Chrome',
            '/Firefox/i' => 'Firefox',
            '/Safari/i' => 'Safari',
            '/Opera/i' => 'Opera',
            '/Netscape/i' => 'Netscape',
            '/MSIE/i' => 'Internet Explorer',
            '/Trident/i' => 'Internet Explorer'
        ];

        foreach ($browsers as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
                break;
            }
        }

        return $browser;
    }

    public function getOsAttribute()
    {
        // Nombre del SO
        return php_uname('s');
    }

    public function getTipoAccesoAttribute()
    {
        // De donde viene el acceso(ip)
        return $this->ip;
    }
}
