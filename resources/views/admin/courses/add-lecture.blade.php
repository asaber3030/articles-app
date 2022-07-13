@extends('layouts.admin')

@section('title', $course->course_title . ' | Add A New Video For Course')

@section('content')

  <div class="section add-new-video-page">

    <h1 class="heading"><i class="fas fa-fw fa-play"></i> Add New Video</h1>

    <form method="post" class="form ui" enctype="multipart/form-data">

      @csrf

      <div class="field ui">
        <label>Lecture Title<span class="red-c"> *</span></label>
        <input name="lecture_title" type="text" value="{{ old('lecture_title') }}">
        @error('lecture_title') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Youtube Link?</label>
        <input name="youtube_link" type="text" value="{{ old('youtube_link') }}">
        @error('youtube_link') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Attach File?</label>
        <input name="lecture_file" type="file" value="{{ old('lecture_file') }}">
        @error('lecture_file') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Video</label>
        <input name="lecture_video" type="file" value="{{ old('lecture_video') }}">
        @error('lecture_video') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Lecture Content<span class="red-c"> *</span></label>
        <textarea name="lecture_content" id="editor">{{ old('lecture_content') }}</textarea>
        @error('lecture_content') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <button class="ui button blue"><i class="fas fa-fw fa-check"></i> Submit</button>

    </form>

  </div>
@endsection

@section('scripts')

@endsection
