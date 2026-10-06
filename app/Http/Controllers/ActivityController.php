<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index(Request $request) {
        $activities = Activity::with([
            'shift',
            'employee'
        ])->get();
        if($request->wantsJson()) {
			return response()->json($activities);
		}
        return view('activities', compact('activities'));
    }

    public function show(Request $request, int $id) {
		$activity = Activity::find($id);

		if($request->wantsJson()) {
			if (!$activity) {
				return response()->json(['message' => 'Actividad no encontrado'], 404);
			}
			return response()->json($activity);
		}
		// No view assigned
		return $activity;
	}

	public function update(Request $request) {
		$validated = $request->validate([
			'id'            => ['required', 'int'],
			'name'          => ['required', 'string', 'max:255'],
			'shifts_id'     => ['required', 'integer', 'exists:shifts,id'],
			'activity_type' => ['required', Rule::in(['DAILY', 'EXTRA'])],
			'description'   => ['required', 'string'],
			'employees_id'  => ['nullable', 'integer', 'exists:employees,id'],
		]);
		$activity = Activity::find($validated['id']);
		$activity->update($validated);
		$activity2 = Activity::with([
            'shift',
            'employee'
        ])->findOrFail($validated['id']);
		return response()->json($activity2, 200);
	}

	public function store(Request $request) {
		$validated = $request->validate([
			'name'          => ['required', 'string', 'max:255'],
			'shifts_id'     => ['required', 'integer', 'exists:shifts,id'],
			'activity_type' => ['required', Rule::in(['DAILY', 'EXTRA'])],
			'description'   => ['required', 'string'],
			'employees_id'  => ['nullable', 'integer', 'exists:employees,id'],
		]);
		$activity = Activity::create($validated);
		return response()->json($activity, 200);
	}

	public function destroy(Activity $activity) {
		$activity->delete();
		return response()->noContent();
	}
}
