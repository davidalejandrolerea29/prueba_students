<!-- resources/views/students/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estudiantes</h1>
    <a href="{{ route('students.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Estudiante</a>

    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Años</th>
                <th>Cursos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
            <tr>
                <td>{{ $student->first_name }} {{ $student->last_name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->age }}</td>
                <td>
                    @foreach($student->courses as $course)
                        <span class="badge bg-primary">{{ $course->name }}</span>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
