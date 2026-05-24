<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Crea la tabla services para almacenar los servicios
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id(); // bigint PK
            $table->string('name', 255);
            $table->enum('type', ['web', 'remoto']);
            $table->string('icon', 255)->nullable();
            $table->string('path', 255);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};