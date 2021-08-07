<?php

use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\StudentController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [StudentController::class, 'register']);
Route::post('/login', [StudentController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('profile', [StudentController::class, 'profile']);
    Route::get('logout', [StudentController::class, 'logout']);

    Route::psot('create-project', [ProjectController::class, 'createProject']);
    Route::get('list-project', [ProjectController::class, 'listProject']);
    Route::get('single-project/{id}', [ProjectController::class, 'singleProject']);
    Route::delete('delete-project/{id}', [ProjectController::class, 'deleteProject']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
