<?php
require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Mise en page pour la connection login////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

//Connection a la base : 
mysql_close;
try
	{
	$bd=new PDO('mysql:host=127.0.0.1; dbname=ProjetWeb2017','root','Pachadu92');
	
	}
	catch(Exception $e){
		echo "Connexion non reussie a Mysql";
		die('Erreur: '.$e->getMessage());
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Login Page </title>
		<link rel="stylesheet" href="UI/css/bootstrap.min.css" />
		<link rel="stylesheet" href="UI/css/MyStylesheet.css" />
		<body class="bg">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
				
					<!-- website name -->
					<div class="navbar-header">
						<a href="" class="navbar-brand">ENZyclopédia</a>
					</div>
				
					<!-- Menu items -->
					<div>
						<ul class="nav navbar-nav">
							<li class="active"><a href="cover.php">Home</a></li>
							<li><a href="#">About us</a></li>
							<li><a href="ExplorationBD.php">Exploration BD</a></li>
							<li><a href="#">FAQ</a></li>
							<li><a href="#">Contact</a></li>
						</ul>	
					</div>
				</div>
			</nav>

		</body>
		</head>
	
					<div class="container">
								<div class="jumbotron1">
									<h1><center><img src="UI/img/atomix_user31.png"  width="150"/></center></h1>
									
									<form>
										<div class="form_input">
											<FONT color="#00000"><p><center><input type="text" name="username" id="username" placeholder="Enter your User Name" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></center></p></FONT>
										</div>
										
										<div class="form_input">
											<FONT color="#00000"><p><center><input type="text" name="password"  id="password" placeholder="Enter your Password" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></center></p></FONT>
										</div>
										
											<a href="javascript:open('EspaceClient.php?id='+document.getElementById('username').value+' &ps='+ document.getElementById('password').value,'_self')" ><FONT color="#00000"><p><center><input type="BUTTON" name="BUTTON"  value="LOGIN" class="btn-login"/></FONT></a>
											<a href="fichenew.php"><FONT color="#00000"><input type="BUTTON" name="submit"  value="New User ?"/></center></p></FONT></a>
									</form>
								</div>
					</div>
				
				
	
	</html>



