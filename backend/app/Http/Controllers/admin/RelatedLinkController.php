<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\RelatedLinkResource;
use App\Models\RelatedLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RelatedLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $related_links = RelatedLink::paginate();
        return response()->json(RelatedLinkResource::collection($related_links), 200);
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
            'link' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $related_link = new RelatedLink;
        $related_link->title = $request->title;
        $related_link->link = $request->link;
        $related_link->save();
        return response()->json("Succesfully to add Related Link", 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(new RelatedLinkResource(RelatedLink::find($id)));
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
            'link' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $related_link = RelatedLink::find($id);
        $related_link->title = $request->title;
        $related_link->link = $request->link;
        $related_link->save();
        return response()->json("Succesfully to update Related Link", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $related_link = RelatedLink::find($id);
        if($related_link != null){
            $related_link->delete();
        }
        return response()->json("Succesfully to delete Related Link", 200);
    }
}
