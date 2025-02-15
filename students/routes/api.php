<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::apiResource('students', StudentController::class);
Route::apiResource('courses', CourseController::class);

// Ruta para obtener los cursos más populares en los últimos 6 meses
Route::get('courses/top', [CourseController::class, 'topCourses']);

// Asignar un estudiante a un curso
Route::post('courses/{course}/assign-student', [CourseController::class, 'assignStudent']);

// Adjuntar un estudiante a un curso (parece redundante con assignStudent, ¿lo necesitas?)
Route::post('courses/{course}/students/{student}', [CourseController::class, 'attachStudent']);
