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
use App\Http\Controllers\WorkPlanController;
use App\Http\Controllers\admin\WorkPlanController as AdminWorkPlanController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

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
Route::prefix('news')->group(function($route){
    $route->get('', [NewsController::class, 'all']);
    $route->get('{slug}', [NewsController::class, 'show']);
    $route->get('newest', [NewsController::class, 'newest']);
});
Route::get('related-links', [RelatedLinkController::class, 'active']);
Route::get('legislator/member', [LegislatorController::class, 'member']);
Route::get('fractions', [FractionController::class, 'fractions']);
Route::get('work-plan', [WorkPlanController::class, 'index']);

Route::prefix('admin')->middleware('auth:sanctum')->group(function(){
    Route::get('me', function(){
        return response()->json(new UserResource(Auth::user()), 200);
    });
    Route::prefix('user')->middleware('isSuperAdmin')->group(function($route){
        $route->get('', [AdminUserController::class, 'index']);
        $route->get('{id}', [AdminUserController::class, 'show']);
        $route->post('create', [AdminUserController::class, 'createNewUser']);
        // $route->post('{id}', [AdminNewsController::class, 'update']);
    });
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
        $route->delete('{id}', [AdminRelatedLinkController::class, 'destroy']);
    });
    Route::prefix('fraction')->group(function($route){
        $route->get('', [AdminFractionController::class, 'index']);
        $route->get('{id}', [AdminFractionController::class, 'show']);
        $route->post('create', [AdminFractionController::class, 'store']);
        $route->post('{id}', [AdminFractionController::class, 'update']);
        $route->delete('{id}', [AdminFractionController::class, 'destroy']);
    });
    Route::prefix('work-plan')->group(function($route){
        $route->get('', [AdminWorkPlanController::class, 'index']);
        $route->get('{id}', [AdminWorkPlanController::class, 'show']);
        $route->post('create', [AdminWorkPlanController::class, 'store']);
        $route->post('{id}', [AdminWorkPlanController::class, 'update']);
        $route->delete('{id}', [AdminWorkPlanController::class, 'destroy']);
    });
});


