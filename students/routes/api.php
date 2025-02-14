
<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\CourseController;

Route::apiResource('students', StudentController::class);
Route::apiResource('courses', CourseController::class);
Route::get('courses/{course}/assign_student', [CourseController::class, 'showAssignForm'])->name('courses.assignStudentForm');
Route::post('courses/{course}/assign_student', [CourseController::class, 'assignStudent'])->name('courses.assignStudent');

Route::post('courses/{course}/students/{student}', [CourseController::class, 'attachStudent']);
Route::get('courses/top', [CourseController::class, 'topCourses']);
