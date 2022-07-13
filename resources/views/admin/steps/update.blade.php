@extends('layouts.admin')

@section('title', 'Update HowTo Article - ' . $howto->h_title)

@section('content')
  <div class="section update-h-page">
    <h1 class="heading">Update HowTo Article <strong>" {{ $howto->h_title }} "</strong></h1>
    <form method="post" class="form ui">
      @csrf

      <div class="field ui">
        <label>Title</label>
        <input name="title" type="text" value="{{ $howto->h_title }}">
        @error('title') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Content</label>
        <textarea name="content" id="editor">{{ $howto->h_content }}</textarea>
        @error('content') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Keywords</label>
        <input name="keywords" value="{{ $howto->h_keywords }}">
        @error('keywords') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Tags</label>
        <input name="tags" value="{{ $howto->h_tags }}">
        @error('tags') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label for="pr">Status</label>
        <select name="status">
          <option value="1" @if ($howto->h_status === 1) selected @endif>Put in Trash</option>
          <option value="0" @if ($howto->h_status === 0) selected @endif>Available for users</option>
        </select>
      </div>

      <button class="ui button blue"><i class="fas fa-fw fa-check"></i> Submit</button>
    </form>
  </div>
@endsection
