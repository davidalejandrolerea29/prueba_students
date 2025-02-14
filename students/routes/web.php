<?php

use Illuminate\Support\Facades\Route;

// Página de inicio
Route::get('/', function () {
    return view('students.index');
});

// Vistas de estudiantes
Route::view('/students', 'students.index')->name('students.index');
Route::view('/students/create', 'students.create')->name('students.create');
Route::view('/students/{student}/edit', 'students.edit')->name('students.edit');

// Vistas de cursos
Route::view('/courses', 'courses.index')->name('courses.index');
Route::view('/courses/create', 'courses.create')->name('courses.create');
Route::view('/courses/{course}/edit', 'courses.edit')->name('courses.edit');
Route::view('/courses/{course}/assign_student', 'courses.assign_student')->name('courses.assignStudentForm');

// Página de cursos populares
Route::view('/topcourses', 'courses.topcourses')->name('courses.topCourses');




