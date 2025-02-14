<?php


namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CourseController extends Controller
{
    // Obtener todos los cursos con la cantidad de estudiantes
    public function index()
    {
        $courses = Course::withCount('students')->get();
        return response()->json($courses);
    }

    // Obtener los cursos con más estudiantes en los últimos 6 meses
    public function topCourses()
    {
        $sixMonthsAgo = Carbon::now()->subMonths(6);

        $topCourses = Course::withCount('students')
            ->where('start_date', '>=', $sixMonthsAgo)
            ->orderByDesc('students_count')
            ->take(3)
            ->get();

        return response()->json($topCourses);
    }

    // Crear un nuevo curso
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $course = Course::create($validated);
        return response()->json(['message' => 'Course created successfully!', 'course' => $course], 201);
    }

    // Obtener un curso específico
    public function show(Course $course)
    {
        return response()->json($course);
    }

    // Actualizar un curso existente
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $course->update($validated);
        return response()->json(['message' => 'Course updated successfully!', 'course' => $course]);
    }

    // Eliminar un curso
    public function destroy(Course $course)
    {
        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }

    // Obtener estudiantes asignados a un curso
    public function getStudents(Course $course)
    {
        return response()->json($course->students);
    }

    // Asignar un estudiante a un curso
    public function assignStudent(Request $request, Course $course)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
        ]);

        $course->students()->attach($request->student_id);

        return response()->json(['message' => 'Student assigned to course successfully']);
    }
}
