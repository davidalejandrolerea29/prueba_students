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
        <tbody id="students-table">
            <tr>
                <td colspan="5" class="text-center">Cargando estudiantes...</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('http://127.0.0.1:8000/api/students')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar los datos');
            }
            return response.json();
        })
        .then(data => {
            console.log("Estudiantes obtenidos:", data);

            let tbody = document.getElementById("students-table");
            tbody.innerHTML = ""; // Limpiar la tabla antes de agregar datos

            if (data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="5" class="text-center">No hay estudiantes registrados.</td></tr>`;
                return;
            }

            data.forEach(student => {
                let row = `<tr>
                    <td>${student.first_name} ${student.last_name}</td>
                    <td>${student.email}</td>
                    <td>${student.age}</td>
                    <td>${student.courses.map(course => `<span class="badge bg-primary">${course.name}</span>`).join(" ")}</td>
                    <td>
                        <a href="/students/${student.id}/edit" class="btn btn-sm btn-warning">Editar</a>
                        <form action="/students/${student.id}" method="POST" class="d-inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                        </form>
                    </td>
                </tr>`;
                tbody.innerHTML += row;
            });
        })
        .catch(error => {
            console.error("Error al obtener los estudiantes:", error);
            document.getElementById("students-table").innerHTML = `<tr><td colspan="5" class="text-center text-danger">Error al cargar los estudiantes.</td></tr>`;
        });
});
</script>

@endsection


