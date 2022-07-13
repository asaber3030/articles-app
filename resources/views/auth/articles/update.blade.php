@extends('layouts.user')
@section('title', 'Update Article | ' . $article->article_title)
@section('content')

  <div class="profile-page">
    @include('auth.sidebar')

    <div class="add-section add-new-article second-section">
      <h1 class="heading"><i class="fas fa-fw fa-plus"></i> Publish New Article</h1>

      <form method="post" class="add-article-form ui form">
        @csrf
        <div class="field">
          <label>Article Title</label>
          <input type="text" name="article_title" value="{{ $article->article_title }}">
          @error('article_title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Article Tags</label>
          <input type="text" name="article_tags" value="{{ $article->article_tags }}">
          @error('article_tags') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Article Search Keywords</label>
          <input type="text" name="article_keywords" value="{{ $article->article_keywords }}">
          @error('article_keywords') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field checkbox" style="display: flex; align-items: center;">
          <div class="ui checkbox">
            <input type="checkbox" id="ch-pr" name="article_status" tabindex="0" class="hidden" @if ($article->status === 0) checked @endif>
            <label for="ch-pr">Is Private</label>
          </div>
        </div>

        <div class="field">
          <label>Article</label>
          <textarea name="article_content" id="editor">{{ $article->article_content }}</textarea>
          @error('article_content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button green"><i class="fas fa-fw fa-wrench"></i> Change</button>

      </form>

    </div>

  </div>

@endsection
