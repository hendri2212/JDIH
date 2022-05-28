<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FractionRequest;
use App\Models\Fraction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fractions = Fraction::paginate();
        return response()->json($fractions, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FractionRequest $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'photo' => 'required|image'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $fraction = new Fraction;
        $fraction->name = $request->name;
        $path = $request->file('photo')->store('fractions');
        $fraction->photo = $path;
        $fraction->save();
        return response()->json("Fraksi berhasil ditambahkan", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Fraction::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string',
            'photo' => 'image'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 500);
        }
        $fraction = Fraction::find($id);
        if($request->has('name') && $fraction->name != $request->name){
            $fraction->name = $request->name;
        }
        if($request->has('photo')){
            $path = $request->file('photo')->store('fractions');
            $fraction->photo = $path;
        }
        $fraction->save();
        return response()->json("Fraksi berhasil diupdate", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fraction = Fraction::find($id);
        if($fraction != null){
            $fraction->delete();
        }
        return response()->json("Fraksi berhasil dihapus", 200);
    }
}
