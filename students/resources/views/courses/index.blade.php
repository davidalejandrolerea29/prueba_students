@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Todos los Cursos</h1>
    <a href="{{ route('courses.create') }}" class="btn btn-primary mb-3">Crear nuevo Curso</a>

    <table class="table" id="courses-table">
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
            <!-- Los datos serán cargados por JavaScript -->
        </tbody>
    </table>
</div>

<script>
// Usamos JavaScript para obtener los datos de la API
document.addEventListener("DOMContentLoaded", function() {
    fetch('/api/courses/top') // Haces la solicitud a la API
        .then(response => response.json()) // Transformamos la respuesta a JSON
        .then(courses => {
            let tableBody = document.querySelector('#courses-table tbody');
            courses.forEach(course => {
                let row = document.createElement('tr');
                row.innerHTML = `
                    <td>${course.name}</td>
                    <td>${course.schedule}</td>
                    <td>${course.start_date}</td>
                    <td>${course.end_date}</td>
                    <td>${course.students_count}</td>
                    <td>
                        <a href="/courses/${course.id}/edit" class="btn btn-warning">Editar</a>
                        <form action="/courses/${course.id}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este curso?')">Eliminar</button>
                        </form>
                        <form action="/courses/${course.id}/assign_student" method="GET" style="display:inline;">
                            <button type="submit" class="btn btn-success">Asignar Estudiante</button>
                        </form>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => {
            console.error('Error al obtener los cursos:', error);
        });
});
</script>
@endsection




