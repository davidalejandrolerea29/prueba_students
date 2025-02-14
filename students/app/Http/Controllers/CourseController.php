<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CourseController extends Controller
{
    // Muestra todos los cursos con la cantidad de estudiantes
    public function index()
    {
        $courses = Course::withCount('students')->get();
        return view('courses.index', compact('courses'));
    }

    // Muestra los cursos con más estudiantes en los últimos 6 meses
    public function topCourses()
    {
       
    
        $sixMonthsAgo = Carbon::now()->subMonths(6);
    
        $topCourses = Course::withCount('students')
            ->where('start_date', '>=', $sixMonthsAgo)
            ->orderByDesc('students_count')
            ->take(3)
            ->get();
    
        return view('courses.topcourses', compact('topCourses'));
    }
    
    
    // Muestra el formulario para crear un nuevo curso
    public function create()
    {
        return view('courses.create');
    }

    // Almacena un nuevo curso
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Crear el curso con los datos validados
        Course::create($validated);
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    // Muestra el formulario para editar un curso
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Actualiza un curso existente
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'schedule' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $course->update($validated);
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    // Asigna un estudiante a un curso
   
    // Muestra el formulario para asignar un estudiante a un curso
// CourseController.php

// Muestra el formulario para asignar un estudiante al curso
public function showAssignForm(Course $course)
{
    $students = Student::all(); // Asegúrate de que esta relación esté bien definida y que los estudiantes estén disponibles

    return view('courses.assign_student', compact('course', 'students'));
}

// Asigna un estudiante al curso
public function assignStudent(Request $request, Course $course)
{
    $request->validate([
        'student_id' => 'required|exists:students,id',
    ]);

    $course->students()->attach($request->student_id);

    return redirect()->route('courses.index')->with('success', 'Student assigned to course successfully');
}

public function show(Course $course)
{
    return view('courses.show', compact('course'));
}

    // Elimina un curso
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully');
    }
}
