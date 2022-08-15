<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FractionRequest;
use App\Http\Resources\FractionCollection;
use App\Http\Resources\FractionResource;
use App\Models\Fraction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class FractionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $per_page = $request->get('per_page');
        $search = $request->has('search') ? $request->get('search') : '';
        if($per_page != 15 && $per_page != 25 && $per_page != 50){
            $per_page = 15;
        }
        $fractions = Fraction::where('name', 'like', '%'.$search.'%')->paginate($per_page);
        return new FractionCollection($fractions);
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
        $path = $request->file('photo')->store('fractions', 'public');
        $fraction->photo = $path;
        $fraction->coordinates = $request->coordinates;
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
        return response()->json(new FractionResource(Fraction::find($id)), 200);
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
            Storage::disk('public')->delete($fraction->photo);
            $path = $request->file('photo')->store('fractions', 'public');
            $fraction->photo = $path;
            $fraction->coordinates = $request->coordinates;
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
            $user = User::where('id_fraction', $id)->first();
            if($user){
                return response()->json("Gagal menghapus, karena ada user yang masih tersimpan sebagai anggota dari fraksi ini!", 500);
            }
            $fraction->delete();
            Storage::disk('public')->delete($fraction->photo);
        }
        return response()->json("Fraksi berhasil dihapus", 200);
    }
}
