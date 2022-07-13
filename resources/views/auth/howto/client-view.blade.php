@extends('layouts.user')
@section('title', 'Step article: ' . $article->h_title)
@section('content')

  <div class="view-article-page">
    <h1 class="article-title"><i class="fas fa-fw fa-hashtag"></i> {{ $article->h_title }}</h1>
    <div class="article-tags">
      <div><i class="fas fa-fw fa-link"></i> Tags</div>
      @foreach(explode(',', $article->h_tags) as $tag)
        <a href="#">{{ $tag }}</a>
      @endforeach
    </div>
    <div class="article-keywords">
      <div><i class="fas fa-fw fa-search"></i> Keywords</div>
      @foreach(explode(',', $article->h_keywords) as $tag)
        <span>{{ $tag }}</span>
      @endforeach
    </div>

    <div class="article-last-update">
      <div><i class="fas fa-fw fa-clock"></i> Last Update</div>
      <div class="add-bg">{{ time_formatter($article->updated_at, 'd, M Y') }}</div>
    </div>

    <div class="article-user">
      <img src="{{ asset($user->picture) }}" alt="User image">
      <div class="text">
        <h4>{{ $user->firstname . ' ' . $user->lastname }}</h4>
        <span><a href="">{{ '@' . $user->username }}</a></span>
      </div>
      <div class="time">
        <span><i class="fas fa-fw fa-clock"></i> {{ time_formatter($article->created_at, 'd, M Y - h:i:A') }}</span>
      </div>
    </div>
    <div class="article-content">
      {!! $article->h_content !!}
    </div>

    <div class="steps">
      @foreach($steps as $key => $step)
        <div class="step">
          <h1 class="step-title">{{ $key + 1 . '. ' . $step->step_title }}</h1>
          <div class="article-content">
            {!! $step->step_content  !!}
          </div>
        </div>
      @endforeach
    </div>
  </div>

@endsection
