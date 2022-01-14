@extends('layouts.app')
@section('content')


<body id="FAQ-body">
    <main>
        <div id="FAQ">
        <h1 class="faq-heading">FAQ'S</h1>
        <section class="faq-container">
            <div class="faq-one">
               
                <h1 class="faq-page">FAQ 1</h1>
          
                <div class="faq-body">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere
                        necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum
                        aperiam.
                        Perspiciatis, porro!</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-two">
            
                <h1 class="faq-page">FAQ 2</h1>
              
                <div class="faq-body">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere
                        necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum
                        aperiam.
                        Perspiciatis, porro!</p>
                </div>
            </div>
            <hr class="hr-line">
            <div class="faq-three">
             
                <h1 class="faq-page">FAQ 3</h1>
             
                <div class="faq-body">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Velit saepe sequi, illum facere
                        necessitatibus cum aliquam id illo omnis maxime, totam soluta voluptate amet ut sit ipsum
                        aperiam.
                        Perspiciatis, porro!</p>
                </div>
            </div>
        </section>
        </div>
    </main>
    <script  type="text/javascript" src={{ asset('js/faq.js') }} defer></script>
</body>
