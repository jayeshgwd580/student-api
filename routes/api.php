<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\StudentSubjectController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/students', [StudentController::class, 'store']);

Route::post('/student-subjects', [StudentSubjectController::class, 'store']);

Route::get('/students', [StudentController::class, 'index']);

Route::post('/students/{id}', [StudentController::class, 'update']);

Route::delete('/students/{id}', [StudentController::class, 'destroy']);

Route::delete('/student-subjects/{id}', [StudentSubjectController::class, 'destroy']);

Route::post('/student-subjects/{id}', [StudentSubjectController::class, 'update']);