<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        $search = $request->has('search') ? $request->get('search') : '';
        if($per_page != 15 && $per_page != 25 && $per_page != 50){
            $per_page = 15;
        }
        $news = News::where('title', 'like', '%'.$search.'%')->orderBy('created_at', 'desc')->paginate($per_page);
        return new NewsCollection($news);
    }

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
        $tag_id = $this->getTags($request->tags);
        $news->tags()->sync($tag_id);

        return response()->json("Berita berhasil di tambahkan", 201);
    }

    public function show($id)
    {
        $news = News::find($id);
        return response()->json(new NewsResource($news), 200);
    }

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
        $tag_id = $this->getTags($request->tags);
        $news->tags()->sync($tag_id);

        return response()->json("Berita berhasil di edit", 200);
    }

    public function destroy($id)
    {
        
    }

    private function getTags($tags){
        $tagJson = json_decode($tags);
        $tagTitles = array_column($tagJson, "value"); 
        $tag_id = [];
        foreach($tagTitles as $tagTitle) {
            $tag = Tag::where('title', $tagTitle)->first();
            if(!$tag){
                $tag = Tag::create([
                    "title" => $tagTitle
                ]);
            }
            $tag_id[] = $tag->id_tag;
        }
        return $tag_id;
    }
}
