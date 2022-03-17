<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Validator;
use Illuminate\Support\Str;
use Throwable;

class CategoryController extends Controller
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories',
            'name' => 'required|unique:categories'
        ]);
        if ($validator->fails()) { 
            $statusCode = 422;
            $response = [
                'status' => 'error',
                'error' => $validator->errors(),
                'data' => null
            ];
            return response()->json($response, $statusCode);
        }

        try {
            $new_category = new Category;
            $new_category->id = Str::uuid();
            $new_category->title = $request->title;
            $new_category->name = $request->name;
            if ($request->has('icon')) {
                $new_category->icon = $request->icon;
            }
            $new_category->save();
            $statusCode = 201;
            $response = [
                'status' => 'success',
                'error' => null,
                'data' => null
            ];
        } catch (Throwable $e) {
            $statusCode = 500;
            $response = [
                'status' => 'error',
                'error' => [
                    'global' => 'Maaf, Permohonan Anda tidak dapat diproses saat ini. Mohon dicoba kembali'
                ],
                'data' => null
            ];
        }
        
        return response()->json($response, $statusCode);
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:categories',
            'title' => 'required|unique:categories',
            'name' => 'required|unique:categories'
        ]);
        if ($validator->fails()) { 
            $statusCode = 422;
            $response = [
                'status' => 'error',
                'error' => $validator->errors(),
                'data' => null
            ];
            return response()->json($response, $statusCode);
        }

        try {
            $update_category = Category::find($request->id);
            $update_category->title = $request->title;
            $update_category->name = $request->name;
            if ($request->has('icon')) {
                $new_category->icon = $request->icon;
            }
            $update_category->save();
            $statusCode = 200;
            $response = [
                'status' => 'success',
                'error' => null,
                'data' => null
            ];
        } catch (Throwable $e) {
            $statusCode = 500;
            $response = [
                'status' => 'error',
                'error' => [
                    'global' => 'Maaf, Permohonan Anda tidak dapat diproses saat ini. Mohon dicoba kembali'
                ],
                'data' => null
            ];
        }
        
        return response()->json($response, $statusCode);
    }

    
}
