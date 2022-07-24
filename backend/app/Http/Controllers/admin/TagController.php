<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagCollection;
use App\Models\Tag;
use Illuminate\Http\Request;
class TagController extends Controller
{
    public function index(Request $request){
        $querySearch = $request->get('query');
        $tags = Tag::where('title', 'like', '%'.$querySearch.'%')->paginate(10);
        return response()->json(new TagCollection($tags), 200);
    }
}
