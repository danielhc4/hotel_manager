<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shift::factory()->create([
            'name' => 'Primer turno día',
            'monday_shift_entry' => null,
            'monday_shift_ending' => null,
            'tuesday_shift_entry' => null,
            'tuesday_shift_ending' => null,
            'wednesday_shift_entry' => '05:00:00',
            'wednesday_shift_ending' => '13:00:00',
            'thursday_shift_entry' => '05:00:00',
            'thursday_shift_ending' => '13:00:00',
            'friday_shift_entry' => '05:00:00',
            'friday_shift_ending' => '13:00:00',
            'saturday_shift_entry' => '05:00:00',
            'saturday_shift_ending' => '13:00:00',
            'sunday_shift_entry' => '05:00:00',
            'sunday_shift_ending' => '13:00:00'
        ]);
        Shift::factory()->create([
            'name' => 'Segundo turno día',
            'monday_shift_entry' => null,
            'monday_shift_ending' => null,
            'tuesday_shift_entry' => null,
            'tuesday_shift_ending' => null,
            'wednesday_shift_entry' => '13:00:00',
            'wednesday_shift_ending' => '21:00:00',
            'thursday_shift_entry' => '13:00:00',
            'thursday_shift_ending' => '21:00:00',
            'friday_shift_entry' => '13:00:00',
            'friday_shift_ending' => '21:00:00',
            'saturday_shift_entry' => '13:00:00',
            'saturday_shift_ending' => '21:00:00',
            'sunday_shift_entry' => '13:00:00',
            'sunday_shift_ending' => '21:00:00'
        ]);
        Shift::factory()->create([
            'name' => 'Turno noche',
            'monday_shift_entry' => '21:00:00',
            'monday_shift_ending' => '05:00:00',
            'tuesday_shift_entry' => '21:00:00',
            'tuesday_shift_ending' => '05:00:00',
            'wednesday_shift_entry' => '21:00:00',
            'wednesday_shift_ending' => '05:00:00',
            'thursday_shift_entry' => '21:00:00',
            'thursday_shift_ending' => '05:00:00',
            'friday_shift_entry' => '21:00:00',
            'friday_shift_ending' => '05:00:00',
            'saturday_shift_entry' => '21:00:00',
            'saturday_shift_ending' => '05:00:00',
            'sunday_shift_entry' => '21:00:00',
            'sunday_shift_ending' => '05:00:00'
        ]);
    }
}
