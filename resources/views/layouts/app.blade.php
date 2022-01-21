<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,700;0,800;1,500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">

    <!-- Fontawesome Icons -->
    <script src="https://kit.fontawesome.com/8d94371726.js" crossorigin="anonymous"></script>

    <script src={{ asset('js/app.js') }} defer>
</script>
  </head>
  <body>
    <main>
      <header>
        
        @if (Auth::check())
        <div class="navbar">
          <a href="{{ url('/') }}"><img src="/images/horizontal-logo.png" alt="company-logo"></a>
          <div class="navbar-options">
            <div class="navbar-collapse-item">
              <a >{{ Auth::user()->name }}</a>
              <div class = "profilePhotoCropper" id ="navbarPhotoCropper">
                  @if(empty(Auth::user()->profile_image))
                    <img src = "/images/avatars/profile-pic-2.png" id = "navbarProfilePhoto" alt="generic-profile-pic">
                  @else
                    <img src ="{{Auth::user()->profile_image}}" id = "navbarProfilePhoto" alt="user-profile-pic"> 
                  @endif
              </div>
            </div>
          </div>
        </div>
        <div class="navbar-collapse">
          <a href="{{ url('/userpage') }}"><div>Profile</div></a>
          <a href="{{ url('/logout') }}"><div>Logout</div></a>
        </div>
         
        @else
        <div class="navbar">
          <a href="{{ url('/') }}"><img src="/images/horizontal-logo.png" alt="horizontal-logo"></a>
          <i class="fa fa-bars responsiveNavbarIcon fa-2x"></i>
          <div class="navbar-options navbar-homepage">
            <a href= "{{ url('about-us')}}">About Us</a>
            <a href= "{{ url('faq')}}">FAQ</a>
            <a href= "{{ url('login') }}">Login</a>
            <a href= "{{ url('/register-redirect') }}">Sign Up</a>
          </div>
        </div>
        @endif
        <div id="filler"></div>
      </header>
      <section>
        @yield('content')
      </section>
    </main>
  </body>
</html>
