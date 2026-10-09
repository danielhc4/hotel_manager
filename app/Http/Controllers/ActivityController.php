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
            'employee',
			'department'
        ])->get();
        if($request->wantsJson()) {
			return response()->json($activities);
		}
		
        return view('activities');
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
			'id'            	=> ['required', 'int'],
			'name'          	=> ['required', 'string', 'max:255'],
			'shifts_id'     	=> ['required', 'integer', 'exists:shifts,id'],
			'activity_type' 	=> ['required', Rule::in(['DAILY', 'EXTRA'])],
			'description'   	=> ['required', 'string'],
			'employees_id'  	=> ['nullable', 'integer', 'exists:employees,id'],
			'departments_id' 	=> ['nullable', 'integer', 'exists:departments,id'],
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
			'name'          	=> ['required', 'string', 'max:255'],
			'shifts_id'     	=> ['required', 'integer', 'exists:shifts,id'],
			'activity_type' 	=> ['required', Rule::in(['DAILY', 'EXTRA'])],
			'description'   	=> ['required', 'string'],
			'employees_id'  	=> ['nullable', 'integer', 'exists:employees,id'],
			'departments_id'	=> ['nullable', 'integer', 'exists:departments,id'],
		]);
		$activity = Activity::create($validated);
		return response()->json($activity, 200);
	}

	public function destroy(Activity $activity) {
		$activity->delete();
		return response()->noContent();
	}

	public function activitiesGroupedByShiftsDepts() {

		$activities = Activity::with([
            'shift',
            'employee',
			'department'
        ])->get();

		$activities_by_department = [];
		for($i = 0; $i < count($activities); $i++) {
			// Si es general
			if($activities[$i]['departments_id'] == null) {

				// Si activities_2 no tiene objeto inicial
				if(count($activities_by_department) == 0) {

					array_push($activities_by_department, [
						'department' => 'General',
						'activities' => [$activities[$i]],
					]);

					}
				else {
					$found = false;
					for($j = 0; $j < count($activities_by_department); $j++) {
						if($activities_by_department[$j]['department'] == 'General' ) {
							array_push($activities_by_department[$j]['activities'], $activities[$i]); 
							$found = true;
							break;
						}
					}
					if(!$found) {
						array_push($activities_by_department, [
							'department' => 'General',
							'activities' => [$activities[$i]],
						]);
					}
				}
			}

			// Si tiene departamento
			else {

				// Si activities_2 no tiene objeto inicial
				if(count($activities_by_department) == 0) {
					array_push($activities_by_department, [
						'department' => $activities[$i]['department']['name'],
						'activities' => [$activities[$i]],
					]);
				}

				else {
					$found = false;
					for($j = 0; $j < count($activities_by_department); $j++) {
						if($activities_by_department[$j]['department'] == $activities[$i]['department']['name'] ) {
							array_push($activities_by_department[$j]['activities'], $activities[$i]); 
							$found = true;
							break;
						}
					}
					if(!$found) {
						array_push($activities_by_department, [
							'department' => $activities[$i]['department']['name'],
							'activities' => [$activities[$i]],
						]);
					}
				}
			}

		}



		$department_by_shifts = [];
		for($i = 0; $i < count($activities_by_department); $i++) {

			if(count($department_by_shifts) == 0) {

				$department_by_shifts[count($department_by_shifts)] = [
					'department' => $activities_by_department[$i]['department'],
					'shifts' => [
						[
							'name' => $activities_by_department[$i]['activities'][0]['shift']['name'],
							'id' => $activities_by_department[$i]['activities'][0]['shift']['id'],
							'activities' => [$activities_by_department[$i]['activities'][0]],
						]
					]
				];


				for($j = 1; $j < count($activities_by_department[$i]['activities']); $j++) {

					for($k = 0; $k < count($department_by_shifts); $k++) {
						if($department_by_shifts[$k]['department'] == $activities_by_department[$i]['department']) {
							$shift_found = false;
							for($l = 0; $l < count($department_by_shifts[$k]['shifts']); $l++) {
								if($department_by_shifts[$k]['shifts'][$l]['name'] == $activities_by_department[$i]['activities'][$j]['shift']['name']) {
									$shift_found = true;
									$department_by_shifts[$k]['shifts'][$l]['activities'][count($department_by_shifts[$k]['shifts'][$l]['activities'])] = $activities_by_department[$i]['activities'][$j];
									break;
								}
							}
							if(!$shift_found) {
								$department_by_shifts[$k]['shifts'][count($department_by_shifts[$k]['shifts'])] = [
									'name' => $activities_by_department[$i]['activities'][$j]['shift']['name'],
									'id' => $activities_by_department[$i]['activities'][$j]['shift']['id'],
									'activities' => [$activities_by_department[$i]['activities'][$j]]
								];
							}
						}
					}

				}

			}

			else {

				$department_found = false;

				for($j = 0; $j < count($department_by_shifts); $j++) {
					if($activities_by_department[$i]['department'] == $department_by_shifts[$j]['department']) {
						$department_found = true;
						for($k = 0; $k < count($activities_by_department[$i]['activities']); $k++) {

							$shift_found = false;
							for($l = 0; $l < count($department_by_shifts[$j]['shifts']); $l++) {
								if($activities_by_department[$i]['activities'][$k]['shift']['name'] == $department_by_shifts[$j]['shifts'][$l]['name']) {
									$shift_found = true;
									$department_by_shifts[$j]['shifts'][$l]['activities'][count($department_by_shifts[$j]['shifts'][$l]['activities'])] = $activities_by_department[$i]['activities'][$k];
								}
							}
							if(!$shift_found) {
								$department_by_shifts[$j]['shifts'][count($department_by_shifts[$j]['shifts'])] = [
									'name' => $activities_by_department[$i]['activities'][$k]['shift']['name'],
									'id' => $activities_by_department[$i]['activities'][$k]['shift']['id'],
									'activities' => [$activities_by_department[$i]['activities'][$k]]
								];
							}
						}
					}
				}

				if(!$department_found) {

					$department_by_shifts[count($department_by_shifts)] = [
						'department' => $activities_by_department[$i]['department'],
						'shifts' => [
							[
								'name' => $activities_by_department[$i]['activities'][0]['shift']['name'],
								'id' => $activities_by_department[$i]['activities'][0]['shift']['id'],
								'activities' => [$activities_by_department[$i]['activities'][0]]
							]
						]
					];

					for($j = 1; $j < count($activities_by_department[$i]['activities']); $j++) {

						for($k = 0; $k < count($department_by_shifts); $k++) {
							if($department_by_shifts[$k]['department'] == $activities_by_department[$i]['department']) {
								$shift_found = false;
								for($l = 0; $l < count($department_by_shifts[$k]['shifts']); $l++) {
									if($department_by_shifts[$k]['shifts'][$l]['name'] == $activities_by_department[$i]['activities'][$j]['shift']['name']) {
										$shift_found = true;
										$department_by_shifts[$k]['shifts'][$l]['activities'][count($department_by_shifts[$k]['shifts'][$l]['activities'])] = $activities_by_department[$i]['activities'][$j];
										break;
									}
								}
								if(!$shift_found) {
									$department_by_shifts[$k]['shifts'][count($department_by_shifts[$k]['shifts'])] = [
										'name' => $activities_by_department[$i]['activities'][$j]['shift']['name'],
										'id' => $activities_by_department[$i]['activities'][$j]['shift']['id'],
										'activities' => [$activities_by_department[$i]['activities'][$j]]
									];
								}
							}
						}

					}
				}
			}

		}

		return $department_by_shifts;
	}
}
