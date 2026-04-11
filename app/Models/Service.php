<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

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
