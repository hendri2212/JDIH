<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\WorkPlanCollection;
use App\Http\Resources\WorkPlanResource;
use App\Models\WorkPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WorkPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        $search = $request->has('search') ? $request->get('search') : '';
        if($per_page != 15 && $per_page != 25 && $per_page != 50){
            $per_page = 15;
        }
        $work_plan = WorkPlan::where('title', 'like', '%'.$search.'%')->orderBy('created_at', 'desc')->paginate($per_page);
        return new WorkPlanCollection($work_plan);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'id_user' => 'required|exists:users,id_user'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $work_plan = new WorkPlan;
        $work_plan->title = $request->title;
        $work_plan->content = $request->content;
        $work_plan->id_user = $request->id_user;
        $work_plan->save();
        return response()->json('Sukses menambah program kerja', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $work_plan = WorkPlan::find($id);
        return response()->json(new WorkPlanResource($work_plan), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'content' => 'required|string',
            'id_user' => 'required|exists:users,id_user',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $work_plan = WorkPlan::find($id);
        if(!$work_plan){
            return response()->json('Program kerja tidak ditemukan', 404);
        }
        $work_plan->title = $request->title;
        $work_plan->content = $request->content;
        $work_plan->id_user = $request->id_user;
        $work_plan->save();
        return response()->json('Sukses menambah program kerja', 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work_plan = WorkPlan::find($id);
        if(!$work_plan){
            return response()->json('Program kerja tidak ditemukan', 404);
        }
        $work_plan->delete();
        return response()->json('Sukses menghapus program kerja', 200);
    }
}
