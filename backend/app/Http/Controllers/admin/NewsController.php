<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NewsAdminResource;
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
        $news = News::where('title', 'like', '%'.$search.'%');
        if(Auth::user()->type == 'dpr'){
            $news->where('id_user', Auth::id());
        }
        $news = $news->orderBy('created_at', 'desc')->paginate($per_page);
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
        $pathBanner = $request->file('banner')->storeAs('news', $news->slug.'-r3_2.png', 'public');
        $pathThumbnail = $request->file('thumbnail')->storeAs('news', $news->slug.'-r1_1.png', 'public');
        $news->photo = $path;
        $news->banner = $pathBanner;
        $news->thumbnail = $pathThumbnail;
        $news->bannerCoordinates = $request->bannerCoordinates;
        $news->thumbnailCoordinates = $request->thumbnailCoordinates;
        // $news->id_user = Auth::id();
        $news->id_user = Auth::id();
        $news->save();
        $tag_id = $this->getTags($request->tags);
        $news->tags()->sync($tag_id);

        return response()->json("Berita berhasil di tambahkan", 201);
    }

    public function show($id)
    {
        if(Auth::user()->type == 'dpr'){
            $news = News::where('id_news', $id)->where('id_user', Auth::id())->first();
        }else{
            $news = News::find($id);
        }
        
        return response()->json(new NewsAdminResource($news), 200);
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
        if(Auth::user()->type == 'dpr'){
            $news = News::where('id_news', $id)->where('id_user', Auth::id())->first();
        }else{
            $news = News::find($id);
        }
        if(!$news){
            return response()->json('Berita tidak ditemukan', 404);
        }
        $old_photo = $news->photo;
        $old_banner = $news->banner;
        $old_thumbnail = $news->thumbnail;
        $news->title = $request->title;
        $news->content = $request->content;
        if($request->has('is_published')){
            $news->is_published = $request->is_published;
        }else{
            $news->is_published = false;
        }
        $path = $request->file('photo')->storeAs('news', $news->slug.'.png', 'public');
        $pathBanner = $request->file('banner')->storeAs('news', $news->slug.'-r3_2.png', 'public');
        $pathThumbnail = $request->file('thumbnail')->storeAs('news', $news->slug.'-r1_1.png', 'public');
        $news->photo = $path;
        $news->banner = $pathBanner;
        $news->thumbnail = $pathThumbnail;
        $news->bannerCoordinates = $request->bannerCoordinates;
        $news->thumbnailCoordinates = $request->thumbnailCoordinates;
        if($old_photo != $news->photo) {
            Storage::disk('public')->delete($old_photo);
            Storage::disk('public')->delete($old_banner);
            Storage::disk('public')->delete($old_thumbnail);
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
        if(Auth::user()->type == 'dpr'){
            $news = News::where('id_news', $id)->where('id_user', Auth::id())->first();
        }else{
            $news = News::find($id);
        }
        if(!$news){
            return response()->json('Berita tidak ditemukan', 404);
        }
        $news->delete();
        Storage::disk('public')->delete($news->photo);
        Storage::disk('public')->delete($news->banner);
        Storage::disk('public')->delete($news->thumbnail);
        return response()->json('Sukses menghapus berita', 200);
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
