<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Obtiene todos los estudiantes junto con sus cursos
        $students = Student::with('courses')->get();
        return view('students.index', compact('students'));
    }
    

    public function create()
    {
        // Muestra el formulario de creación
        return view('students.create');
    }

    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'email' => 'required|email|unique:students,email',
        ]);

        // Crea el estudiante
        Student::create($validated);

        // Redirige a la lista de estudiantes
        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    public function edit($id)
    {
        // Obtiene el estudiante por su ID
        $student = Student::findOrFail($id);
        return view('students.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        // Valida los datos
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'email' => 'required|email|unique:students,email,' . $id,
        ]);

        // Actualiza el estudiante
        $student = Student::findOrFail($id);
        $student->update($validated);

        // Redirige a la lista de estudiantes con un mensaje
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    public function destroy($id)
    {
        // Elimina el estudiante por su ID
        $student = Student::findOrFail($id);
        $student->delete();

        // Redirige a la lista de estudiantes con un mensaje
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
