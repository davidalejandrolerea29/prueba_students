@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Top de 3 Cursos (Ultimos 6 meses)</h2>

    <div class="row">
        @foreach($topCourses as $course) <!-- Cambié $courses a $topCourses -->
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text">
                        <strong>Students:</strong> {{ $course->students_count }}<br>
                        <strong>Horario:</strong> {{ $course->schedule }}<br>
                        <strong>Periodo:</strong> {{ \Carbon\Carbon::parse($course->start_date)->format('M d, Y') }} - 
                        {{ \Carbon\Carbon::parse($course->end_date)->format('M d, Y') }}

                    </p>
                    <!-- Eliminar enlace o reemplazar con otra acción -->
                   
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($topCourses->isEmpty()) <!-- Cambié $courses a $topCourses -->
    <div class="alert alert-info">
       No se encontro cursos en los ultimos 6 meses
    </div>
    @endif

    <div class="mt-3">
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Volver a cursos</a>
    </div>
</div>
@endsection

