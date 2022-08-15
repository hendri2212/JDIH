<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnotherLevelUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Hash;

class UserController extends Controller
{
    public function index(Request $request){
        $per_page = $request->get('per_page');
        $search = $request->has('search') ? $request->get('search') : '';
        if($per_page != 15 && $per_page != 25 && $per_page != 50){
            $per_page = 15;
        }
        $user = User::where('type', '!=', 'superadmin')->where('name', 'like', '%'.$search.'%')->orderBy('created_at', 'desc')->paginate($per_page);
        return new UserCollection($user);
    }

    public function createNewUser(AnotherLevelUserRequest $request){
        $inserted = $request->only(['name', 'username', 'password', 'type']);
        if($request->type == 'dpr'){
            $inserted = $request->only(['name', 'username', 'password', 'type', 'id_fraction']);
        }
        $path = null;
        if($request->hasFile('photo')){
            $path = $request->file('photo')->store('user', 'public');
        }
        $inserted['photo'] = $path;
        $user = new User($inserted);
        $user->save();
        return response()->json("Berhasil menambah user", 201);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        if($user){
            $user->name = $request->name;
            $user->username = $request->username;
            if(trim($request->password) != ""){
                $user->password = Hash::make($request->password);
            }
            $user->type = $request->type;
            if($request->type == 'dpr'){
                $user->id_fraction = $request->id_fraction; 
            }else{
                $user->id_fraction = null;
            }
            $path = $request->file('photo')->store('user', 'public');
            $old_photo = $user->photo;
            $user->photo = $path;
            if($path != $old_photo){
                Storage::disk('public')->delete($old_photo);
            }
            $user->save();
            return response()->json("Berhasil mengubah user", 200);
        }
        return response()->json("User tidak ditemukan", 404);
    }

    public function show($id){
        $user = User::find($id);
        return new UserResource($user);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json('User tidak ditemukan', 404);
        }
        $user->delete();
        Storage::disk('public')->delete($user->photo);
        return response()->json('Sukses menghapus user', 200);
    }
}
