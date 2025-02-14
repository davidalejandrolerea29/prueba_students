@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Top de 3 Cursos (Ultimos 6 meses)</h2>

    <div class="row" id="courses-container">
        <!-- Aquí se agregarán los cursos desde JavaScript -->
    </div>

    <div id="no-courses-alert" class="alert alert-info" style="display: none;">
       No se encontraron cursos en los últimos 6 meses.
    </div>

    <div class="mt-3">
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Volver a cursos</a>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Solicitar los cursos desde la API
        fetch('/api/courses/top')  // Asume que esta es la ruta correcta de la API
            .then(response => response.json())  // Convertir la respuesta en JSON
            .then(courses => {
                const coursesContainer = document.getElementById('courses-container');
                const noCoursesAlert = document.getElementById('no-courses-alert');

                if (courses.length === 0) {
                    noCoursesAlert.style.display = 'block';  // Muestra el mensaje si no hay cursos
                    return;
                }

                // Recorrer y mostrar los cursos
                courses.forEach(course => {
                    const courseCard = document.createElement('div');
                    courseCard.classList.add('col-md-4', 'mb-4');
                    courseCard.innerHTML = `
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">${course.name}</h5>
                                <p class="card-text">
                                    <strong>Estudiantes:</strong> ${course.students_count}<br>
                                    <strong>Horario:</strong> ${course.schedule}<br>
                                    <strong>Periodo:</strong> ${new Date(course.start_date).toLocaleDateString()} - ${new Date(course.end_date).toLocaleDateString()}
                                </p>
                            </div>
                        </div>
                    `;
                    coursesContainer.appendChild(courseCard);
                });
            })
            .catch(error => {
                console.error('Error al obtener los cursos:', error);
            });
    });
</script>

@endsection


