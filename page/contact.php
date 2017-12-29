<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Contact </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
	</head>
	
	<body class="bg">
			<nav class="navbar navbar-default">
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
							<li class="active"><a href="#">Contact</a></li>
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
		
		
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-3 col-md-8 col-lg-12">
						<div class="card contact">
							<div class="card-body">
								<h4 class="card-title">BEI Wanying</h4>
								<p class="card-text"><br/> <i class="glyphicon glyphicon-envelope"></i> Mail:
								<br/> <i class="glyphicon glyphicon-earphone"></i> Tel: 
								<br/> <i class="glyphicon glyphicon-home"></i> Adresse: Université Paris-Sud<p style="margin-top:-10px; padding-top: 0px; padding-left:77px">15 Rue Georges Clemenceau<br>91400 Orsay</p>
							</div>
						</div>
					</div>
					
					<div class="col-sm-3 col-md-8 col-lg-12">
						<div class="card contact">
							<div class="card-body">
								<h4 class="card-title">BERTRAND Mathilde</h4>
								<p class="card-text"><br/> <i class="glyphicon glyphicon-envelope"></i> Mail: mathilde.bertrand@u-psud.fr
								<br/> <i class="glyphicon glyphicon-earphone"></i> Tel: 0145983088
								<br/> <i class="glyphicon glyphicon-home"></i> Adresse: Université Paris-Sud<p style="margin-top:-10px; padding-top: 0px; padding-left:77px">15 Rue Georges Clemenceau<br>91400 Orsay</p>
							</div>
						</div>
					</div>
				</div>
			</div>		
	</body>	
</html>

