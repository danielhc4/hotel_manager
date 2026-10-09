<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Activity::create([
            'name'              => 'Revisar luces apagadas',
            'shifts_id'         => 1,
            'activity_type'     => 'DAILY',
            'description'       => 'Revisar que las luces estén apagadas',
            'employees_id'      => null,
            'departments_id'    => 3,
        ]);
        Activity::create([
            'name'              => 'Recibir carrito de servicio habilitado y limpio',
            'shifts_id'         => 1,
            'activity_type'     => 'DAILY',
            'description'       => 'Recibir y revisar que el carrito de servicio habilitado y limpio para su uso',
            'employees_id'      => 3,
            'departments_id'    => null,
        ]);
        Activity::create([
            'name'              => 'Limpiar departamento',
            'shifts_id'         => 2,
            'activity_type'     => 'EXTRA',
            'description'       => 'Realizar la limpieza del departamento',
            'employees_id'      => 1,
            'departments_id'    => 3,
        ]);
    }
}
