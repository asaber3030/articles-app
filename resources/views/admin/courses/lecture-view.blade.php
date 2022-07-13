@extends('layouts.admin')
@section('title', $course->course_title . ' | Lectures')
@section('content')
  <div class="course-container course-lectures-view-page">
    <div class="d-flex">
      <div class="left-part">
        <div class="course-lectures">
          <h2>Course Content</h2>
          <ul>
            @foreach (\App\Models\Admin\CourseLectures::course_lectures_titles($course->course_id) as $i => $l)
              <li>
                <div>
                  <span>{{ $i + 1 }}</span>
                  <a href="{{ route('admin.courses.lectures.view', [$l->lecture_course, $l->lecture_id]) }}">{{ $l->lecture_title }}</a>
                </div>
                <a href="{{ route('admin.courses.lectures.delete', $l->lecture_id) }}"><i class="fas fa-fw fa-trash"></i></a>
              </li>
            @endforeach
          </ul>
        </div>
        <div class="course-data">
          <h2>Course Information</h2>
          <ul>
            <li  class="info-li"><span class="rest"><i class="fas fa-fw fa-user"></i> Created By</span> <a href="">{{ $course->username === 'developer' ? $course->admin_username : $course->username }}</a></li>
            <li class="info-li"><span class="rest"><i class="fas fa-fw fa-clock"></i> Published In</span> <span class="blue-c">{{ date('d M, Y', strtotime($course->createa_at)) }}</span></li>
            <li class="info-li"><span class="rest"><i class="fas fa-fw fa-wrench"></i> Last Update</span> <span class="blue-c">{{ date('d M, Y', strtotime($course->createa_at)) }}</span></li>
            <li class="info-li"><span class="rest"><i class="fas fa-fw fa-play"></i> Lectures</span> <span class="blue-c">{{ count(\App\Models\Admin\CourseLectures::course_lectures_titles($course->course_id)) }} lectures</span></li>
            <li class="info-li"><span class="rest"><i class="fas fa-fw fa-wrench"></i> Last Update</span> <span class="blue-c">{{ date('d M, Y', strtotime($course->createa_at)) }}</span></li>
            <li class="info-li"><span class="rest"><i class="fab fa-megaport"></i> Category</span> <span class="blue-c">{{ $course->category_name }}</span></li>
          </ul>
        </div>
      </div>
      <div class="right-part">
        <h1>Lecture: {{ $lecture->lecture_title }}</h1>
        <video controls>
          <source src="{{ asset($lecture->lecture_video) }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
        <a href="{{ $lecture->lecture_youtube }}" target="_blank" class="button red ui"><i class="fab fa-fw fa-youtube"></i> YouTube</a>
        <a download="{{ strtolower( str_replace(' ', '_', $lecture->lecture_title)) }}" href="{{ asset($lecture->lecture_file) }}" class="button ui inverted green"><i class="fas fa-fw fa-download"></i> Download Lecture</a>
        <a href="{{ route('admin.courses.lectures.update', [$course->course_id, $lecture->lecture_id]) }}" class="button ui inverted olive"><i class="fas fa-fw fa-wrench"></i> Update Lecture</a>
      </div>
    </div>
    <h1>Lecture Description</h1>
    <div class="article-content">
      {!! $lecture->lecture_content !!}
    </div>
  </div>
@endsection
