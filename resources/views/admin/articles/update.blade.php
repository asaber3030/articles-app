@extends('layouts.admin')

@section('title', 'Add New Article')

@section('content')
  <div class="section add-new-article-page">
    <h1 class="heading">Update Article <strong>" {{ $article->article_title }} "</strong></h1>
    <form method="post" class="form ui">
      @csrf
      <div class="field ui">
        <label>Article Title</label>
        <input name="title" type="text" value="{{ $article->article_title }}">
        @error('title') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="field ui">
        <label>Article Keywords</label>
        <input name="keywords" id="keywords_input" type="text" value="{{ $article->article_keywords }}">
        <div id="keywords_output"></div>
        @error('keywords') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="field ui">
        <label>Article Tags</label>
        <input name="tags" id="tags_input" type="text" value="{{ $article->article_tags }}">
        <div class="tags_output"></div>
        @error('tags') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="field ui">
        <label>Article Content</label>
        <textarea id="editor" name="content">
          {{ $article->article_content }}
        </textarea>
        @error('content') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <button class="ui button blue">Submit</button>
    </form>
  </div>
@endsection
