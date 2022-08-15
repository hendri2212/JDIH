<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class TagController extends Controller
{
    public function index(Request $request){
        $per_page = $request->get('per_page');
        $search = $request->has('search') ? $request->get('search') : '';
        if($per_page != 15 && $per_page != 25 && $per_page != 50){
            $per_page = 15;
        }
        $tags = Tag::where('title', 'like', '%'.$search.'%')->paginate($per_page);
        return new TagCollection($tags);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:tags',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $tag = new Tag;
        $tag->title = $request->title;
        $tag->save();
        return response()->json('Sukses menambah tag', 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::find($id);
        return response()->json(new TagResource($tag), 200);
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
            'title' => 'required|string|unique:tags',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $tag = Tag::find($id);
        if(!$tag){
            return response()->json('Tag tidak ditemukan', 404);
        }
        $tag->title = $request->title;
        $tag->save();
        return response()->json('Sukses mengubah tag', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        if(!$tag){
            return response()->json('Tag tidak ditemukan', 404);
        }
        $tag->delete();
        return response()->json('Sukses menghapus tag', 200);
    }
}
