@extends('layouts.user')
@section('title', 'Delete Lecture')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="delete-section second-section">

      <h1 class="heading"><i class="fas fa-fw fa-trash"></i> Delete Lecture "{{ $lecture->lecture_title }}"</h1>

      <h3><i class="fas fa-fw fa-play"></i> Course: <a href="{{ route('profile.courses.view', $course->course_id) }}">{{ $course->course_title }}</a></h3>

      <form method="post" class="delete-form ui form">

        @csrf

        <h1>Would you like to delete this lecture forever?</h1>
        <p>Once you delete it you cannot restore it again with any way! Be Careful.</p>

        <button type="submit" class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete</button>
        <button type="button" goto="{{ route('profile.courses') }}" class="ui button primary"><i class="fas fa-fw fa-times"></i> Cancel</button>

      </form>

      <a href="{{ route('profile.courses.view', $course->course_id) }}" class="mt-10" style="display: block">View This Course</a>

    </div>

  </div>

@endsection
