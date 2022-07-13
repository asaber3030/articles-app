@extends('layouts.user')
@section('title', 'Lecture: ' . $lecture->lecture_title)
@section('content')


<div class="course-lecture-page">
  <div class="left-items">
    <h2><i class="fas fa-fw fa-play"></i> Course Lectures</h2>
    <ul>
      @foreach($lectures as $key => $lec)
        <li><a class="{{ $lec->lecture_id === $lecture->lecture_id ? 'active' : '' }}" href="{{ route('app.courses.lecture', [$course->course_id, $lec->lecture_id]) }}">{{ $key + 1 }}. {{ $lec->lecture_title }}</a></li>
      @endforeach
    </ul>
  </div>
  <div class="center-items">
    <h2><i class="fas fa-fw fa-hashtag"></i> {{ $lecture->lecture_title }}</h2>
    <div class="frame">
      <video  controls muted>
        <source src="{{ asset($lecture->lecture_video) }}" type="video/mp4">
        Your browser does not support the video tag.
      </video>
    </div>

    <div class="file">
      <h2><i class="fas fa-fw fa-file"></i> Lecture File</h2>
      <a class="file-download" href="{{ $lecture->lecture_file }}" download="{{$course->lecture_title}}"><i class="fas fa-fw fa-file-pdf"></i> Lecture File</a>
    </div>

    <div class="content">
      <h2><i class="fas fa-fw fa-info-circle"></i> Lecture Content</h2>
      <div class="article-content">
        {!! $lecture->lecture_content !!}
      </div>
    </div>
  </div>
  <div class="right-items">
    <h2><i class="fas fa-fw fa-info-circle"></i> Lecture Description</h2>
    <ul>
      <li><span><i class="fas fa-fw fa-clock"></i> Lecture Published in</span> <span>{{ time_formatter($lecture->created_at) }}</span></li>
      <li><span><i class="fas fa-fw fa-clock"></i> Lecture Last Updated</span> <span>{{ time_formatter($lecture->updated_at) }}</span></li>
      <li><span><i class="fas fa-fw fa-link"></i> YouTube Link</span> <span><a href="{{ $course->course_main_link }}" target="_blank">Youtube</a></span></li>
      <li><span><i class="fas fa-fw fa-list"></i> Course Category</span> <span>{{ \App\Models\Categories::category_name($course->course_category) }}</span></li>
      <li><span><i class="fas fa-fw fa-home"></i> Course Main Page</span> <span><a href="{{ route('app.courses.view', $course->course_id) }}">Course Page</a></span></li>
    </ul>
  </div>
</div>

@endsection
