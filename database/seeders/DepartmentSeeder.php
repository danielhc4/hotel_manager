<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'Lavandería',
            'description' => 'Departamento encargado del lavado de la ropa de cama'
        ]);
        Department::create([
            'name' => 'Ayudante',
            'description' => 'Personal encargado de las actividades diarias'
        ]);
        Department::create([
            'name' => 'Jefe de turno',
            'description' => 'Encargado del personal y actividades de su turno'
        ]);
        Department::create([
            'name' => 'Auxiliar',
            'description' => 'Personal auxiliar en las actividades del jefe de turno'
        ]);
    }
}
