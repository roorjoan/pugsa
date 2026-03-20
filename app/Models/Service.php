<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'type',
        'icon',
        'path',
        'description',
    ];

    // Relacion de muchos a muchos con usuario
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
