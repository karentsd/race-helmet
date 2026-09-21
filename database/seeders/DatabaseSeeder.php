<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Poblar la base de datos con datos de prueba.
     * Ejecutar con: php artisan db:seed
     */
    public function run(): void
    {
        $this->call([
            PqrsSeeder::class,
        ]);
    }
}