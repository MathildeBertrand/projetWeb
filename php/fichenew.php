<!-- Formulaire pour rentrer le nouveau user dans la bd -->

<?php
require("functions.php");
$AFF=FALSE; 

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

<html>
	<head>
		<meta charset="utf-8">
		<title> New User </title>
		<link rel="stylesheet" href="UI/css/bootstrap.min.css" />
		<link rel="stylesheet" href="UI/css/MyStylesheet.css" />
	</head>
	
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
	
	<div class="container">
			<div class="jumbotron1">
			<form>
				
					<div class="form_input">
						<center>
							<strong><FONT size="9">Please create a new account</strong></FONT> <br><br>
							First Name *  :  <FONT color="#00000"><input type="text" name="Name" id="FirstName"  placeholder="Ex : Jean" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT> <br>
							Last Name * : <FONT color="#00000"><input type="text" name="Name" id="LastName" placeholder="Ex : Jean" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT> <br>
							mail *      : <FONT color="#00000"><input type="text" name="Name"  id ="mail" placeholder="Ex : Jean@gmail.com" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT><br>
							job *       : <FONT color="#00000"><input type="text" name="Name"  id="job" placeholder="Ex : biologist" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT><br>
							Password * : <FONT color="#00000"><input type="text" name="Name" id="ps" placeholder="Ex:num CB" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT>
							<br>
							<a href="javascript:open('fichenew.php?FirstName='+document.getElementById('FirstName').value +' &LastName=' +document.getElementById('LastName').value +' &mail='+document.getElementById('mail').value+ ' &job='+document.getElementById('job').value + ' &ps='+document.getElementById('ps').value,'_self')"><input type="BUTTON" name="submit"  value="Submit"/></a>	
					</center>
				</div>
				</form>
	</div>
</div>

<?php
//Si lutilisateur a remplis le formulaire, alors on remplit la base de donnee
$requete=Excecuter2($bd,"INSERT INTO Users (mail,nom,prenom,password,job) VALUES('".$_GET['mail']."','".$_GET['LastName']."','".$_GET['FirstName']."','".$_GET['ps']."','".$_GET['job']."')");
?>

