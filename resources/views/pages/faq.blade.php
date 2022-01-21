@extends('layouts.app')
@section('title', 'FAQ')
@section('content')

<body id="FAQ-body">
        <div id="FAQ">
        <h1 class="faq-heading">FAQ'S</h1>
        <section class="faq-container">
            <div class="faq-one">
               
                <h1 class="faq-page">What is Project Clinic?</h1>
          
                <div class="faq-body">
                    <p> Project Clinic is a web interface for project management that allows teams to organize their professional projects,
                        whether you are part of a company or not.</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-two">
            
                <h1 class="faq-page">Why should I use Project Clinic to organize my projects?</h1>
              
                <div class="faq-body">
                    <p>Project Clinic can facilitate your team workflow,
                         we provide a kanban board so your team can easily organize the tasks in three stages("To Do", "Doing", "Done"), 
                        a Forum where you can communicate with the your team, and so much more! </p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
             
                <h1 class="faq-page">Can everyone use Project Clinic?</h1>
             
                <div class="faq-body">
                    <p>Project Clinic is open to everyone who wants to easily manage their projects.</p>
                </div>
            </div>
        </section>
        </div>
    <script  src={{ asset('js/faq.js') }} defer></script>
</body>
@endsection


