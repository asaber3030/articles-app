<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="description" content="@yield('meta_desc', APP_NAME)">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"/>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>

  <link rel="stylesheet" href="{{ asset('assets/user/css/semantic.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/user/css/resets.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/user/css/user.css') }}">
  @livewireStyles
  <title>@yield('title', 'Something')</title>
</head>
<body class="@yield('class', 'body-default')">

  <div class="ui tiny menu" id="user-navbar">

    <a class="item logo-link" href="{{ route('home') }}">
      <img src="{{ asset('logo/logo-white.png') }}" alt="">
      <h6>keepLearning();</h6>
    </a>

    <div class="mid-links menu">
      <a href="{{ route('app.articles') }}" class="item"><i class="fa-solid fa-newspaper"></i> Articles</a>
      <a href="{{ route('app.howto') }}" class="item"><i class="fa-solid fa-tasks"></i> Steps</a>
      <a href="{{ route('app.courses') }}" class="item"><i class="fa-solid fa-play"></i> Courses</a>
    </div>

    <div class="right menu right-menu">

      <livewire:user.search-box />

      @guest
        <div class="item"><a href="{{ route('login') }}" class="button login-btn ui primary large"><i class="fas fa-fw fa-sign-in-alt"></i> Login</a></div>
        <div class="item"><a href="{{ route('register') }}" class="button ui large register-btn"><i class="fas fa-fw fa-user-plus"></i> Create Account</a></div>
      @endguest

      @auth
        <div class="ui item floating dropdown icon button dropdown-item-main button primary">
          <span style="font-weight: bold !important;">
            {{ '@' . username() }}
            <i class="fas fa-fw fa-caret-down"></i>
          </span>

          <div class="menu">
            <a href="{{ route('profile') }}" class="item"><i class="fas fa-fw fa-user"></i> Profile</a>
            <a href="{{ route('profile.articles') }}" class="item"><i class="fas fa-fw fa-newspaper"></i> My Articles</a>
            <a href="{{ route('profile.courses') }}" class="item"><i class="fas fa-fw fa-play"></i> My Courses</a>
            <a href="{{ route('profile.howto') }}" class="item"><i class="fas fa-fw fa-tasks"></i> My Step Articles</a>
            <hr>
            <a href="{{ route('profile.articles.add') }}" class="item"><i class="fas fa-fw fa-plus"></i> Create New Article</a>
            <a href="{{ route('profile.courses.add') }}" class="item"><i class="fas fa-fw fa-plus"></i> Add New Course</a>
            <a href="{{ route('profile.howto.add') }}" class="item"><i class="fas fa-fw fa-plus"></i> Add New Steps Article</a>
            <hr>
            <a href="{{ route('profile.bookmarks') }}" class="item bookmark-link-drop"><i class="fas fa-fw fa-bookmark"></i> My Bookmarks</a>
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button  class="item logout-link-drop"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</button>
            </form>
          </div>
        </div>
      @endauth
    </div>

  </div>

  <div>
    @yield('content')
    @if (request()->session()->has('msg'))
      <div class="alert-float alert-float-right-top">{{ request()->session()->get('msg') }}</div>
    @endif

  </div>
  @livewireScripts
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/user/js/jquery.js') }}"></script>
  <script src="{{ asset('assets/user/js/semantic.min.js') }}"></script>
  <script src="{{ asset('assets/user/js/main.js') }}"></script>
  <script src="https://cdn.tiny.cloud/1/ak97gh8mq9na3matau07b11mq6p4i8th8srwii58ouzmc1yc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>  <script>
    tinymce.init({
      selector: '#editor',
      plugins: 'fullscreen link bullist numlist image autolink lists media line table',
      toolbar: 'undo redo h1 h2 h3 charmap casechange bgcolor numlist bullist ltr rtl italic bold anchor lineheight strikethrough subscript superscript line advtablerownumbering checklist code export image editimage pageembed permanentpen table tableofcontents',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      skin: "oxide-dark",
      content_css: "dark"
    });
  </script>
  <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
  <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
</body>
</html>
