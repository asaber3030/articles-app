@extends('layouts.admin')

@section('title', 'Restore This Article')

@section('content')

  <div class="section">
    <h1 class="heading _300"><i class="fas fa-fw fa-trash-restore"></i> Restore Article <strong>"{{ $article->article_title }}" ?</strong></h1>
    <div class="confirmation-message">
      <img src="{{ asset('icons/restore.svg') }}" alt="">
      <h2>Are you sure that you want to restore this article again?</h2>
      <p><i class="fas fa-fw fa-info-circle mr-5"></i> Note: This article visibility will be public for users again to see it!</p>
      <form method="post">
        @csrf
        <button class="ui button primary"><i class="fas fa-fw fa-trash-restore"></i> Restore</button>
        <a class="ui button" href="{{ redirect()->route('admin.articles')->getTargetUrl() }}"><i class="fas fa-fw fa-times"></i> Cancel</a>
      </form>
    </div>
  </div>

@endsection
