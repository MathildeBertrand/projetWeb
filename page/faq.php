<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> FAQ </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
		<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
	</head>
	
	<body class="bg">
			<nav class="navbar navbar-default" style="margin-bottom:30px;">
				<div class="container-fluid">
				
					<!-- website name -->
					<div class="navbar-header">
						<a href="#" class="navbar-brand">ENZyclopédia</a>
					</div>
				
					<!-- Menu items -->
					<div>
						<ul class="nav navbar-nav">
							<li><a href="../index.php">Home</a></li>
							<li><a href="./aboutUs.php">About us</a></li>
							<li><a href="./ExplorationBD.php">Exploration BD</a></li>
							<li class="active"><a href="#">FAQ</a></li>
							<li><a href="./contact.php">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
						<?php
						if (isset($_SESSION['mail'])){
							echo "<a href='../includes/logout.inc.php'><img class='icon-logout' src='../img/logout.png'/></a>
									<li><a href='./myAccount.php'>Customer Area</a></li>";
						  }else{
							  echo "<img src='../img/user1.png'  width='35'/>
									<li><a href='./login.php'> Log in</a></li>";
						  }
						?>
							
						</ul>
					</div>
					
				</div>
			</nav>
			
			<div class="row">
				<nav class="col-sm-1 col-md-2 col-lg-3" id="myScrollspy">
					<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">
						<li><a href="#section1"><h2>ENZyclopédia</h2></a></li><br>
						<li><a href="#section2"><h2>Login/Logout</h2></a></li><br>
					</ul>
				</nav>
				
			<div class="col-sm-2 col-md-6 col-lg-8">
					<div id="section1">
						<h1 style="background-color:#B0C4DE;">Enzyclopédia</h1>
						<ul style="list-style-type:none;">
							<li class="faq-question" style="background-color:#DCDCDC;" > Question 1 : What is ENZyclopédia ?</li>
							<li class="faq-answer" style="background-color:#F0F8FF;">ENZyclopédia is an enzyme database that provide informations about Enzyme. You can find informations about different enzymes, enzyme classification, reaction, cofactors...</li>
							<li class="faq-question" style="background-color:#DCDCDC;"> Question 2 : How do you collect the information for your database ?</li>
							<li class="faq-answer" style="background-color:#F0F8FF;">Our data are datas annoted from litterature.</li>
							<li class="faq-question" style="background-color:#DCDCDC;"> Question 3 : Are you data often released ?</li>
							<li class="faq-answer" style="background-color:#F0F8FF;">Our data are updloaded once a year. The new release is available in May.</li>
							<li class="faq-question" style="background-color:#DCDCDC;"> Question 4 : Is there enzymes which are not classified ?</li>
							<li class="faq-answer" style="background-color:#F0F8FF;">Enzyme which are not yet classified are not assigned to EC number. In our database, there is no enzymes which are not classified</li>
							
						</ul>
					</div>

					<div id="section2">
						<h1 style="background-color:#B0C4DE;">Login/Logout</h1>
						<ul style="list-style-type:none;">
							<li class="faq-question" style="background-color:#DCDCDC;"> Question 1 : Password forgotten</li>
							<li class="faq-answer" style="background-color:#F0F8FF;">If you forgot you password, send us an e-mail so that we can reset it.</li>
							<li class="faq-question" style="background-color:#DCDCDC;"> Question 2 : Why should I create an account ?</li>
							<li class="faq-answer" style="background-color:#F0F8FF;">By creating an account, you can save your history of search, write feedback and...</li>
							
						</ul>
					</div>	
			</div>
			
			<script>
				$(document).ready(function(){
					$('li.faq-answer').hide();
					$('li.faq-question').click(function () {
						$(this).next().slideToggle();
					});
				});
				

			</script>
	</body>	
</html>

