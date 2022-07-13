@extends('layouts.admin')

@section('title', $step->step_title . ' | Update A Step')

@section('content')

  <div class="section add-new-video-page">

    <h1 class="heading"><i class="fas fa-fw fa-wrench"></i> Update a Step</h1>

    <form method="post" class="form ui">

      @csrf

      <div class="field ui">
        <label>Step Title<span class="red-c"> *</span></label>
        <input name="step_title" type="text" value="{{ $step->step_title }}">
        @error('lecture_title') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <div class="field ui">
        <label>Step Content<span class="red-c"> *</span></label>
        <textarea style="border: none !important;" name="step_content" id="editor">{{ $step->step_content }}</textarea>
        @error('step_content') <span class="red-c">{{ $message }}</span> @enderror
      </div>

      <button class="ui button blue"><i class="fas fa-fw fa-check"></i> Submit</button>

    </form>

  </div>
@endsection

