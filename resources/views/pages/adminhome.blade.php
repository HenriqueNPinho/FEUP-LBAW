@extends('layouts.app')

@section('content')

<div class="container">
    @auth("web")
        @if (Auth::check())
            oh well tou na merda
        @else
            sou user e não tou autenticado wtf
        @endif
    @endauth

    @auth("admin")
        You're an administrator!
    @endauth

    @guest
        You're not logged in!
    @endguest

    @if(auth()->user()->admin)
        é admin então o que CARALHO
    @endif
    <!--
        ISTO FUNCIONA VAI PARA O CARALHO ISTO NAÕ É UM USER
    <a >{{ Auth::guard('web')->user()->name }}</a>
    -->
    </div>

@endsection