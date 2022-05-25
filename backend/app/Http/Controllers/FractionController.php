<?php

namespace App\Http\Controllers;

use App\Models\Fraction;
use Illuminate\Http\Request;

class FractionController extends Controller
{
    public function fractions(){
        $fractions = Fraction::all();
        return response()->json($fractions, 200);
    }
}
