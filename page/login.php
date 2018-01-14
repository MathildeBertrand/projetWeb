<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Login </title>
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
							<li><a href="./contact.html">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
							<img src="../img/user1.png"  width="35"/>
							<li class="active"><a href="./login.php"> log in</a></li>
							
						</ul>
					</div>
					
				</div>
			</nav>
			
			<div class="container">
				<div class="jumbotron1">
					<h1><center><img src="../img/atomix_user31.png"  width="150"/></center></h1>
						
						<form action="../includes/login.inc.php" method="POST">
							<div class="form_input">
								<FONT color="#00000"><p><center><input type="text" name="username" id="username" placeholder="Username/Email" style="background-image:url(../img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></center></p></FONT>
								<FONT color="#00000"><p><center><input type="password" name="password"  id="password" placeholder="Password" style="background-image:url(../img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></center></p></FONT>
							</div>
										
							<FONT color="#00000"><p><center><button type="submit" name="submit" class="btn-login">LOGIN</button></FONT>
							<a href="./signup.php"><FONT color="#00000"><input type="BUTTON" name="submit"  value="New User ?"/></center></p></FONT></a>
							<div class="ps_forgotten"><a href="../includes/changePS.inc.php"><FONT color="black"><small>password forgotten?</small></FONT></a></div>
						</form>
						
				</div>
			</div>
				
				
	</body>
</html>



