@extends('layouts.user')
@section('title', 'New Course')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="add-section add-new-course second-section">

      <h1 class="heading"><i class="fas fa-fw fa-tasks"></i> Publish New How to Article</h1>

      <form method="post" class="add-article-form ui form">
        @csrf
        <div class="field">
          <label>Article Title</label>
          <input type="text" name="article_title" value="{{ old('article_title') }}">
          @error('article_title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Keywords</label>
          <input type="text" name="article_keywords" value="{{ old('article_keywords') }}">
          @error('article_keywords') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Keywords</label>
          <input type="text" name="article_keywords" value="{{ old('article_keywords') }}">
          @error('article_keywords') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <div class="ui checkbox">
            <input type="checkbox" id="ch" tabindex="0" class="hidden" name="">
            <label for="ch">Is Private?</label>
          </div>
        </div>

        <div class="field">
          <label>Content</label>
          <textarea name="article_content" id="editor">{{ old('article_content') }}</textarea>
          @error('article_content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button primary"><i class="fas fa-fw fa-plus"></i> Publish</button>

      </form>

    </div>

  </div>

@endsection
