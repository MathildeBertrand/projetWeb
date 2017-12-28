<?php session_start();?>
	
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Home page </title>
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
							<li class="active"><a href="#">About us</a></li>
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
									<li><a href='./login.php'> Log in</a></li>";
						  }
						?>
						</ul>
						
					</div>
					
				</div>
			</nav>
		
			<div class="container-fluid"/>
				<div class="row" style="margin-top:50px;"/>
				
					  <div class="col-sm-1 col-md-2 col-lg-4">
						<div class="card about">
						  <div class="card-body">
							 <img class="card-img-top" src="../img/mission.png" alt="Card image cap">
								<h4 class="card-title"><center>Mission</center></h4>
								<p class="card-text"><center>With supporting text below as a natural lead-in to additional content.</center></p>
						  </div>
						</div>
					  </div>
					  <div class="col-sm-1 col-md-2 col-lg-4">
						<div class="card about">
						  <div class="card-body">
							  <img class="card-img-top" src="../img/history.jpg" alt="Card image cap">
								<h4 class="card-title"><center>History</center></h4>
								<p class="card-text"><center>With supporting text below as a natural lead-in to additional content.</center></p>
						  </div>
						</div>
					  </div>
					  <div class="col-sm-1 col-md-2 col-lg-4">
						<div class="card about">
						  <div class="card-body">
							  <img class="card-img-top" src="../img/stats.jpeg" alt="Card image cap">
								<h4 class="card-title"><center>Numbers</center></h4>
								<p class="card-text"><center>With supporting text below as a natural lead-in to additional content.</center></p>
						  </div>
						</div>
					  </div>
					  
				</div>
			</div>
	
	</body>
</html>

