@extends('layouts.admin')
@section('title', 'Course | ' . $howto->course_title)
@section('class', 'body-article-view body-default')
@section('content')
<div class="article-actions">
  <a href="{{ route('admin.courses') }}" class="ui button primary redirect-button"><i class="fas fa-fw fa-home"></i></a>
  @if ($howto->h_status === 0)
    <a href="{{ route('admin.courses.delete', [$howto->h_id]) }}" class="ui button red redirect-button"><i class="fas fa-fw fa-trash"></i></a>
  @else
    <a href="{{ route('admin.courses.restore', [$howto->h_id]) }}" class="ui button green redirect-button"><i class="fas fa-fw fa-trash-restore"></i></a>
  @endif
  <a href="{{ route('admin.courses.update', [$howto->h_id]) }}" class="ui button white redirect-button"><i class="fas fa-fw fa-wrench"></i></a>
</div>

<div class="course-container course-view-page">
  <div class="d-flex">
    <div class="left-part">
      <div class="course-lectures">
        <h2>Article Content</h2>
        <ul>
          @foreach (\App\Models\Admin\InnerSteps::steps_of_article($howto->h_id) as $i => $l)
            <li>
              <div class="truncate" style="max-width: 400px !important;">
                <span>{{ $i + 1 }}</span>
                <a href="{{ route('admin.howto.step.view', [$howto->h_id, $l->step_id]) }}">{{ $l->step_title }}</a>
              </div>
              <div class="right-actions">
                <a href="{{ route('admin.howto.step.delete', $l->step_id) }}"><i class="fas fa-fw fa-trash"></i></a>
                <a href="{{ route('admin.howto.step.update', $l->step_id) }}"><i class="fas fa-fw fa-wrench"></i></a>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="course-data">
        <h2>Article Information</h2>
        <ul>
          <li  class="info-li"><span class="rest"><i class="fas fa-fw fa-user"></i> Created By</span> <a href="">{{ $howto->username === 'developer' ? $howto->admin_username : $howto->username }}</a></li>
          <li class="info-li"><span class="rest"><i class="fas fa-fw fa-clock"></i> Published In</span> <span class="blue-c">{{ date('d M, Y', strtotime($howto->createa_at)) }}</span></li>
          <li class="info-li"><span class="rest"><i class="fas fa-fw fa-wrench"></i> Last Update</span> <span class="blue-c">{{ date('d M, Y', strtotime($howto->createa_at)) }}</span></li>
          <li class="info-li"><span class="rest"><i class="fas fa-fw fa-play"></i> Lectures</span> <span class="blue-c">{{ count(\App\Models\Admin\CourseLectures::course_lectures_titles($howto->h_id)) }} lectures</span></li>
          <li class="info-li"><span class="rest"><i class="fas fa-fw fa-wrench"></i> Last Update</span> <span class="blue-c">{{ date('d M, Y', strtotime($howto->createa_at)) }}</span></li>
          <li class="info-li"><span class="rest"><i class="fab fa-megaport"></i> Category</span> <span class="blue-c">{{ $howto->category_name }}</span></li>
        </ul>
      </div>
    </div>
    <div class="right-part">
      <h1>{{ $howto->h_title }}</h1>
      <h5>
        <span class="ml-3">{{ $howto->username === 'developer' ? '@' . $howto->admin_username : '@' . $howto->username }}</span>
      </h5>
      <p>{{ $howto->h_content }}</p>
    </div>
  </div>
</div>
@endsection
