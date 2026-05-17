<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Crea la tabla domain_account_requests para solicitudes de cuenta de dominio
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domain_account_requests', function (Blueprint $table) {
            $table->id(); // bigint PK
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('approved_by', 100)->nullable(); // Se marca nullable por lógica de negocio inicial
            $table->string('status', 50)->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domain_account_requests');
    }
};