@extends('layouts.app')
@section('content')
<script src={{ asset('js/about-us.js') }} defer></script>

<div id="AboutUsPageInfo" class= "AboutUsPage">
	<div class = "AboutUsBox">
		<div class = "AboutUsTitle">
			About Us
		</div>
		<hr class = "AboutUsHR">
		<div id = "AboutUsInfo">
			Project Clinic is the collaboration hub that brings the right tools together to get work done. 
            Our main goal is to connect people to their teams, unify their systems, and drive their business forward.
		</div>
		<div class = "AboutUsDivButton">
			<div id = "AboutUsMembersButton" class = "AboutUsButton" onclick = "showMembersTeam('AboutUsPageInfo','AboutUsPageMembers')">
				More About Team
			</div>
		</div>
	</div>
</div>

	<div id = "AboutUsPageMembers" class ="AboutUsPage">
		<div class = "AboutUsBox">
			<div class = "AboutUsTitle">
				Our Developer's Team
			</div>
			<hr class = "AboutUsHR">
			<div id = "AboutUsTeamDiv">
				<div class = "AboutUsMemberSpace">
					<div class = "AboutUsMember">
						<div class = "AboutUsMemberName">
							Sofia Germer
							<div class = "AboutUsMembersInfo">
								<div class = "AboutUsDivIcon">
									<i class="fas fa-envelope iconUserPage AboutUsIcon"></i>
									<p class="userEmail AboutUsEmail"> up201907461@up.pt </p>
								</div>
								<div class = "AboutUsDivIcon">
									<i class="fas fa-briefcase iconUserPage AboutUsIcon"></i>
									<p class="AboutUsEmail"> FEUP </p>
								</div>
							</div>
						</div>
					</div>
					<div class = "AboutUsMemberPhoto">
						<img src = "/images/avatars/SofiaGermer.jpg" alt= "Sofia" class = "AboutUsPhoto" id = "tempProfilePhoto1">
					</div>
				</div>

				<div class = "AboutUsMemberSpace">
					<div class = "AboutUsMemberPhoto">
						<img src = "/images/avatars/MiguelLopes.png" alt= "Miguel" class = "AboutUsPhoto" id = "tempProfilePhoto2">
					</div>

					<div class = "AboutUsMember">
						<div class = "AboutUsMemberName">
							Miguel Lopes
							<div class = "AboutUsMembersInfo">
								<div class = "AboutUsDivIcon">
									<i class="fas fa-envelope iconUserPage AboutUsIcon"></i>
									<p class="userEmail AboutUsEmail"> up201704590@fe.up.p </p>
								</div>
								<div class = "AboutUsDivIcon">
									<i class="fas fa-briefcase iconUserPage AboutUsIcon"></i>
									<p class="AboutUsEmail"> FEUP </p>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class = "AboutUsMemberSpace">
					<div class = "AboutUsMember">
						<div class = "AboutUsMemberName">
							Edgar Torre
							<div class = "AboutUsMembersInfo">
								<div class = "AboutUsDivIcon">
									<i class="fas fa-envelope iconUserPage AboutUsIcon"></i>
									<p class="userEmail AboutUsEmail"> up201906573@up.pt </p>
								</div>
								<div class = "AboutUsDivIcon">
									<i class="fas fa-briefcase iconUserPage AboutUsIcon" ></i>
									<p class="AboutUsEmail"> FEUP </p>
								</div>
							</div>
						</div>
					</div>
					<div class = "AboutUsMemberPhoto">
						<img src =  "/images/avatars/EdgarTorre.jpg" alt= "Edgar" class = "AboutUsPhoto" id = "tempProfilePhoto3">
					</div>
				</div>

				<div class = "AboutUsMemberSpace">
					<div class = "AboutUsMemberPhoto">
						<img src = "/images/avatars/HenriquePinho.jpg" alt= "Henrique" class = "AboutUsPhoto" id = "tempProfilePhoto4">
					</div>

					<div class = "AboutUsMember">
						<div class = "AboutUsMemberName">
							Henrique Pinho
							<div class = "AboutUsMembersInfo">
								<div class = "AboutUsDivIcon">
									<i class="fas fa-envelope iconUserPage AboutUsIcon"></i>
									<p class="userEmail AboutUsEmail"> up201805000@up.pt </p>
								</div>
								<div class = "AboutUsDivIcon">
									<i class="fas fa-briefcase iconUserPage AboutUsIcon"></i>
									<p class="AboutUsEmail"> FEUP </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class = "AboutUsDivButton">
				<div id = "AboutUsGoBackButton" class = "AboutUsButton" onclick = "goBack('AboutUsPageInfo','AboutUsPageMembers')">
					Go Back To About Us Page
				</div>
			</div>
		</div>
	</div>
@endsection