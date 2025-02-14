@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Todos los Cursos</h1>

    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Crear nuevo Curso</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Horarios</th>
                <th>Inicio</th>
                <th>Fin</th>
                <th>Estudiantes anotados</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ $course->schedule }}</td>
                <td>{{ $course->start_date }}</td>
                <td>{{ $course->end_date }}</td>
                <td>{{ $course->students_count }}</td>
                <td>
                    <!-- Botón para editar el curso -->
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Editar</a>

                    <!-- Formulario para eliminar el curso -->
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este curso?')">Eliminar</button>
                    </form>

                    <!-- Redirige al formulario de asignación de estudiante -->
                    <form action="{{ route('courses.assignStudentForm', $course->id) }}" method="GET" style="display:inline;">
                        <button type="submit" class="btn btn-success">Asignar Estudiante</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection



