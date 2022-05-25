<?php

namespace App\Http\Controllers;

use App\Models\RelatedLink;
use Illuminate\Http\Request;

class RelatedLinkController extends Controller
{
    public function active(){
        $relatedLink = RelatedLink::all();
        return response()->json($relatedLink, 200);
    }
}
