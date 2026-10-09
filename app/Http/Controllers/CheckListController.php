<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Activity;
use App\Models\Checklist;

class CheckListController extends Controller
{
	public function index(Request $request) {
		$checklist = Checklist::query()
		->leftJoin('activities', 'checklist.activities_id', '=', 'activities.id')
		->select(
			'checklist.id AS checklist_id',
			'checklist.notes AS checklist_notes',
			'checklist.created_at AS checklist_created_at',
			'checklist.updated_at AS checklist_updated_at',
			'activities.id AS activities_id',
			'activities.name AS activities_name',
			'activities.shifts_id AS activities_shifts_id',
			'activities.activity_type AS activities_activity_type',
			'activities.description AS activities_description',
			'activities.employees_id AS activities_employees_id',
			'activities.departments_id AS activities_departments_id',
		)
		->orderBy('checklist.created_at', 'ASC')
		->get();
		if($request->wantsJson()) {
			return response()->json($checklist);
		}
		return view('checklist', compact('checklist'));
	}

	public function store(Request $request) {
		$validated = $request->validate([
			'activities_id'     => ['required', 'integer'],
			'notes'		     	=> ['required', 'string'],
		]);
		$checklist = Checklist::create($validated);
		return response()->json($checklist, 200);
	}

	public function todayNotes() {
		$checklist = Checklist::query()
		->whereDate('created_at', '<=', now()->toDateString())
		->whereDate('created_at', '>=', now()->toDateString())
		->get();
		return response()->json($checklist, 200);
	}
}
