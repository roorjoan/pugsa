<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Crea la tabla service_user para relacionar servicios y usuarios
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('service_user', function (Blueprint $table) {
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Llave primaria compuesta según el estándar de tablas pivote
            $table->primary(['service_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('service_user');
    }
};