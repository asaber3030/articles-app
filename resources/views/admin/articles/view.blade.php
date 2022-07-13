@extends('layouts.admin')
@section('class', 'body-article-view body-default')
@section('content')
  <div class="article-actions">
    <a href="{{ route('admin.articles') }}" class="ui button primary redirect-button"><i class="fas fa-fw fa-home"></i></a>
    @if ($article->status === 1)
      <a href="{{ route('admin.articles.delete', [$article->article_id]) }}" class="ui button red redirect-button"><i class="fas fa-fw fa-trash"></i></a>
    @else
      <a href="{{ route('admin.articles.restore', [$article->article_id]) }}" class="ui button green redirect-button"><i class="fas fa-fw fa-trash-restore"></i></a>
    @endif
    <a href="{{ route('admin.articles.update', [$article->article_id]) }}" class="ui button white redirect-button"><i class="fas fa-fw fa-wrench"></i></a>
  </div>
  <div class="article-container article-view-page">
    <div class="left-content">
      <div class="article-content">
        <h1 class="article-title">{{ $article->article_title }}</h1>
        {!! $article->article_content !!}
      </div>
    </div>
    <div class="right-content">

      <h3><i class="fas fa-fw fa-user"></i> Author</h3>
      <div class="tags labels">
        @if ($article->username == 'developer')
          <span class="label">{{ '@' . $article->admin_username }}</span>
        @endif
        @if ($article->admin_username === 'developer')
          <span class="label">{{ '@' . $article->username }}</span>
        @endif
      </div>

      <h3><i class="fas fa-fw fa-tags"></i> Tags</h3>
      <div class="tags labels">
        @foreach (explode(',', $article->article_tags) as $tag)
          <span class="label">{{ $tag }}</span>
        @endforeach
      </div>

      <h3><i class="fas fa-fw fa-search"></i> Keywords</h3>
      <div class="tags labels">
        @foreach (explode(',', $article->article_keywords) as $tag)
          <span class="label">{{ $tag }}</span>
        @endforeach
      </div>

      <h3><i class="fas fa-fw fa-clock"></i> Published in</h3>
      <div class="tags labels">
        <span class="label">{{ date('d, M Y - h:i A', strtotime($article->created_at)) }}</span>
      </div>
      <h3><i class="fas fa-fw fa-wrench"></i> Last Update</h3>
      <div class="tags labels">
        <span class="label">{{ date('d, M Y - h:i A', strtotime($article->updated_at)) }}</span>
      </div>
    </div>
  </div>
@endsection
