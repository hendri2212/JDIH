<?php

namespace App\Http\Controllers;

use App\Http\Resources\NewsCollection;
use App\Http\Resources\NewsResource;
use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
    public function all(){
        $news = News::paginate();
        return new NewsCollection(NewsResource::collection($news));
    }

    public function newest()
    {
        $news = News::all()->take(5);
        return new NewsCollection(NewsResource::collection($news));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)->first();
        return new NewsResource($news);
    }
}
