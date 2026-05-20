<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pqrs', function (Blueprint $table) {
            $table->id();
            $table->string('nombres',      100);
            $table->string('apellidos',    100);
            $table->string('correo',       180);
            $table->enum('rol',       ['Cliente', 'Socio', 'Empleado'])->default('Cliente');
            $table->enum('tipo_pqrs', ['Queja', 'Felicitacion', 'Recomendacion'])->default('Queja');
            $table->text('comentario');
            $table->enum('estado',    ['pendiente', 'en_revision', 'resuelto'])->default('pendiente');
            $table->ipAddress('ip_remitente')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pqrs');
    }
};