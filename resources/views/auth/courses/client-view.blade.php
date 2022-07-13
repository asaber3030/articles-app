@extends('layouts.user')
@section('title', 'Course: ' . $course->course_title)
@section('content')

  <div class="course-view-page">

    @if (property_exists($user, 'username'))
      <div class="course-title">
        <img src="{{ asset($user->picture) }}" alt="">
        <div class="text">
          <h2>{{ $user->firstname }} {{ $user->lastname }}</h2>
          <span>{{ '@' . $user->username }}</span>
        </div>
        <div class="time">
          <i class="fas fa-fw fa-clock"></i> Published in
          "{{ time_formatter($course->created_at, 'd, M Y') }}"
        </div>
      </div>
    @elseif (property_exists($user, 'admin_id'))
      <div class="course-title">
        <img src="{{ asset($user->admin_picture) }}" alt="">
        <div class="text">
          <h2>{{ $user->admin_firstname }} {{ $user->admin_lastname }} <span class="ui label blue"><i class="fas fa-fw fa-lock"></i> Admin</span></h2>
          <span>{{ '@' . $user->admin_username }}</span>
        </div>
        <div class="time">
          <i class="fas fa-fw fa-clock"></i> Published in
          "{{ time_formatter($course->created_at, 'd, M Y') }}"
        </div>
      </div>
    @endif

    <h1 class="course-name"><i class="fas fa-fw fa-play"></i> {{ $course->course_title }}</h1>
    <div class="info">
      <ul>
        <li><span><i class="fas fa-fw fa-list"></i> Category</span> <span>{{ \App\Models\Categories::category_name($course->course_category) }}</span></li>
        <li><span><i class="fas fa-fw fa-link"></i> Main Link</span> <span><a href="{{ $course->course_main_link }}" target="_blank">Main Link</a></span></li>
        <li><span><i class="fas fa-fw fa-clock"></i> Last Update</span> <span>{{ time_formatter($course->updated_at, 'd, M Y - h:iA') }}</span></li>
        <li><span><i class="fas fa-fw fa-check"></i> Enrolled</span> <span>{{ \App\Models\Enrollments::count_enrolls($course->course_id) }} user</span></li>
      </ul>
    </div>

    <div class="lectures">
      <h1>Lectures</h1>
      <ul>
        @forelse($lectures as $l)
          <li><a href="{{ route('app.courses.lecture', [$course->course_id, $l->lecture_id]) }}">{{ $l->lecture_title }}</a></li>
        @empty
          <div style="color: #a94444; padding-left: 10px;">No Lectures</div>
        @endforelse
      </ul>
    </div>

    <div class="desc">
      <div class="article-content">
        <h2 style="margin-bottom: 10px !important; margin-left: 10px !important;">Course Description</h2>
        {!! $course->course_content !!}
      </div>
    </div>
  </div>

@endsection
