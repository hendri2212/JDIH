<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skpd;
use App\Models\Regulation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

class SkpdController extends Controller
{
    public function create(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:skpd'
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

            $new_skpd = new Skpd;
            $new_skpd->id = Str::uuid();
            $new_skpd->name = $request->name;
            $new_skpd->save();
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
            'id' => 'required|exists:skpd',
            'name' => 'required|unique:skpd'
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
            $update_skpd = Skpd::find($request->id);
            $update_skpd->name = $request->name;
            $update_skpd->save();
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

    public function delete(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:skpd'
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
        $skpd = Skpd::find($request->id);
        $regulation = Regulation::where('skpd_id', $request->id)->first();
        if ($regulation) {
            $statusCode = 422;
            $response = [
                'status' => 'error',
                'error' => [
                    'global' => 'SKPD dengan nama'. $skpd->name . ' telah digunakan di salah satu peraturan.'
                ],
                'data' => null
            ];
            return response()->json($response, $statusCode);
        }

        try {
            $delete_skpd = $skpd;
            $delete_skpd->delete();
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
