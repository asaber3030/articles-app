@extends('layouts.admin')
@section('title', 'Course | ' . $course->course_title)
@section('class', 'body-article-view body-default')
@section('content')
<div class="article-actions">
  <a href="{{ route('admin.courses') }}" class="ui button primary redirect-button"><i class="fas fa-fw fa-home"></i></a>
  @if ($course->course_status === 0)
    <a href="{{ route('admin.courses.delete', [$course->course_id]) }}" class="ui button red redirect-button"><i class="fas fa-fw fa-trash"></i></a>
  @else
    <a href="{{ route('admin.courses.restore', [$course->course_id]) }}" class="ui button green redirect-button"><i class="fas fa-fw fa-trash-restore"></i></a>
  @endif
  <a href="{{ route('admin.courses.update', [$course->course_id]) }}" class="ui button white redirect-button"><i class="fas fa-fw fa-wrench"></i></a>
</div>

<div class="course-container course-view-page">
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
      <h1>{{ $course->course_title }}</h1>
      <h5>
        <span class="type">{{ $course->is_private === 0 ? 'Public' : 'Private' }}</span>
        <span class="ml-3">{{ $course->username === 'developer' ? '@' . $course->admin_username : '@' . $course->username }}</span>
      </h5>
      <p>{{ $course->course_content }}</p>
      <a href="{{ $course->course_main_link }}" target="_blank" class="button ui"><i class="fas fa-fw fa-link"></i> Course Link</a>
      <a href="{{ route('admin.courses.lectures', $course->course_id) }}" class="button ui inverted olive"><i class="fas fa-fw fa-download"></i> Lectures</a>
    </div>
  </div>
</div>
@endsection
