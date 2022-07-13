@extends('layouts.user')
@section('title', 'Articles')
@section('content')

<div class="profile-page">

  @include('auth.sidebar')

  <div class="enrolled-users second-section">

    <h1>Users Enrolled in: <span>{{ $course->course_title }}</span></h1>

    <div class="users">
      @forelse($enrolls as $e)
        <div class="user">
          <h4><a href=""><i class="fas fa-fw fa-user"></i> {{ '@' . \App\Models\User::get_user_by_id($e->enroll_user)->username }}</a></h4>
          <span><i class="fas fa-fw fa-clock"></i> {{ time_formatter($e->created_at, 'd, M Y') }}</span>
        </div>
      @empty
        <div class="no-enrolls"><i class="fas fa-fw fa-times"></i> No Users Enrolled</div>
      @endforelse
    </div>

  </div>

</div>


@endsection
