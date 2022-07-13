@extends('layouts.admin')
@section('title', 'Articles')
@section('content')
  <div class="articles-page section">
    <h1 class="heading">Articles</h1>
    <livewire:admin.articles.display-articles />
  </div>
@endsection

@section('scripts')

@endsection
