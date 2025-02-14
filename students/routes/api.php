<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::middleware('api')->group(function () {

Route::apiResource('students', StudentController::class);
Route::apiResource('courses', CourseController::class);

// Ruta para obtener los cursos más populares en los últimos 6 meses
Route::get('courses/top', [CourseController::class, 'topCourses']);

// Asignar un estudiante a un curso
Route::post('courses/{course}/assign-student', [CourseController::class, 'assignStudent']);

// Adjuntar un estudiante a un curso (parece redundante con assignStudent, ¿lo necesitas?)
Route::post('courses/{course}/students/{student}', [CourseController::class, 'attachStudent']);
});