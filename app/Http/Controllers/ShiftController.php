<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function index(Request $request) {
        if($request->wantsJson()) {
            if($request->input('campo') !== null && $request->input('q') !== null ) {
                $validated = $request->validate([
					'campo' => ['required', 'in:name,monday_shift_entry,monday_shift_ending,tuesday_shift_entry,tuesday_shift_ending,wednesday_shift_entry,wednesday_shift_ending,thursday_shift_entry,thursday_shift_ending,friday_shift_entry,friday_shift_ending,saturday_shift_entry,saturday_shift_ending,sunday_shift_entry,sunday_shift_ending'],
					'q'     => ['required', 'string'],
				]);
                $shifts = Shift::query()
                ->where($validated['campo'], '=', $validated['q'])
                ->get();
                return response()->json($shifts);
            }
            else {
                $shifts = Shift::all();
                return response()->json($shifts);
            }
		}
        return view('shifts');
    }

    public function show(Request $request, int $id) {
		$shift = Shift::find($id);
		if($request->wantsJson()) {
			if (!$shift) {
				return response()->json(['message' => 'Departamento no encontrado'], 404);
			}
			return response()->json($shift);
		}
		return $shift;
	}

	public function update(Request $request) {
		$validated = $request->validate([
			'id' => 'required|int',
			'name' => 'required|string',
			'monday_shift_entry' => 'nullable|date_format:H:i:s',
            'monday_shift_ending' => 'nullable|date_format:H:i:s',
            'tuesday_shift_entry' => 'nullable|date_format:H:i:s',
            'tuesday_shift_ending' => 'nullable|date_format:H:i:s',
            'wednesday_shift_entry' => 'nullable|date_format:H:i:s',
            'wednesday_shift_ending' => 'nullable|date_format:H:i:s',
            'thursday_shift_entry' => 'nullable|date_format:H:i:s',
            'thursday_shift_ending' => 'nullable|date_format:H:i:s',
            'friday_shift_entry' => 'nullable|date_format:H:i:s',
            'friday_shift_ending' => 'nullable|date_format:H:i:s',
            'saturday_shift_entry' => 'nullable|date_format:H:i:s',
            'saturday_shift_ending' => 'nullable|date_format:H:i:s',
            'sunday_shift_entry' => 'nullable|date_format:H:i:s',
            'sunday_shift_ending' => 'nullable|date_format:H:i:s',
		]);
		$shift = Shift::find($validated['id']);
		$shift->update($validated);
		return response()->json($shift, 200);
	}

	public function store(Request $request) {
		$validated = $request->validate([
			'name' => 'required|string',
			'monday_shift_entry' => 'nullable|date_format:H:i:s',
            'monday_shift_ending' => 'nullable|date_format:H:i:s',
            'tuesday_shift_entry' => 'nullable|date_format:H:i:s',
            'tuesday_shift_ending' => 'nullable|date_format:H:i:s',
            'wednesday_shift_entry' => 'nullable|date_format:H:i:s',
            'wednesday_shift_ending' => 'nullable|date_format:H:i:s',
            'thursday_shift_entry' => 'nullable|date_format:H:i:s',
            'thursday_shift_ending' => 'nullable|date_format:H:i:s',
            'friday_shift_entry' => 'nullable|date_format:H:i:s',
            'friday_shift_ending' => 'nullable|date_format:H:i:s',
            'saturday_shift_entry' => 'nullable|date_format:H:i:s',
            'saturday_shift_ending' => 'nullable|date_format:H:i:s',
            'sunday_shift_entry' => 'nullable|date_format:H:i:s',
            'sunday_shift_ending' => 'nullable|date_format:H:i:s',
		]);
		$department = Shift::create($validated);
		return response()->json($department, 200);
	}

    public function destroy(Shift $shift) {
		$shift->delete();
		return response()->noContent();
	}

    public function activeShifts() {
        $entry = '';
        $ending = '';
        switch(date('w')) {
            case 0:
                $entry = 'sunday_shift_entry';
                $ending = 'sunday_shift_ending';
            break;
            case 1:
                $entry = 'monday_shift_entry';
                $ending = 'monday_shift_ending';
            break;
            case 2:
                $entry = 'tuesday_shift_entry';
                $ending = 'tuesday_shift_ending';
            break;
            case 3:
                $entry = 'wednesday_shift_entry';
                $ending = 'wednesday_shift_ending';
            break;
            case 4:
                $entry = 'thursday_shift_entry';
                $ending = 'thursday_shift_ending';
            break;
            case 5:
                $entry = 'friday_shift_entry';
                $ending = 'friday_shift_ending';
            break;
            case 6:
                $entry = 'saturday_shift_entry';
                $ending = 'saturday_shift_ending';
            break;
        }
        
        // Daylight shifts 
        $day_shifts = Shift::query()
        ->whereColumn($entry, '<', $ending)
        ->whereTime($entry, '<=', now()->format('H:i:s'))
        ->whereTime($ending, '>=', now()->format('H:i:s'))
        ->get();

        // Night shifts
        $night_shifts = Shift::query()
        ->whereColumn($entry, '>', $ending)
        ->whereTime($ending, '>', now()->format('H:i:s'))
        ->get();

        return $day_shifts->merge($night_shifts);
    }

    public function expiredShift() {
        $entry1 = '';
        $ending1 = '';
        switch(date('w')) {
            case 0:
                $entry1 = 'sunday_shift_entry';
                $ending1 = 'sunday_shift_ending';
            break;
            case 1:
                $entry1 = 'monday_shift_entry';
                $ending1 = 'monday_shift_ending';
            break;
            case 2:
                $entry1 = 'tuesday_shift_entry';
                $ending1 = 'tuesday_shift_ending';
            break;
            case 3:
                $entry1 = 'wednesday_shift_entry';
                $ending1 = 'wednesday_shift_ending';
            break;
            case 4:
                $entry1 = 'thursday_shift_entry';
                $ending1 = 'thursday_shift_ending';
            break;
            case 5:
                $entry1 = 'friday_shift_entry';
                $ending1 = 'friday_shift_ending';
            break;
            case 6:
                $entry1 = 'saturday_shift_entry';
                $ending1 = 'saturday_shift_ending';
            break;
        }

        $entry2 = '';
        $ending2 = '';
        switch(date('w')) {
            case 0:
                $entry2 = 'saturday_shift_entry';
                $ending2 = 'saturday_shift_ending';
            break;
            case 1:
                $entry2 = 'sunday_shift_entry';
                $ending2 = 'sunday_shift_ending';
            break;
            case 2:
                $entry2 = 'monday_shift_entry';
                $ending2 = 'monday_shift_ending';
            break;
            case 3:
                $entry2 = 'tuesday_shift_entry';
                $ending2 = 'tuesday_shift_ending';
            break;
            case 4:
                $entry2 = 'wednesday_shift_entry';
                $ending2 = 'wednesday_shift_ending';
            break;
            case 5:
                $entry2 = 'thursday_shift_entry';
                $ending2 = 'thursday_shift_ending';
            break;
            case 6:
                $entry2 = 'friday_shift_entry';
                $ending2 = 'friday_shift_ending';
            break;
        }

        $shifts1 = Shift::query()
        ->whereColumn($entry1, '<', $ending1)
        ->whereTime($ending1, '<', now()->format('H:i:s'))
        ->get();

        $shifts2 = Shift::query()
        ->whereColumn($entry2, '>', $ending2)
        ->whereTime($ending2, '<', now()->format('H:i:s'))
        ->get();

        return $shifts2->union($shifts1);
    }
}
