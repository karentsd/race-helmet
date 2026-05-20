<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pqrs;

class PqrsSeeder extends Seeder
{
    public function run(): void
    {
        $registros = [
            ['nombres'=>'Carlos','apellidos'=>'Mendoza','correo'=>'carlos@ejemplo.com','rol'=>'Cliente','tipo_pqrs'=>'Felicitacion','comentario'=>'El AGV K6 llegó en perfectas condiciones. Excelente atención y envío rapidísimo. 100% recomendados.','estado'=>'resuelto'],
            ['nombres'=>'Laura','apellidos'=>'Ríos','correo'=>'laura@ejemplo.com','rol'=>'Cliente','tipo_pqrs'=>'Queja','comentario'=>'Tuve que esperar más de lo indicado para recibir mi casco HJC. Por favor mejorar los tiempos de despacho.','estado'=>'en_revision'],
            ['nombres'=>'Andrés','apellidos'=>'García','correo'=>'andres@ejemplo.com','rol'=>'Socio','tipo_pqrs'=>'Recomendacion','comentario'=>'Sería ideal tener una sección de accesorios: guantes, chaquetas y botas. Complementaría muy bien el catálogo.','estado'=>'pendiente'],
            ['nombres'=>'Juliana','apellidos'=>'Torres','correo'=>'juliana@ejemplo.com','rol'=>'Cliente','tipo_pqrs'=>'Felicitacion','comentario'=>'El Shark Spartan RS que compré es espectacular. La calidad es impresionante y el precio muy competitivo.','estado'=>'resuelto'],
        ];

        foreach ($registros as $r) {
            Pqrs::create($r);
        }

        $this->command->info('✅ PqrsSeeder: ' . count($registros) . ' registros creados.');
    }
}