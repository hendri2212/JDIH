<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsCollection;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate();
        return new NewsCollection($news);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news = new News();
        $news->title = $request->title;
        $news->content = $request->content;
        if($request->has('is_published')){
            $news->is_published = $request->is_published;
        }else{
            $news->is_published = false;
        }
        $path = $request->file('photo')->storeAs('news', $news->slug.'.png', 'public');
        $news->photo = $path;
        // $news->id_user = Auth::id();
        $news->id_user = 1;
        $news->save();

        return response()->json("Berita berhasil di tambahkan", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);
        return response()->json($news, 200);
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
        // $validate = $request->validate([
        //     'title' => 'string',
        //     'content' => 'string',
        //     'photo' => 'image',
        //     'is_published' => 'boolean'
        // ]);
        // if($validate->fails()){
        //     return response()->json($validate->errors(), 200);
        // }
        $validator = Validator::make($request->all(), [
            'title' => 'string',
            'content' => 'string',
            'photo' => 'image',
            'is_published' => 'boolean'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $news = News::find($id);
        $old_photo = $news->photo;
        $news->title = $request->title;
        $news->content = $request->content;
        if($request->has('is_published')){
            $news->is_published = $request->is_published;
        }else{
            $news->is_published = false;
        }
        if($request->has('photo') && $request->photo != null){
            $path = $request->file('photo')->storeAs('news', $news->slug.'.png', 'public');
            $news->photo = $path;
        }

        if($old_photo != $news->photo) {
            Storage::delete($old_photo);
        }
        // $news->id_user = Auth::id();
        // $news->id_user = 1;
        $news->save();

        return response()->json("Berita berhasil di edit", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
