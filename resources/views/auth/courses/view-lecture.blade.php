@extends('layouts.user')
@section('title', 'Lecture | ' . $lecture->lecture_title)
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="view-section view-lecture-data second-section">

      <h1 class="heading"><i class="fas fa-fw fa-eye"></i> <strong>{{ $lecture->lecture_title }}</strong></h1>

      <div class="course-content">

        <div class="left-content">
          <ul class="course-lectures">
            <h1>Lectures</h1>
            @foreach ($lectures as $lecture)
              <li class="lecture"><a href="{{ route('profile.courses.view.lecture', [$course->course_id, $lecture->lecture_id]) }}">{{ $lecture->lecture_title }}</a></li>
            @endforeach
          </ul>
          <div class="actions">
            <a href="{{ route('profile.courses.add.lecture', $course->course_id) }}" class="ui button primary"><i class="fas fa-fw fa-plus"></i> Add Lecture</a>
            <a href="{{ route('profile.courses.update', $course->course_id) }}" class="ui button"><i class="fas fa-fw fa-wrench"></i> Update Course</a>
            <a href="{{ route('profile.courses.delete.lecture', [$course->course_id, $lecture->lecture_id]) }}" class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete Lecture</a>
          </div>
        </div>

        <div class="right-content">

          <video  controls muted>
            <source src="{{ asset($lecture->lecture_video) }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>

        </div>

      </div>

      <div class="course-all-info">

        <h1>Lecture File</h1>

        <div class="lecture-file">
          <a href="{{ asset($lecture->lecture_file) }}" download="{{ str_replace(' ', '_', $lecture->lecture_title) . '.pdf' }}">Lecture file.pdf</a>
        </div>

        <h1>Content</h1>

        <div class="content">
          {!! $lecture->lecture_content !!}
        </div>

      </div>

    </div>

  </div>

@endsection
