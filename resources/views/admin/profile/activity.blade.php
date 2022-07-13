@extends('layouts.admin')
@section('title', 'Profile | Activities')
@section('add-remove', 'remove-padding-content')
@section('content')
  @php
    use App\Models\Admin\Admin;
  @endphp

  <div class="admin-profile">
    <div class="profile-top">
      <div class="left-content">
        <div class="top">
          <div class="img" goto="{{ route('admin.change.picture') }}"><img src="{{ asset(Admin::picture()) }}" alt="My Picture"></div>
          <div class="text">
            <h2>{{ Admin::fullname() }}</h2>
            <span>{{ '@' . Admin::username() }}</span>
          </div>
        </div>
        <div class="bottom">
          <span class="label"><i class="fas fa-fw fa-newspaper"></i> 3  Articles</span>
          <span class="label"><i class="fas fa-fw fa-play"></i> 3  Courses</span>
          <span class="label"><i class="fas fa-fw fa-tasks"></i> 3  Steps</span>
        </div>
      </div>
      <div class="right-content">
        <span><i class="fas fa-fw fa-clock"></i> Last Update {{ date('d M, Y', strtotime(Admin::admin()->updated_at)) }}</span>
        <span><i class="fas fa-fw fa-clock"></i> Created at {{ date('d M, Y', strtotime(Admin::admin()->created_at)) }}</span>
        <span><i class="fas fa-fw fa-clock"></i> {{ count(\App\Models\Admin\AdminActivity::current_admin_activity()) }} Total Activities</span>
      </div>
    </div>

    @include('admin.profile.tabs')
    @php
    @endphp
    <div class="content profile-home">
      <div class="activities">
        <h1>Latest Activities</h1>
        @foreach ($activities as $a)
          <div class="activity">
            <div class="icon"><i class="fas fa-fw fa-{{ $a->ac_icon }}"></i></div>
            <div class="information">
              <h2>{{ $a->ac_title }}</h2>
              <p>{{ $a->ac_desc }}</p>
              <span><i class="fas fa-fw fa-clock mr-3"></i> {{ date('d/m/Y - h:i A', strtotime($a->created_at)) }}</span>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    @php
      $activities = $activities->toArray();
      array_pop($activities['links']);
      array_shift($activities['links']);
    @endphp

    @if (count($activities['links']) > 1)
      <div class="ui pagination default-pagination menu float-right" style="margin-right: 10px;">
        @if (!is_null($activities['prev_page_url']))
          <a class="item" href="{{ $activities['prev_page_url'] }}"><i class="fas fa-fw fa-angle-double-left"></i></a>
        @endif
        @foreach ($activities['links'] as $l)
          <a class="item @if ($l['active']) active @endif" href="{{ $l['url'] }}">{{ $l['label'] }}</a>
        @endforeach
        @if (!is_null($activities['next_page_url']))
          <a class="item" href="{{ $activities['next_page_url'] }}"><i class="fas fa-fw fa-angle-double-right"></i></a>
        @endif
      </div>
    @endif
  </div>
@endsection
