@extends('layouts.admin')

@section('title', 'Update User')

@section('content')
  <div class="section add-new-user-page" style="width: 50%">
    <h1 class="heading">Update User: <span class="code">{{ '@' . $user->username }}</span></h1>
    <form method="post" class="form ui">
      @csrf
      <div class="field ui">
        <label>Username</label>
        <input name="username" type="text" value="{{ $user->username }}">
        @error('username') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="field ui">
        <label>Firstname</label>
        <input name="firstname" type="text" value="{{ $user->firstname }}">
        @error('firstname') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="field ui">
        <label>Last name</label>
        <input name="lastname" type="text" value="{{ $user->lastname }}">
        @error('lastname') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <div class="field ui">
        <label>E-mail</label>
        <input name="email" type="email" value="{{ $user->email }}">
        @error('email') <span class="red-c">{{ $message }}</span> @enderror
      </div>
      <button class="ui button blue">Submit</button>
    </form>
  </div>
@endsection
