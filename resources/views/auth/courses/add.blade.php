@extends('layouts.user')
@section('title', 'New Course')
@section('content')

  <div class="profile-page">

    @include('auth.sidebar')

    <div class="add-section add-new-course second-section">

      <h1 class="heading"><i class="fas fa-fw fa-play"></i> Publish New Course</h1>

      <form method="post" class="add-article-form ui form">
        @csrf
        <div class="field">
          <label>Course Title</label>
          <input type="text" name="course_title" value="{{ old('course_title') }}">
          @error('course_title') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Is There's YouTube Link?</label>
          <input type="url" name="course_main_link" value="{{ old('course_main_link') }}">
          @error('course_main_link') <span class="error">{{ $message }}</span> @enderror
        </div>

        <div class="field">
          <label>Category</label>
          <select name="course_category">
            @foreach(\App\Models\Categories::all() as $c)
              <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
            @endforeach
          </select>
        </div>

        <div class="field">
          <div class="checkbox ui">
            <input type="checkbox" id="ch" name="is_private">
            <label for="ch">Is Private?</label>
          </div>
        </div>

        <div class="field">
          <label>Content</label>
          <textarea name="course_content" id="editor">{{ old('course_content') }}</textarea>
          @error('course_content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="ui button primary"><i class="fas fa-fw fa-plus"></i> Publish</button>

      </form>

    </div>

  </div>

@endsection
