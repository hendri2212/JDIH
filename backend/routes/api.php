<?php

use Illuminate\Http\Request;
use App\Http\Controllers\admin\AuthenticationController;
use App\Http\Controllers\FractionController;
use App\Http\Controllers\admin\FractionController as AdminFractionController;
use App\Http\Controllers\LegislatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\admin\NewsController as AdminNewsController;
use App\Http\Controllers\RelatedLinkController;
use App\Http\Controllers\admin\RelatedLinkController as AdminRelatedLinkController;

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
Route::get('news/{slug}', [NewsController::class, 'show']);
Route::get('news/newest', [NewsController::class, 'newest']);
Route::get('related-links', [RelatedLinkController::class, 'active']);
Route::get('legislator/member', [LegislatorController::class, 'member']);
Route::get('fractions', [FractionController::class, 'fractions']);

Route::prefix('admin')->middleware('auth:sanctum')->group(function(){
    Route::prefix('news')->group(function($route){
        $route->get('', [AdminNewsController::class, 'index']);
        $route->get('{id}', [AdminNewsController::class, 'show']);
        $route->post('create', [AdminNewsController::class, 'store']);
        $route->post('{id}', [AdminNewsController::class, 'update']);
    });
    Route::prefix('related-link')->group(function($route){
        $route->get('', [AdminRelatedLinkController::class, 'index']);
        $route->get('{id}', [AdminRelatedLinkController::class, 'show']);
        $route->post('create', [AdminRelatedLinkController::class, 'store']);
        $route->post('{id}', [AdminRelatedLinkController::class, 'update']);
    });
    Route::prefix('fraction')->group(function($route){
        $route->get('', [AdminFractionController::class, 'index']);
        $route->get('{id}', [AdminFractionController::class, 'show']);
        $route->post('create', [AdminFractionController::class, 'store']);
        $route->post('{id}', [AdminFractionController::class, 'update']);
    });
});


