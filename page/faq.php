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
						<li><a href="#section1"><h2>Section1</h2></a></li><br>
						<li><a href="#section2"><h2>Section2</h2></a></li><br>
						<li><a href="#section3"><h2>Section3</h2></a></li><br>
					</ul>
				</nav>
				
			<div class="col-sm-2 col-md-6 col-lg-8">
					<div id="section1">
						<h1>Section1</h1>
						<ul style="list-style-type:none;">
							<li class="faq-question"> Question 1</li>
							<li class="faq-answer">Curabitur blandit tempus porttitor.</li>
							<li class="faq-question"> Question 2</li>
							<li class="faq-answer">Maecenas faucibus mollis interdum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</li>
							<li class="faq-question"> Question 3</li>
							<li class="faq-answer">Aenean lacinia bibendum nulla sed consectetur. Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo.</li>
							<li class="faq-question"> Question 4</li>
							<li class="faq-answer">Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</li>
							<li class="faq-question"> Question 5</li>
							<li class="faq-answer">Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
						</ul>
					</div>
					<div id="section2">
						<h1>Section2</h1>
						<ul style="list-style-type:none;">
							<li class="faq-question"> Question 1</li>
							<li class="faq-answer">Curabitur blandit tempus porttitor.</li>
							<li class="faq-question"> Question 2</li>
							<li class="faq-answer">Maecenas faucibus mollis interdum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</li>
							<li class="faq-question"> Question 3</li>
							<li class="faq-answer">Aenean lacinia bibendum nulla sed consectetur. Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo.</li>
							<li class="faq-question"> Question 4</li>
							<li class="faq-answer">Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</li>
							<li class="faq-question"> Question 5</li>
							<li class="faq-answer">Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
						</ul>
					</div>
					<div id="section3">
						<h1>Section3</h1>
						<ul style="list-style-type:none;">
							<li class="faq-question"> Question 1</li>
							<li class="faq-answer">Curabitur blandit tempus porttitor.</li>
							<li class="faq-question"> Question 2</li>
							<li class="faq-answer">Maecenas faucibus mollis interdum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</li>
							<li class="faq-question"> Question 3</li>
							<li class="faq-answer">Aenean lacinia bibendum nulla sed consectetur. Donec id elit non mi porta gravida at eget metus. Nullam quis risus eget urna mollis ornare vel eu leo.</li>
							<li class="faq-question"> Question 4</li>
							<li class="faq-answer">Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</li>
							<li class="faq-question"> Question 5</li>
							<li class="faq-answer">Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</li>
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

