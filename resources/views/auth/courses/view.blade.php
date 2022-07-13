@extends('layouts.user')
@section('title', 'Course | ' . $course->course_title)
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="view-section view-course-data second-section">

      <h1 class="heading"><i class="fas fa-fw fa-eye"></i> <strong>{{ $course->course_title }}</strong></h1>

      <div class="course-content">

        <div class="left-content">
          <ul>
            <h1>Course Description</h1>
            <li><i class="fas fa-fw fa-id-card"></i> Category <span>{{ \App\Models\Categories::category_name($course->course_category) }}</span></li>
            <li><i class="fas fa-fw fa-link"></i> Main Link <span><a href="{{ $course->course_main_link }}" target="_blank">Course Link</a></span></li>
            <li><i class="fas fa-fw fa-lock"></i> Is Private? <span>{{ $course->is_private === 1 ? 'Private' : 'Public' }}</span></li>
            <li><i class="fas fa-fw fa-play"></i> Lectures <span>{{ count($lectures) }} Lectures</span></li>
            <li><i class="fas fa-fw fa-tasks"></i> Enrolls <span>{{ $enrolls }} Person</span></li>
            <li><i class="fas fa-fw fa-wrench"></i> Last Updated <span>{{ time_formatter($course->updated_at) }}</span></li>
            <li><i class="fas fa-fw fa-clock"></i> Published in <span>{{ time_formatter($course->created_at) }}</span></li>
          </ul>
        </div>

        <div class="right-content">

          <ul class="course-lectures">
            <h1>Lectures</h1>
            @forelse ($lectures as $lecture)
              <li class="lecture"><a href="{{ route('profile.courses.view.lecture', [$course->course_id, $lecture->lecture_id]) }}">{{ $lecture->lecture_title }}</a></li>
            @empty
              <div class="empty-sign">No Lectures has been added yet! <a href="{{ route('profile.courses.add.lecture', $course->course_id) }}">Add Lecture</a></div>
            @endforelse
          </ul>

        </div>

      </div>

      <div class="course-all-info">

        <h1>About Course</h1>

        <div class="content">
          {!! $course->course_content !!}
        </div>

        <div class="actions">
          <a href="{{ route('profile.courses.add.lecture', $course->course_id) }}" class="ui button primary"><i class="fas fa-fw fa-plus"></i> Add Lecture</a>
          <a href="{{ route('profile.courses.update', $course->course_id) }}" class="ui button"><i class="fas fa-fw fa-wrench"></i> Update</a>
          <a href="{{ route('profile.courses.delete', $course->course_id) }}" class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete</a>
        </div>

      </div>

    </div>

  </div>

@endsection
