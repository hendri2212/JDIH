<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnotherLevelUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;

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

    public function show($id){
        $user = User::find($id);
        return new UserResource($user);
    }
}
