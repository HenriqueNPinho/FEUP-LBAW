@extends('layouts.app')

<!-- @section('title', 'Cards') -->

@section('content')

<!-- <section id="cards">
  @each('partials.card', $cards, 'card')
  <article class="card">
    <form class="new_card">
      <input type="text" name="name" placeholder="new card">
    </form>
  </article>
</section> -->

<div id="project-area">

    <div id="projects-bar">
      <div id="add-project"><img src="./images/icons/plus.png" alt=""></div>
    </div>

    <div id="slide-right-menu">
      <div class="slide-right-menu-item"></div>
      <a class="slide-right-menu-item" href="">
        <div>
          <img src="./images/icons/home.png" alt="">
          <h2>Project Overview</h2>
        </div>
      </a>
      <div class="slide-right-menu-item"></div>
      <a class="slide-right-menu-item" href="">
        <div>
          <img src="./images/icons/notifications.png" alt="">
          <h2>Notifications</h2>
        </div>
      </a>
      <div class="slide-right-menu-item"></div>
      <a class="slide-right-menu-item" href="">
        <div>
          <img src="./images/icons/messages.png" alt="">
          <h2>Forum</h2>
        </div>
      </a>
      <div class="slide-right-menu-item"></div>
      <a class="slide-right-menu-item" href="">
        <div>
          <img src="./images/icons/settings.png" alt="">
          <h2>Settings</h2>
        </div>
      </a>
      <div class="slide-right-menu-item"></div>
    </div>

</div>

@endsection
