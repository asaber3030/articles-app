@extends('layouts.admin')

@section('title', 'Add New Course')

@section('content')

  <div class="section add-new-course-page select-div-related-actions">

    <div class="content">
      <div class="left-c">
        <h1 class="heading"><i class="fas fa-fw fa-play"></i> Add New Course</h1>
        <form method="post" class="form ui">

          @csrf

          <div class="field ui">
            <label>Course Title</label>
            <input name="title" type="text" value="{{ old('title') }}">
            @error('title') <span class="red-c">{{ $message }}</span> @enderror
          </div>

          <div class="field ui">
            <label>Course Content</label>
            <textarea style="border: 1px solid #627293" name="content">{{ old('content') }}</textarea>
            @error('content') <span class="red-c">{{ $message }}</span> @enderror
          </div>

          <div class="field ui">
            <label>Main Link</label>
            <input name="main_link" type="text" value="{{ old('main_link') }}">
            @error('main_link') <span class="red-c">{{ $message }}</span> @enderror
          </div>

          <div class="field ui">
            <label>Category</label>
            <select name="category">
              @foreach(\App\Models\Admin\Categories::all_categories() as $c)
                <option value="{{ $c->category_id }}">{{ $c->category_name }}</option>
              @endforeach
            </select>
          </div>

          <div class="field ui">
            <label for="pr">Status</label>
            <select name="status">
              <option value="1">Put in Trash</option>
              <option value="0">Available for users</option>
            </select>
          </div>

          <button class="ui button blue"><i class="fas fa-fw fa-check"></i> Submit</button>
          <button type='button' goto="{{ route('admin.courses') }}" class="ui button"><i class="fas fa-fw fa-times"></i> Cancel</button>

        </form>
      </div>
      <div class="right-c">
        <h1>Related Actions</h1>
        <div class="related-actions">
          <div class="action" goto="{{ route('admin.articles.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">New Article</div>
          </div>
          <div class="action" goto="{{ route('admin.howto.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">New Step Article</div>
          </div>
          <div class="action" goto="{{ route('admin.admins.add') }}">
            <div class="icon"><i class="fas fa-plus"></i></div>
            <div class="text">New Admin</div>
          </div>
          <div class="action" goto="{{ route('admin.users.add') }}">
            <div class="icon"><i class="fas fa-fw fa-plus"></i></div>
            <div class="text">New User</div>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection
