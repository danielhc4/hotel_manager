<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shift;

class ShiftController extends Controller
{
    public function index(Request $request) {
        $shifts = Shift::all();
        if($request->wantsJson()) {
			return response()->json($shifts);
		}
        return view('shifts', compact('shifts'));
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
}
