<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Employee;

class EmployeeController extends Controller
{
	
	public function index(Request $request) {
		if($request->wantsJson()) {
			if($request->input('campo') !== null && $request->input('q') !== null ) {
				$validated = $request->validate([
					'campo' => ['required', 'in:departments_id,shifts_id,first_name,middle_name,paternal_surename,maternal_surename,phone'],
					'q'     => ['required', 'string'],
				]);
				$employees = Employee::with([
					'department',
					'shift'
				])->where($validated['campo'], '=', $validated['q'])->get();
				return response()->json($employees);
			}
			else {
				$employees = Employee::with([
					'department',
					'shift'
				])->get();
				return response()->json($employees);
			}
		}
		return view('employees');

	}

	public function show(Request $request, int $id) {
		$employee = Employee::with([
			'department',
			'shift'
		])->find($id);

		if($request->wantsJson()) {
			if (!$employee) {
				return response()->json(['message' => 'Empleado no encontrado'], 404);
			}
			return response()->json($employee);
		}
		// No view assigned
		return $employee;
	}

	public function update(Request $request) {
		$validated = $request->validate([
			'id'                => ['required', 'int'],
			'first_name'        => ['required', 'string', 'max:256'],
			'middle_name'       => ['nullable', 'string', 'max:256'],
			'paternal_surename' => ['required', 'string', 'max:256'],
			'maternal_surename' => ['required', 'string', 'max:256'],
			'departments_id'    => ['required', 'integer', 'exists:departments,id'],
			'shifts_id'         => ['required', 'integer', 'exists:shifts,id'],
			'phone'             => ['required', 'string', 'digits:10'],
			'address'           => ['nullable', 'string', 'max:256'],
			'state'             => ['required', Rule::in(['ACTIVE', 'ON_VACATIONS', 'ABSENT'])],
		]);
		$employee = Employee::find($validated['id']);
		$employee->update($validated);
		$employee2 = Employee::with([
			'department',
			'shift'
		])->findOrFail($validated['id']);
		return response()->json($employee2, 200);
	}

	public function store(Request $request) {
		$validated = $request->validate([
			'first_name'        => ['required', 'string', 'max:256'],
			'middle_name'       => ['nullable', 'string', 'max:256'],
			'paternal_surename' => ['required', 'string', 'max:256'],
			'maternal_surename' => ['required', 'string', 'max:256'],
			'departments_id'    => ['required', 'integer', 'exists:departments,id'],
			'shifts_id'         => ['required', 'integer', 'exists:shifts,id'],
			'phone'             => ['required', 'string', 'digits:10'],
			'address'           => ['nullable', 'string', 'max:256'],
			'state'             => ['required', Rule::in(['ACTIVE', 'ON_VACATIONS', 'ABSENT'])],
		]);
		$employee = Employee::create($validated);
		return response()->json($employee, 200);
	}

	public function destroy(Employee $employee) {
		$employee->delete();
		return response()->noContent();
	}

}
