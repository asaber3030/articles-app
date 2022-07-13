@extends('layouts.admin')
@section('class', 'body-article-view body-default')
@section('title', $user->username . ' | Profile')
@section('content')
  <div class="floating-actions-bottom">
    <a href="{{ route('admin.users') }}" class="ui button primary redirect-button"><i class="fas fa-fw fa-home"></i></a>
    @if ($user->user_status === 1)
      <a href="{{ route('admin.users.delete', [$user->id]) }}" class="ui button red redirect-button"><i class="fas fa-fw fa-trash"></i></a>
    @else
      <a href="{{ route('admin.users.restore', [$user->id]) }}" class="ui button green redirect-button"><i class="fas fa-fw fa-trash-restore"></i></a>
    @endif
    <a href="{{ route('admin.users.update', [$user->id]) }}" class="ui button white redirect-button"><i class="fas fa-fw fa-wrench"></i></a>
  </div>

  <div class="view-user-page">

    <div class="d-flex">

      <div class="left-content">

        <div class="user-left-container">

          <h1>Last Published</h1>

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
                <a href="{{ route('admin.articles.view', $last_article->article_id) }}" class="button ui blue"><i class="fas fa-fw fa-eye"></i> View</a>
                @if ($last_article->status === 0)
                  <a href="{{ route('admin.articles.restore', $last_article->article_id) }}" class="button ui blue"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
                @else
                  <a href="{{ route('admin.articles.delete', $last_article->article_id) }}" class="button ui blue"><i class="fas fa-fw fa-trash"></i> Delete</a>
                @endif
                <a href="{{ route('admin.articles.update', $last_article->article_id) }}" class="button ui blue"><i class="fas fa-fw fa-eye"></i> Update</a>
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
                <a href="{{ route('admin.courses.view', $last_course->course_id) }}" class="button ui blue"><i class="fas fa-fw fa-eye"></i> View</a>
                @if ($last_course->course_status === 1)
                  <a href="{{ route('admin.courses.restore', $last_course->course_id) }}" class="button ui blue"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
                @else
                  <a href="{{ route('admin.courses.delete', $last_course->course_id) }}" class="button ui blue"><i class="fas fa-fw fa-trash"></i> Delete</a>
                @endif
                <a href="{{ route('admin.courses.update', $last_course->course_id) }}" class="button ui blue"><i class="fas fa-fw fa-eye"></i> Update</a>
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
                <a href="{{ route('admin.courses.view', $last_step->h_id) }}" class="button ui blue"><i class="fas fa-fw fa-eye"></i> View</a>
                @if ($last_step->h_status === 1)
                  <a href="{{ route('admin.courses.restore', $last_step->h_id) }}" class="button ui blue"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
                @else
                  <a href="{{ route('admin.courses.delete', $last_step->h_id) }}" class="button ui blue"><i class="fas fa-fw fa-trash"></i> Delete</a>
                @endif
                <a href="{{ route('admin.courses.update', $last_step->h_id) }}" class="button ui blue"><i class="fas fa-fw fa-eye"></i> Update</a>
              </div>

            </div>

          @endif

        </div>

      </div>

      <div class="right-content">
        <div class="user-right-container">
          <h2>{{ $fullname }}</h2>
          <ul>
            <li>Has <span class="code green-c">{{ count($articles) }}</span>  Article(s)</li>
            <li>Added <span class="code green-c">{{ count($steps) }}</span>  Steps Article(s)</li>
            <li>Uploaded <span class="code green-c">{{ count($courses) }}</span>  Course(s)</li>
            <li>Account Created in <span class="code green-c">{{ date('d M, Y', strtotime($user->created_at)) }} </span></li>
            <li>Last updated <span class="code green-c">{{ date('d M, Y', strtotime($user->updated_at)) }} </span></li>
            <li>Enrolled in <span class="code green-c">{{ $count_enrolled }} </span> course(s)</li>
          </ul>
        </div>
      </div>

    </div>

  </div>

@endsection
