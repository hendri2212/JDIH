<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function all(){
        $news = News::with('tags')->where('is_published', true)->orderBy('created_at', 'desc')->paginate(5);
        return new NewsCollection($news);
    }

    public function related($slug){
        $post = News::where([
            'is_published' => true,
            'slug' => $slug
        ])->first();
        if(!$post){
            return response()->json("News not found!", 404);
        }
        $news = News::where('is_published', true)->where('slug', '!=', $slug)->whereHas('tags', function($q) use ($post) {
            return $q->whereIn('title', $post->tags->pluck('title')); 
        })->orderBy('created_at', 'desc')->paginate(5);
        return new NewsCollection($news);
    }

    public function newest()
    {
        $news = News::with('tags')->where('is_published', true)->orderBy('created_at', 'desc')->get()->take(5);
        return new NewsCollection($news);
    }

    public function show($slug)
    {
        $news = News::where([
            'is_published' => true,
            'slug' => $slug
        ])->first();
        if($news){
            return new NewsResource($news);
        }else{
            return response()->json("News not found!", 404);
        }
    }
}
