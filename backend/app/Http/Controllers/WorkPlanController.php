<?php

namespace App\Http\Controllers;

use App\Models\WorkPlan;
use Illuminate\Http\Request;

class WorkPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workPlan = WorkPlan::orderBy('created_at', 'desc')->get()->take(5);
        return response()->json($workPlan, 200);
    }
}
