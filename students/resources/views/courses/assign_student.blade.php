<!-- resources/views/courses/assign_student.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Assign Student to Course</h1>
    <form action="{{ route('courses.assignStudent', $course->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-control" required>
                <option value="">Select a student</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Assign</button>
    </form>
</div>
@endsection
