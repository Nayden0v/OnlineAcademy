<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TrainingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Students Routes
Route::get('students', [StudentController::class, 'index']);
Route::delete('students/{user_id}', [StudentController::class, 'delete']);

// Trainings Routes
Route::post('trainings', [TrainingController::class, 'create']);
Route::get('trainings/{title}', [TrainingController::class, 'get']);
Route::get('trainings/{date}', [TrainingController::class, 'getTrainingbyDate']);
Route::delete('trainings/{title}', [TrainingController::class, 'delete']);
Route::put('trainings/{title}', [TrainingController::class, 'update']);
