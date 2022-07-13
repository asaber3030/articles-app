@extends('layouts.user')
@section('title', 'New Lecture')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="add-section add-new-lecture-course second-section">

      <h1 class="heading"><i class="fas fa-fw fa-play"></i> Add New Lecture to "{{ $course->course_title }}"</h1>

      <form method="post" class="add-article-form ui form" enctype="multipart/form-data">
        @csrf
        <div class="field">
          <label>Lecture Title</label>
          <input type="text" name="lecture_title" value="{{ old('lecture_title') }}">
          @error('lecture_title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Lecture Youtube Link</label>
          <input type="url" name="lecture_youtube_link" value="{{ old('lecture_youtube_link') }}">
          @error('lecture_youtube_link') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Lecture Video</label>
          <div class="field-picture">
            <input type="file" name="lecture_video">
            <h3>
              <img src="{{ asset('icons/upload.png') }}" alt="">
              Choose Video!
            </h3>
          </div>
          @error('lecture_video') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Lecture File</label>
          <div class="field-picture">
            <input type="file" name="lecture_file">
            <h3>
              <img src="{{ asset('icons/upload.png') }}" alt="">
              Choose File!
            </h3>
          </div>
          @error('lecture_file') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Lecture Description</label>
          <textarea name="lecture_content" id="editor">{{ old('lecture_content') }}</textarea>
          @error('lecture_content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button primary"><i class="fas fa-fw fa-plus"></i> Publish</button>

      </form>

    </div>

  </div>

@endsection
