@extends('layouts.app')

@section('content')

<div id= "adminHomePage">
    <div id = "companyUserZone" class= "adminZone">
        <h2 class= "adminHeading"> Company's Member </h2>

        <div id = "currentUsers">
            <div class = "zonaAdminMember">
                <div class = "adminUser adminGreen adminUserTitle">
                    <div class = "adminNameParameter adminButtonText"> Company's Current Member </div>
                </div>
                <div class = "adminUser divIconUserPage"> 
                    <div class = "adminNameParameter adminMemberName"> Sofia Germer </div>
                    <i class="fas fa-user-minus iconAdminHome"></i>
                </div>
                <div class = "adminUser divIconUserPage">  
                    <div class = "adminNameParameter adminMemberName">Miguel Lopes </div>
                    <i class="fas fa-user-minus iconAdminHome"></i>
                </div>
                <div class = "adminUser divIconUserPage"> 
                    <div class = "adminNameParameter adminMemberName"> Edgar Torre </div>
                    <i class="fas fa-user-minus iconAdminHome"></i> 
                </div>
            </div>

            <div class = "zonaAdminMember">
                <div class = "adminUser adminOrange adminUserTitle">
                    <div class = "adminNameParameter adminButtonText"> add a new member to your company </div>
                </div>
                <div class = "adminUser">  
                    <div class = "adminNameParameter"> Add a new member </div>
                    <i class="fas fa-user-minus iconRemoveUser"></i>
                </div>
            </div>
        </div>
    </div>

    <div id = "projectsZone" class= "adminZone"> 
        <h2 class= "adminHeading"> Company's Projects </h2>

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