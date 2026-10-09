<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{

	public function index(Request $request) {
		$departments = Department::all();
		if($request->wantsJson()) {
			return response()->json($departments);
		}
		return view('departments', compact('departments'));
	}

	public function show(Request $request, int $id) {
		$department = Department::find($id);

		if($request->wantsJson()) {
			if (!$department) {
				return response()->json(['message' => 'Departamento no encontrado'], 404);
			}
			return response()->json($department);
		}
		// No view assigned
		return $department;
	}

	public function update(Request $request) {
		$validated = $request->validate([
			'id' 			=> ['required', 'int'],
			'name' 			=> ['required', 'string', 'min:3', 'max:100'],
			'description' 	=> ['required', 'string', 'min:3'],
		]);
		$department = Department::find($validated['id']);
		$department->update($validated);
		return response()->json($department, 200);
	}

	public function store(Request $request) {
		$validated = $request->validate([
			'name' => 'required|string|min:3|max:100',
			'description' => 'required|string|min:3',
		]);
		$department = Department::create($validated);
		return response()->json($department, 200);
	}

	public function destroy(Department $department) {
		$department->delete();
		return response()->noContent();
	}

}
