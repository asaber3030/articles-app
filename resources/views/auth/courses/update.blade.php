@extends('layouts.user')
@section('title', 'Update Course | ' . $course->course_title)
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="add-section add-new-course second-section">

      <h1 class="heading"><i class="fas fa-fw fa-play"></i> Publish New Course</h1>

      <form method="post" class="add-article-form ui form">
        @csrf
        <div class="field">
          <label>Course Title</label>
          <input type="text" name="course_title" value="{{ $course->course_title }}">
          @error('course_title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Is There's YouTube Link?</label>
          <input type="url" name="course_main_link" value="{{ $course->course_main_link }}">
          @error('course_main_link') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Category</label>
          <select name="course_category">
            @foreach(\App\Models\Categories::all() as $c)
              <option @if ($c->category_id === $course->course_category) selected @endif value="{{ $c->category_id }}">{{ $c->category_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="ui checkbox mb-10">
          <input type="checkbox" id="ch-box-pr" name="is_private" @if($course->is_private === 1) checked @endif>
          <label for="ch-box-pr">Is Private?</label>
        </div>

        <div class="field">
          <label>Content</label>
          <textarea name="course_content" id="editor">{{ $course->course_content }}</textarea>
          @error('course_content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button primary"><i class="fas fa-fw fa-plus"></i> Publish</button>

      </form>

    </div>

  </div>

@endsection
