
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Login </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
	</head>

	<!-- Et on rajoute ce dont on a besoins --> 
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
							<li><a href="./contact.php">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
							 <img src="../img/user1.png"  width="35"/>
							<li><a href="./login.php"> Log in</a></li>"
						</ul>
					</div>
					
				</div>
			</nav>
		
			<div class="container">
				<div class="jumbotron1">
					
						<form action="../includes/signup.inc.php" method="POST">
							<div class="form_input">
								<center>
									<strong><FONT size="9">Please create a new account</strong></FONT> <br><br>
									First Name *  :  <FONT color="#00000"><input type="text" name="FirstName" id="FirstName"  placeholder="Ex : Jean" style="background-image:url(../img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT> <br>
									Last Name * : <FONT color="#00000"><input type="text" name="LastName" id="LastName" placeholder="Ex : Jean" style="background-image:url(../img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT> <br>
									mail *      : <FONT color="#00000"><input type="text" name="mail"  id ="mail" placeholder="Ex : Jean@gmail.com" style="background-image:url(../img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT><br>
									job *       : <FONT color="#00000"><input type="text" name="job"  id="job" placeholder="Ex : biologist" style="background-image:url(../img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT><br>
									Password * : <FONT color="#00000"><input type="text" name="ps" id="ps" placeholder="Ex:num CB" style="background-image:url(../img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT>
									<br>	
								</center>
							</div>
										
							<FONT color="#00000"><p><center><button type="submit" name="submit" class="btn-login">Submit</button></p></FONT>
						</form>
						
				</div>
			</div>
	
	</body>
</html>


