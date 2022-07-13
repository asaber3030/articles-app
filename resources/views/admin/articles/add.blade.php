@extends('layouts.admin')

@section('title', 'Add New Article')

@section('content')
  <div class="section add-new-article-page select-div-related-actions">
    <div class="content">
      <div class="left-c">
        <h1 class="heading">Add New Article</h1>
        <form method="post" class="form ui">
          @csrf
          <div class="field ui">
            <label>Article Title</label>
            <input name="title" type="text" value="{{ old('title') }}">
            @error('title') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <div class="fields two">
            <div class="field ui">
              <label>Article Keywords</label>
              <input name="keywords" id="keywords_input" type="text" value="{{ old('keywords') }}">
              @error('keywords') <span class="red-c">{{ $message }}</span> @enderror
            </div>
            <div class="field ui">
              <label>Article Tags</label>
              <input name="tags" id="tags_input" type="text" value="{{ old('tags') }}">
              @error('tags') <span class="red-c">{{ $message }}</span> @enderror
            </div>
          </div>
          <div class="field ui">
            <label>Article Content</label>
            <textarea id="editor" name="content">
          {{ old('content') }}
        </textarea>
            @error('content') <span class="red-c">{{ $message }}</span> @enderror
          </div>
          <button class="ui button blue">Submit</button>
        </form>
      </div>

      <div class="right-c">
        <h1>Related Actions</h1>
        <div class="related-actions">
          <div class="action" goto="{{ route('admin.admins.add') }}">
            <div class="icon"><i class="fas fa-plus"></i></div>
            <div class="text">New Admin</div>
          </div>
          <div class="action" goto="{{ route('admin.courses.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">New Course</div>
          </div>
          <div class="action" goto="{{ route('admin.users.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">New User</div>
          </div>
          <div class="action" goto="{{ route('admin.howto.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">New Step Article</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
