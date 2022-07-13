@extends('layouts.admin')

@section('class', 'body-article-view body-default')

@section('title', 'Viewing step of article')

@section('content')

  <div class="article-actions">
    <a href="{{ route('admin.howto.view', $howto->h_id) }}" class="ui button primary redirect-button"><i class="fas fa-fw fa-home"></i></a>
    <a href="{{ route('admin.howto.step.delete', [$step->step_id]) }}" class="ui button red redirect-button"><i class="fas fa-fw fa-trash"></i></a>
    <a href="{{ route('admin.howto.step.update', [$step->step_id]) }}" class="ui button white redirect-button"><i class="fas fa-fw fa-wrench"></i></a>
  </div>
  <div class="article-container article-view-page">
    <div class="left-content">
      <div class="article-content">
        <h1 class="article-title">{{ $step->step_title }}</h1>
        {!! $step->step_content !!}
      </div>
    </div>

    <div class="right-content">

      <h3><i class="fas fa-fw fa-user"></i> HowTo Article</h3>
      <div class="tags labels">
        <span class="label"><a href="{{ route('admin.howto.view', $howto->h_id) }}">{{ $howto->h_title }}</a></span>
      </div>

      <h3><i class="fas fa-fw fa-user"></i> Author</h3>
      <div class="tags labels">
        @if ($howto->username == 'developer')
          <span class="label">{{ '@' . $howto->admin_username }}</span>
        @endif
        @if ($howto->admin_username === 'developer')
          <span class="label">{{ '@' . $howto->username }}</span>
        @endif
      </div>

      <h3><i class="fas fa-fw fa-tags"></i> Tags</h3>
      <div class="tags labels">
        @foreach (explode(',', $howto->h_tags) as $tag)
          <span class="label">{{ $tag }}</span>
        @endforeach
      </div>

      <h3><i class="fas fa-fw fa-search"></i> Keywords</h3>
      <div class="tags labels">
        @foreach (explode(',', $howto->h_keywords) as $tag)
          <span class="label">{{ $tag }}</span>
        @endforeach
      </div>

      <h3><i class="fas fa-fw fa-clock"></i> Published in</h3>
      <div class="tags labels">
        <span class="label">{{ date('d, M Y - h:i A', strtotime($howto->created_at)) }}</span>
      </div>
      <h3><i class="fas fa-fw fa-wrench"></i> Last Update</h3>
      <div class="tags labels">
        <span class="label">{{ date('d, M Y - h:i A', strtotime($howto->updated_at)) }}</span>
      </div>
    </div>

  </div>
@endsection
