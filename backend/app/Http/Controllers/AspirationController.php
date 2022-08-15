<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\AspirationCollection;

class AspirationController extends Controller
{

    public function index(){
        $aspiration = Aspiration::orderBy('created_at', 'desc')->paginate(7);
        return new AspirationCollection($aspiration);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "address" => "required|string",
            "photo" => "required|image",
            "title" => "required|string",
            "description" => "required|string"
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $aspiration = new Aspiration();
        $aspiration->name = $request->name;
        $aspiration->address = $request->address;
        $aspiration->title = $request->title;
        $aspiration->description = $request->description;
        $path = $request->file('photo')->store('aspirations', 'public');
        $aspiration->photo = $path;
        $aspiration->status = '';
        $aspiration->save();

        return response()->json("Aspirasi berhasil di tambahkan", 201);
    }
}
