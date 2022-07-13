@extends('layouts.admin')
@section('title', 'Articles Statistics')
@section('content')
<div class="section articles-stats-page">
  <h1 class="heading _300"><i class="fas fa-fw fa-chart-line"></i> Statistics</h1>
  <h2 class="slide-section" collapse-section=".last-5-articles">Last 4 articles <i class="fas fa-fw fa-chevron-down"></i></h2>
  <div class="last-5-articles sec">
    <div class="flex-b">
      @foreach ($last_5_articles as $a)
        <div class="article">
          <div class="flex">
            <div class="img">
              @if ($a->username == 'developer')
                <img src="{{ asset($a->admin_picture) }}" alt="">
              @else
                <img src="{{ asset($a->picture) }}" alt="">
              @endif
            </div>
            <div class="content">
              <h3 class="_300">{{ $a->article_title }}</h3>
              @if ($a->username === 'developer')
                <span>{{ 'By @' . $a->admin_username }}</span>
              @else
                <span>{{ 'By @' . $a->username }}</span>
              @endif
              <p>
                @foreach (explode(',', $a->article_keywords) as $t)
                  <span class="label">{{ $t }}</span>
                @endforeach
              </p>
            </div>
          </div>
          <a href="{{ route('admin.articles.update', $a->article_id) }}" class="ui button"><i class="fas fa-fw fa-wrench"></i> Update</a>
          @if ($a->status === 1)
            <a href="{{ route('admin.articles.delete', $a->article_id) }}" class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete</a>
          @else
            <a href="{{ route('admin.articles.restore', $a->article_id) }}" class="ui button blue"><i class="fas fa-fw fa-trash-restore"></i> Restore</a>
          @endif
          <a href="{{ route('admin.articles.view', $a->article_id) }}" class="ui button black"><i class="fas fa-fw fa-eye"></i> View</a>
        </div>
      @endforeach
    </div>
  </div>

  <h2 class="slide-section" collapse-section=".important-numbers">Most Important Numbers <i class="fas fa-fw fa-chevron-down"></i></h2>
  <div class="important-numbers sec">
    <div class="numbers">
      <ul>
        <li><span class="text"><i class="fas fa-fw fa-sort-numeric-up-alt"></i> Highest Article views</span> <span><span class="green-c"><a class="ui button" href="{{ route('admin.articles.view', $highest_views_article->article_id) }}"> Article Link</a> {{ $highest_views_article->views }} views</span></span></li>
        <li><span class="text"><i class="fas fa-fw fa-text-width"></i> Longest Article</span> <span><span class="green-c"><a class="ui button" href="{{ route('admin.articles.view', $longest_article->article_id) }}"> Article Link</a> {{ $longest_article->views }} views</span></span></li>
        <li><span class="text"><i class="fas fa-fw fa-trash"></i> Deleted Articles</span> <span><a href="{{ route('admin.articles.restore.all') }}" class="button ui blue">Restore all</a> <span class="red-c">{{ $deleted_count }}</span> deleted articles</span></li>
        <li><span class="text"><i class="fas fa-fw fa-check"></i> Available Articles</span> <span><a href="{{ route('admin.articles.delete.all') }}" class="button ui red">Delete all</a> <span class="blue-c">{{ $available_count }}</span> available articles </span></li>
        <li><span class="text"><i class="fas fa-fw fa-user"></i> Created Articles By User</span> <span><span class="green-c">{{ $count_articles_by_user }}</span> articles created by users</span></li>
        <li><span class="text"><i class="fas fa-fw fa-user-lock"></i> Created Articles By Admin</span> <span><span class="green-c">{{ $count_articles_by_admin }}</span> articles created by admin</span></li>
      </ul>
    </div>
  </div>
</div>
@endsection

