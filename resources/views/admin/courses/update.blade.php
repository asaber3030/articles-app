@extends('layouts.admin')

@section('title', 'Update course - ' . $course->course_title)

@section('content')
  <div class="section update-course-page">
    <h1 class="heading">Update Course <strong>" {{ $course->article_title }} "</strong></h1>
    <form method="post" class="form ui">
      @csrf

      <div class="field ui">
        <label>Course Title</label>
        <input name="title" type="text" value="{{ $course->course_title }}">
        @error('title') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Course Content</label>
        <textarea name="content">{{ $course->course_content }}</textarea>
        @error('content') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Main Link</label>
        <input name="main_link" type="text" value="{{ $course->course_main_link }}">
        @error('main_link') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Category</label>
        <select name="category">
          @foreach(\App\Models\Admin\Categories::all_categories() as $c)
            <option value="{{ $c->category_id }}" @if($c->category_id === $course->course_category) selected @endif>{{ $c->category_name }}</option>
          @endforeach
        </select>
      </div>

      <div class="field ui">
        <label for="pr">Status</label>
        <select name="status">
          <option value="1" @if ($course->course_status === 1) selected @endif>Put in Trash</option>
          <option value="0" @if ($course->course_status === 0) selected @endif>Available for users</option>
        </select>
      </div>

      <button class="ui button blue"><i class="fas fa-fw fa-check"></i> Submit</button>
    </form>
  </div>
@endsection
