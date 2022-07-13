@extends('layouts.user')
@section('title', 'New Step | ' . $article->h_title)
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="add-section add-new-lecture-course second-section">

      <h1 class="heading"><i class="fas fa-fw fa-play"></i> Add New Step to "{{ $article->h_title }}"</h1>

      <form method="post" class="add-article-form ui form" enctype="multipart/form-data">
        @csrf
        <div class="field">
          <label>Step Title</label>
          <input type="text" name="step_title" value="{{ old('step_title') }}">
          @error('step_title') <span class="error">{{ $message }}</span> @enderror
        </div>


        <div class="field">
          <label>Step Content</label>
          <textarea name="step_content" id="editor">{{ old('step_content') }}</textarea>
          @error('step_content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button primary"><i class="fas fa-fw fa-plus"></i> Publish</button>

      </form>

    </div>

  </div>

@endsection
