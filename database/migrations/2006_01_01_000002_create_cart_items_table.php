<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->string('session_id',      100)->index();
            $table->string('producto_nombre', 150);
            $table->string('producto_imagen', 150)->nullable();
            $table->string('producto_emoji',   10)->default('🪖');
            $table->string('producto_bg',      200)->nullable();
            $table->decimal('precio', 12, 0);
            $table->unsignedSmallInteger('cantidad')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};