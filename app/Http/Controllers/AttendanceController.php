<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index() {
        return view('attandance');
    }

    public function update(Request $request) {
		$validated = $request->validate([
			'id' 			=> ['required', 'int'],
			'employees_id'  => ['required', 'integer'],
			'entry'         => ['required', 'date_format:Y-m-d H:i:s'],
            'ending'        => ['required', 'date_format:Y-m-d H:i:s'],
		]);
		$department = Attendance::find($validated['id']);
		$department->update($validated);
		return response()->json($department, 200);
	}


    public function store(Request $request) {
        $validated = $request->validate([
			'employees_id'  => ['required', 'integer'],
			'entry'         => ['required', 'date_format:Y-m-d H:i:s'],
            'ending'        => ['required', 'date_format:Y-m-d H:i:s'],
		]);
		$attendance = Attendance::create($validated);
		return response()->json($attendance, 200);
    }

    public function getAttendanceEmployee(Request $request) {
        $start = $request->input('date') . ' 00:00:00';
        $end = $request->input('date') . ' 23:59:59';

        return Attendance::query()
        ->where('employees_id', '=', $request->input('employees_id'))
        ->whereBetween('entry', [$start, $end])
        ->get();
    }
}
