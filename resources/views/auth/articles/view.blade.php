@extends('layouts.user')
@section('title', 'Article: ' . $article->article_title)
@section('content')

<div class="view-article-page">
  <h1 class="article-title"><i class="fas fa-fw fa-hashtag"></i> {{ $article->article_title }}</h1>
  <div class="article-tags">
    <div><i class="fas fa-fw fa-link"></i> Tags</div>
    @foreach(explode(',', $article->article_tags) as $tag)
      <a href="#">{{ $tag }}</a>
    @endforeach
  </div>
  <div class="article-keywords">
    <div><i class="fas fa-fw fa-search"></i> Keywords</div>
    @foreach(explode(',', $article->article_keywords) as $tag)
      <span>{{ $tag }}</span>
    @endforeach
  </div>

  <div class="article-last-update">
    <div><i class="fas fa-fw fa-clock"></i> Last Update</div>
    <div class="add-bg">{{ time_formatter($article->updated_at, 'd, M Y') }}</div>
  </div>

  <div class="details">
    <div><i class="fas fa-fw fa-eye"></i> Views</div>
    <div>{{ \App\Models\ArticleViews::count_views_of_article($article->article_id) }} views</div>
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
    {!! $article->article_content !!}
  </div>
</div>

@endsection
