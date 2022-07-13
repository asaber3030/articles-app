@extends('layouts.admin')
@section('title', 'Profile')
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

    <div class="content profile-home">
      <div class="articles">

        <h1 class="mb-5">Latest Published Items</h1>

        @if (!$last_article && !$last_course && !$last_step)
          <div class="alert disable-hide-alert">No Articles, Courses, Steps Articles Added by This User</div>
        @endif

        @if ($last_article)
          <div class="last-article section">
            <div class="views-part"><i class="fas fa-fw fa-eye"></i> {{ $last_article->views . ' views' }}</div>
            <h3><i class="fas fa-fw fa-hashtag"></i> {{ $last_article->article_title }}</h3>
            <div class="type-float">Article</div>

            <div class="tags-part">
              @forelse(array_slice(explode(',', $last_article->article_tags), 0, 5) as $l)
                <span>{{ $l }}</span>
              @empty
                <span>No Tags</span>
              @endforelse
            </div>
            <div class="time-part">
              <span><i class="fas fa-fw fa-clock"></i> Last Update: {{ date('d M, Y', strtotime($last_article->updated_at)) }}</span>
              <span><i class="fas fa-fw fa-clock"></i> Published In: {{ date('d M, Y', strtotime($last_article->updated_at)) }}</span>
            </div>
            <div class="actions-part">
              <a href="{{ route('admin.articles.view', $last_article->article_id) }}" class=" ui blue"><i class="fas fa-fw fa-eye"></i> View</a>
            @if ($last_article->status === 0)
                <a href="{{ route('admin.articles.restore', $last_article->article_id) }}" class=" ui blue"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
              @else
                <a href="{{ route('admin.articles.delete', $last_article->article_id) }}" class=" ui blue"><i class="fas fa-fw fa-trash"></i> Delete</a>
              @endif
                <a href="{{ route('admin.articles.update', $last_article->article_id) }}" class=" ui blue"><i class="fas fa-fw fa-wrench"></i> Update</a>
            </div>
          </div>
        @endif

        @if ($last_course)
          <div class="last-course section">
            <h3><i class="fas fa-fw fa-hashtag"></i> {{ $last_course->course_title }}</h3>
            <div class="type-float">Course</div>
            <div class="article-content">
              <p>
                {!! $last_course->course_content !!}
              </p>
            </div>
            <div class="time-part">
              <span><i class="fas fa-fw fa-clock"></i> Last Update: {{ date('d M, Y', strtotime($last_course->updated_at)) }}</span>
              <span><i class="fas fa-fw fa-clock"></i> Published In: {{ date('d M, Y', strtotime($last_course->updated_at)) }}</span>
            </div>
            <div class="actions-part">
              <a href="{{ route('admin.courses.view', $last_course->course_id) }}" class="ui blue"><i class="fas fa-fw fa-eye"></i> View</a>
              @if ($last_course->course_status === 1)
                <a href="{{ route('admin.courses.restore', $last_course->course_id) }}" class="ui blue"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
              @else
                <a href="{{ route('admin.courses.delete', $last_course->course_id) }}" class="ui blue"><i class="fas fa-fw fa-trash"></i> Delete</a>
              @endif
              <a href="{{ route('admin.courses.update', $last_course->course_id) }}" class="ui blue"><i class="fas fa-fw fa-eye"></i> Update</a>
            </div>
          </div>
        @endif

        @if ($last_step)

          <div class="last-step section">
            <h3><i class="fas fa-fw fa-hashtag"></i> {{ $last_step->h_title }}</h3>
            <div class="type-float">Steps Article</div>
            <div class="tags-part">
              @forelse(array_slice(explode(',', $last_step->h_tags), 0, 5) as $l)
                <span>{{ $l }}</span>
              @empty
                <span>No Tags</span>
              @endforelse
            </div>

            <div class="time-part">
              <span><i class="fas fa-fw fa-clock"></i> Last Update: {{ date('d M, Y', strtotime($last_step->updated_at)) }}</span>
              <span><i class="fas fa-fw fa-clock"></i> Published In: {{ date('d M, Y', strtotime($last_step->updated_at)) }}</span>
            </div>
            <div class="actions-part">
              <a href="{{ route('admin.courses.view', $last_step->h_id) }}" class="ui blue"><i class="fas fa-fw fa-eye"></i> View</a>
              @if ($last_step->h_status === 1)
                <a href="{{ route('admin.courses.restore', $last_step->h_id) }}" class="ui blue"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
              @else
                <a href="{{ route('admin.courses.delete', $last_step->h_id) }}" class="ui blue"><i class="fas fa-fw fa-trash"></i> Delete</a>
              @endif
              <a href="{{ route('admin.courses.update', $last_step->h_id) }}" class="ui blue"><i class="fas fa-fw fa-eye"></i> Update</a>
            </div>

          </div>

        @endif
      </div>
    </div>
  </div>
@endsection
