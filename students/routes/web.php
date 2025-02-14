
<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;

Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
Route::get('/topcourses', [CourseController::class, 'topCourses'])->name('courses.topCourses');


Route::get('courses/{course}/assign_student', [CourseController::class, 'showAssignForm'])->name('courses.assignStudentForm');
Route::post('courses/{course}/assign_student', [CourseController::class, 'assignStudent'])->name('courses.assignStudent');


