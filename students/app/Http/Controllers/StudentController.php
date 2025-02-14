<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use App\Models\Student;
use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Obtener todos los estudiantes en formato JSON
    public function index()
    {
        // Obtener todos los estudiantes
        $students = Student::all();

        // Devolver los estudiantes en formato JSON
        return response()->json($students);
    }

    // Crear un nuevo estudiante
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'email' => 'required|email|unique:students,email',
        ]);

        $student = Student::create($validated);
        return response()->json(['message' => 'Student created successfully!', 'student' => $student], 201);
    }

    // Obtener un estudiante específico
    public function show($id)
    {
        $student = Student::with('courses')->findOrFail($id);
        return response()->json(['student' => $student], 200);
    }

    // Actualizar un estudiante
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'email' => 'required|email|unique:students,email,' . $id,
        ]);

        $student = Student::findOrFail($id);
        $student->update($validated);

        return response()->json(['message' => 'Student updated successfully!', 'student' => $student], 200);
    }

    // Eliminar un estudiante
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        return response()->json(['message' => 'Student deleted successfully!'], 200);
    }
}

