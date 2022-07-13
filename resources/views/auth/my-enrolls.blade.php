@extends('layouts.user')
@section('title', 'My Activities')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="my-enrolls second-section">

      <h1 class="heading"><i class="fas fa-fw fa-check"></i> Enrolled Courses</h1>

      <div class="enrolls">

        @forelse($enrolls as $e)
          @php
          $course = App\Models\Courses::get_course($e->enroll_course);
          @endphp
          <div class="enroll">
            <h4><a href="{{ route('app.courses.view', $e->enroll_course) }}"><i class="fas fa-fw fa-play"></i> {{ $course->course_title }}</a></h4>
            <div class="time"><i class="fas fa-fw fa-clock"></i> Enrolled in: {{ time_formatter($e->created_at, 'd, M Y') }}</div>
          </div>
        @empty
        @endforelse

      </div>

    </div>

  </div>

@endsection
