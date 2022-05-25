<?php

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AuthenticationController;
use App\Http\Controllers\FractionController;
use App\Http\Controllers\LegislatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RelatedLinkController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', [AuthenticationController::class, 'login']);
Route::post('auth/register', [AuthenticationController::class, 'register']);

// Route::apiResource('news', NewsController::class);
Route::get('news', [NewsController::class, 'all']);
Route::get('news/newest', [NewsController::class, 'newest']);
Route::get('related-links', [RelatedLinkController::class, 'active']);
Route::get('legislator/member', [LegislatorController::class, 'member']);
Route::get('fractions', [FractionController::class, 'fractions']);


