<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,700;0,800;1,500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="./images/favicon.png" type="image/x-icon">
    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
    <script type="text/javascript" src={{ asset('js/app.js') }} defer>
</script>
  </head>
  <body>
    <main>
      <header>
        
        @if (Auth::check())
        <div class="navbar">
          <a href="{{ url('/cards') }}"><img src="./images/horizontal-logo.png" alt=""></a>
          <div class="navbar-options">
            
            <div class="navbar-collapse-item">
              <a >{{ Auth::user()->name }}</a>
              <img src="./images/profile-pic.png" alt="">
            </div>
            
          </div>
        </div>
        <div class="navbar-collapse">
          <a href=""><div>Profile</div></a>
          <a href="{{ url('/logout') }}"><div>Logout</div></a>
        </div>
         
        @else
        <div class="navbar">
          <a href="{{ url('/') }}"><img src="./images/horizontal-logo.png" alt=""></a>
          <div class="navbar-options">
            <a href="">About Us</a>
            <a href="">FAQ</a>
            <a href="{{ url('/login') }}">Login</a>
            <a href="{{ url('/register') }}">Signup</a>
          </div>
        </div>
        @endif
      </header>
      <div id="filler"></div>
      <section id="content">
        @yield('content')
      </section>
    </main>
  </body>
</html>