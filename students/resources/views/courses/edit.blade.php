<!-- resources/views/courses/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Course</h2>

    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $course->name) }}" required>
        </div>

        <div class="form-group">
            <label for="start_date">Inicio</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date', $course->start_date->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label for="end_date">Fin</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date', $course->end_date->format('Y-m-d')) }}" required>
        </div>

        <div class="form-group">
            <label for="schedule">Horarios</label>
            <input type="text" class="form-control" id="schedule" name="schedule" value="{{ old('schedule', $course->schedule) }}" required>
        </div>

       

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
