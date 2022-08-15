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
use App\Http\Controllers\admin\TagController as AdminTagController;
use App\Http\Controllers\WorkPlanController;
use App\Http\Controllers\admin\WorkPlanController as AdminWorkPlanController;
use App\Http\Controllers\admin\UserController as AdminUserController;
use App\Http\Controllers\AspirationController;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

Route::post('auth/login', [AuthenticationController::class, 'login']);
Route::post('auth/register', [AuthenticationController::class, 'register']);

// Route::apiResource('news', NewsController::class);
Route::get('related-news/{slug}', [NewsController::class, 'related']);
Route::prefix('news')->group(function($route){
    $route->get('', [NewsController::class, 'all']);
    $route->get('newest', [NewsController::class, 'newest']);
    $route->get('{slug}', [NewsController::class, 'show']);
});
Route::get('related-links', [RelatedLinkController::class, 'active']);
Route::get('legislator/members', [LegislatorController::class, 'member']);
Route::get('fractions', [FractionController::class, 'fractions']);
Route::get('work-plans', [WorkPlanController::class, 'index']);
// Route::middleware('api')->prefix('aspirations')->group(function($route){
    Route::get('aspirations', [AspirationController::class, 'index']);
    Route::post('aspirations', [AspirationController::class, 'store']);
// });

Route::prefix('admin')->middleware('auth:sanctum')->group(function(){
    Route::get('me', function(){
        return response()->json(new UserResource(Auth::user()), 200);
    });
    Route::prefix('user')->middleware('isSuperAdmin')->group(function($route){
        $route->get('', [AdminUserController::class, 'index']);
        $route->get('{id}', [AdminUserController::class, 'show']);
        $route->post('create', [AdminUserController::class, 'createNewUser']);
        $route->post('{id}', [AdminUserController::class, 'update']);
        $route->delete('{id}', [AdminUserController::class, 'destroy']);
    });
    Route::prefix('tags')->group(function($route){
        $route->get('', [AdminTagController::class, 'index']);
        $route->get('{id}', [AdminTagController::class, 'show']);
        $route->post('create', [AdminTagController::class, 'store']);
        Route::middleware('isSuperAdmin')->group(function($route){
            $route->post('{id}', [AdminTagController::class, 'update']);
            $route->delete('{id}', [AdminTagController::class, 'destroy']);
        });
    });
    Route::prefix('news')->group(function($route){
        $route->get('', [AdminNewsController::class, 'index']);
        $route->get('{id}', [AdminNewsController::class, 'show']);
        $route->post('create', [AdminNewsController::class, 'store']);
        $route->post('{id}', [AdminNewsController::class, 'update']);
        $route->delete('{id}', [AdminNewsController::class, 'destroy']);
    });
    Route::prefix('related-link')->middleware('isSuperAdmin')->group(function($route){
        $route->get('', [AdminRelatedLinkController::class, 'index']);
        $route->get('{id}', [AdminRelatedLinkController::class, 'show']);
        $route->post('create', [AdminRelatedLinkController::class, 'store']);
        $route->post('{id}', [AdminRelatedLinkController::class, 'update']);
        $route->delete('{id}', [AdminRelatedLinkController::class, 'destroy']);
    });
    Route::prefix('fraction')->middleware('isSuperAdmin')->group(function($route){
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


