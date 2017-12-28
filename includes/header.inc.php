<?phpinclude_once 'dbn.inc.php';?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
		<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
	</head>
	
	<body>
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
							<li><a href="./faq.php">FAQ</a></li>
							<li><a href="./contact.php">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
						<?php
						if (isset($_SESSION['mail'])){
							echo "<a href='../includes/logout.inc.php'><img class='icon-logout' src='../img/logout.png'/></a>
									<li><a href='./myAccount.php'>Customer Area</a></li>";
						  }else{
							  echo "<img src='../img/user1.png'  width='35'/>
									<li><a href='../page/login.php'> Log in</a></li>";
						  }
						?>
							
						</ul>
					</div>
					
				</div>
			</nav>
