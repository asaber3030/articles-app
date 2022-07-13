<!DOCTYPE HTML>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@100;300;400;700;900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{ asset('assets/admin/css/semantic.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/resets.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/main.css') }}">
  @livewireStyles

  <title>@yield('title', 'Dashboard')</title>
</head>
<body class="@yield('class', 'body-default')">
  @php
    use App\Models\Admin\Admin;
    $admin = Admin::admin();
  @endphp
  @if (!Admin::admin())
    <script>window.location.href = 'admin/login'; </script>
  @endif


  <div class="content">

    <div class="sidebar">
      <div class="top-part">
        <a href=""><img src="{{ asset($admin->admin_picture) }}" alt="Admin Picture"></a>
        <h3>
          {{ Admin::fullname() }}
          <span><a href="{{ route('admin.profile') }}">{{ '@' . Admin::username() }}</a></span>
        </h3>
        <a href="" class="settings-link"><i class="fas fa-fw fa-cog"></i></a>
      </div>
      <div class="links-part">
        <h3><i class="fas fa-fw fa-globe"></i> Website</h3>
        <ul>
          <li>
            <a
              href="{{ route('admin.dashboard') }}"
              @if (request()->is('admin')) class='active' @endif><i class="fas fa-fw fa-home"></i> Dashboard</a>
          </li>
          <li>
            <a
              href="{{ route('admin.articles') }}"
              @if (request()->is('admin/articles*')) class='active' @endif><i class="fas fa-fw fa-newspaper"></i> Articles</a>
          </li>
          <li>
            <a
              href="{{ route('admin.courses') }}"
              @if (request()->is('admin/courses*')) class='active' @endif><i class="fas fa-fw fa-play"></i> Courses</a>
          </li>
          <li>
            <a
              href="{{ route('admin.howto') }}"
              @if (request()->is('admin/how-to*')) class='active' @endif><i class="fas fa-fw fa-tasks"></i> HowTo</a>
          </li>
          <li><a
              href="{{ route('admin.users') }}"
              @if (request()->is('admin/users*')) class='active' @endif><i class="fas fa-fw fa-users"></i> Users</a>
          </li>
          <li><a
              href="{{ route('admin.admins') }}"
                 @if (request()->is('admin/admins*')) class='active' @endif><i class="fas fa-fw fa-user-lock"></i> Admins</a>
          </li>
        </ul>

        <h3><i class="fas fa-fw fa-cogs"></i> Settings</h3>
        <ul>
          <li><a href=""><i class="fas fa-fw fa-images"></i> Theme</a></li>
          <li><a @if (request()->is('admin/profile*')) class='active' @endif href="{{ route('admin.profile') }}"><i class="fas fa-fw fa-user"></i> My Account</a></li>
        </ul>

        <h3><i class="fas fa-fw fa-info-circle"></i> Information</h3>
        <ul>
          <li><a href=""><i class="fas fa-fw fa-globe"></i> Database</a></li>
        </ul>
      </div>
    </div>

    <div class="page @yield('add-remove', 'def-rm')">@yield('content')</div>

  </div>

  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
  <script src="{{ asset('assets/admin/js/jquery.js') }}"></script>
  <script src="{{ asset('assets/admin/js/semantic.min.js') }}"></script>
  <script src="https://cdn.tiny.cloud/1/ak97gh8mq9na3matau07b11mq6p4i8th8srwii58ouzmc1yc/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
    tinymce.init({
      selector: '#editor',
      plugins: 'a11ychecker fullscreen link bullist numlist advcode casechange export formatpainter image editimage linkchecker autolink lists checklist media line mediaembed pageembed permanentpen powerpaste table advtable tableofcontents tinycomments tinymcespellchecker',
      toolbar: 'undo redo h1 h2 h3 charmap casechange bgcolor numlist bullist ltr rtl italic bold anchor lineheight strikethrough subscript superscript line advtablerownumbering checklist code export image editimage pageembed permanentpen table tableofcontents',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: '{{ $admin->admin_username }}',
      skin: "oxide-dark",
      content_css: "dark"
    });
  </script>
  <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
  <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
  @yield('scripts')
  <script src="{{ asset('assets/admin/js/main.js') }}"></script>
  @livewireScripts
</body>
</html>
