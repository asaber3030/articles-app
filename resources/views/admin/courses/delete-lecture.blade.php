@extends('layouts.admin')

@section('title', 'Delete Lecture')

@section('content')

  <div class="section">
    <h1 class="heading _300"><i class="fas fa-fw fa-trash"></i> Delete A Lecture</h1>
    <div class="confirmation-message">
      <img src="{{ asset('icons/delete.svg') }}" alt="">
      <h2>By Deleting this lecture you won't be able to restore it again!</h2>
      <p><i class="fas fa-fw fa-info-circle mr-5"></i> Note: This Delete action isn't temporary yet! And the video and lecture file will be deleted also</p>
      <form method="post">
        @csrf
        <button class="ui button red"><i class="fas fa-fw fa-trash"></i> Delete</button>
        <a class="ui button" href="{{ route('admin.courses.view', $id) }}"><i class="fas fa-fw fa-times"></i> Cancel</a>
      </form>
    </div>
  </div>

@endsection
