@extends('layouts.app')

@section('content')
<script type="text/javascript" src={{ asset('js/admin-homepage.js') }} defer></script>

<div id= "adminHomePage">

    <div id = "companyUserZone" class= "adminZone">
        <h2 class= "adminHeading"> COMPANY WORKERS </h2>

        <div id = "currentUsers">
            <div class = "zonaAdminMember">
                
                <div class = "adminUser adminGreen adminUserTitle">
                    <div class = "adminNameParameter adminButtonText"> Company's Current Member </div>
                </div>
                @foreach($company->workers as $worker)
                <div class = "adminUser divIconUserPage"> 
                    <h4 class = "adminNameParameter adminMemberName">{{$worker->name}}</h4>
                    <i class="fas fa-user-minus iconAdminHome remove-user-from-company-icon" data-id="{{$worker->id}}"></i>
                </div>
                @endforeach
                <div class = "adminUser divIconUserPage"> 
                    <input id="add-user-to-company-input" type="text" placeholder="Enter the email of the person to invite">
                    <i id="add-user-to-company-icon" class="fas fa-user-plus iconAdminHome"></i>
                </div>
            </div>
        </div>
    </div>

    <div id = "projectsZone" class= "adminZone"> 
        <h2 class= "adminHeading"> COMPANY PROJECTS </h2>

        <div id = "divButtonsAdmin">
            <div class = "adminButton adminGreen">
                <div class = "adminNameParameter adminButtonText"> Current Projects </div>
            </div>
            <div class = "adminButton adminOrange">
                <div class = "adminNameParameter adminButtonText">Archived Projects </div>
            </div>
        </div>
        <div id = "currentProjects">
            <div class = "adminProject"> 
                <div class = "adminProjectTitle">
                    <div class = "adminNameParameter bold"> LBAW </div>
                </div> 
            </div>
            <div class = "adminProject">  
                <div class = "adminProjectTitle">
                    <div class = "adminNameParameter bold"> RCOM </div>
                </div> 
            </div>
            <div class = "adminProject">  
                <div class = "adminProjectTitle">
                    <div class = "adminNameParameter bold"> FSI </div>
                </div>
            </div>
            <div class = "adminProject">  
                <div class = "adminProjectTitle">
                    <div class = "adminNameParameter bold"> PFL </div>
                </div>
            </div>
            <div class = "adminProject"> 
                <div class = "adminProjectTitle">
                    <div class = "adminNameParameter bold"> LTW </div>
                </div> 
            </div>
        </div>
    </div>
    
</div>
@endsection