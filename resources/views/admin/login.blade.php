<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('assets/admin/css/semantic.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/resets.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/main.css') }}">

  <title>Admin Login</title>
</head>
<body class="body-default">

  <div class="admin-login">
    <h1>Login</h1>
    @if (session()->has('msg'))
      <div class="alert info"><i class="fas fa-fw fa-exclamation-triangle"></i> {{ session()->get('msg') }}</div>
    @endif
    <form class="ui form" autocomplete="off" method="post">
      @csrf
      <div class="field">
        <label>Username</label>
        <input type="text" name="username" value="{{ old('username') }}">
        @error('username') <span class="error">{{ $message }}</span> @enderror
      </div>
      <div class="field small">
        <label>Password</label>
        <input type="password" name="password">
        @error('password') <span class="error">{{ $message }}</span> @enderror
      </div>
      <button class="ui button blue" type="submit">Submit</button>
    </form>
  </div>

  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/admin/js/jquery.js') }}"></script>
  <script src="{{ asset('assets/admin/js/semantic.min.js') }}"></script>
  <script src="{{ asset('assets/admin/js/main.js') }}"></script>
</body>
</html>
