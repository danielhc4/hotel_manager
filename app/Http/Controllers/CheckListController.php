<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Activity;

class CheckListController extends Controller
{
    public function index(Request $request) {

		$departments = Department::all();
		$daily_activities = Activity::where('activity_type', 'DAILY')->get();
		$extra_activities = Activity::where('activity_type', 'EXTRA')->get();

		if($request->wantsJson()) {
			return response()->json($departments);
		}
		return view('checklist', compact('extra_activities'));
    }
}
