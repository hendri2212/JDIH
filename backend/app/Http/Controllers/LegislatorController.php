<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LegislatorController extends Controller
{
    public function member(){
        $member = User::where('type', 'dpr')->get();
        return response()->json($member, 200);
    }
}
