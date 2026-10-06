<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		Employee::create([
			'first_name' => 'Sofía',
			'middle_name' => '',
			'paternal_surename' => 'Luna',
			'maternal_surename' => '',
			'departments_id' => 1,
			'shifts_id' => 1,
			'phone' => '1234567890',
			'address' => 'Calle A #123, Col. Fake',
			'state' => 'ACTIVE'
		]);
		Employee::create([
			'first_name' => 'Jorge',
			'middle_name' => '',
			'paternal_surename' => 'Ríos',
			'maternal_surename' => '',
			'departments_id' => 1,
			'shifts_id' => 1,
			'phone' => '0987654321',
			'address' => 'Calle B #456, Col. Fake',
			'state' => 'ON_VACATIONS'
		]);
		Employee::create([
			'first_name' => 'Hector',
			'middle_name' => '',
			'paternal_surename' => 'Mora',
			'maternal_surename' => '',
			'departments_id' => 4,
			'shifts_id' => 3,
			'phone' => '0987654321',
			'address' => 'Calle B #456, Col. Fake',
			'state' => 'ABSENT'
		]);

		Employee::create([
			'first_name' => 'Gabriela',
			'middle_name' => '',
			'paternal_surename' => 'Peña',
			'maternal_surename' => '',
			'departments_id' => 1,
			'shifts_id' => 1,
			'phone' => '1234567890',
			'address' => 'Calle A #123, Col. Fake',
			'state' => 'ACTIVE'
		]);
		Employee::create([
			'first_name' => 'Carmen',
			'middle_name' => '',
			'paternal_surename' => 'Molina',
			'maternal_surename' => '',
			'departments_id' => 2,
			'shifts_id' => 1,
			'phone' => '0987654321',
			'address' => 'Calle B #456, Col. Fake',
			'state' => 'ON_VACATIONS'
		]);
		Employee::create([
			'first_name' => 'Esteban',
			'middle_name' => '',
			'paternal_surename' => 'Vidal',
			'maternal_surename' => '',
			'departments_id' => 4,
			'shifts_id' => 3,
			'phone' => '0987654321',
			'address' => 'Calle B #456, Col. Fake',
			'state' => 'ABSENT'
		]);
	}
}
