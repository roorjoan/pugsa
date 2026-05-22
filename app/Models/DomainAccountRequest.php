<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainAccountRequest extends Model
{
    /**
     * Los atributos que son asignables en masa.
     */
    protected $fillable = [
        'user_id',
        'approved_by',
        'status',
    ];

    /**
     * Relación: Una solicitud pertenece a un usuario.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Helpers para estados del modelo (opcional, mejora la legibilidad en vistas)
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
