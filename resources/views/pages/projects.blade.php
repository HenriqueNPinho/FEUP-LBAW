@extends('layouts.app')

@section('content')


<div id="project-area">

  <div id="projects-bar">
    @each('partials.project-icon',$projects,'project')
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

  <div class="project-overview">
    <div class="boards-container">
      <div class="board">
        <h2>TO DO</h2>
        <div draggable="true" class="task-preview">
          <div class="task-preview-info">
            <h3>Task Name</h2>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Recusandae, dolore.</p>
            <h4>14/01/2022</h4>
          </div>
        </div>
      </div>
      <div class="board">
        <h2>DOING</h2>
      </div>
      <div class="board">
        <h2>DONE</h2>
      </div>
    </div>
  </div>

</div>

@endsection
