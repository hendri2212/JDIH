<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function all(){
        $news = News::where('is_published', true)->orderBy('created_at', 'desc')->paginate();
        return new NewsCollection($news);
    }

    public function newest()
    {
        $news = News::where('is_published', true)->orderBy('created_at', 'desc')->get()->take(5);
        return new NewsCollection($news);
    }

    public function show($slug)
    {
        $news = News::where([
            'is_published' => true,
            'slug' => $slug
        ])->first();
        return new NewsResource($news);
    }
}
