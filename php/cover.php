<?php

///////////////////////////////////////////////////////////////////////////////
//Fichier qui permet de realiser linterface du site Web////////////////////////
///////////////////////////////////////////////////////////////////////////////
	
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Home page </title>
		<link rel="stylesheet" href="UI/css/bootstrap.min.css" />
		<link rel="stylesheet" href="UI/css/MyStylesheet.css" />
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
							<li class="active"><a href="cover.php">Home</a></li>
							<li><a href="#">About us</a></li>
							<li><a href="ExplorationBD.php">Exploration BD</a></li>
							<li><a href="#">FAQ</a></li>
							<li><a href="#">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
							<img src="UI/img/user1.png"  width="35"/>
							<li><a href="login.php"> log in</a></li>
							
						</ul>
					</div>
					
				</div>
			</nav>
		</body>
		
			<div class="container-fluid">
				<div class="row">			
					<div class="col-sm-3 col-md-8 col-lg-12"></div>
						<div class="jumbotron1">
							<div class="row">
								<div class="col-sm-3 col-md-8 col-lg-12">
									<h1><center>ENZyclopédia</center></h1>
									<p><center>Voici une petite intro</center></p>
								</div>
							</div>
							
							<div class="row">
								<div class="col-sm-3 col-md-8 col-lg-12">
									<FORM>
									<center>
										<!-- La liste deroulante -->
									<SELECT name="nom" size="1" id="liste" onChange="javascript:document.getElementById('liste').value">
									<OPTION>EC
									<OPTION>Cofactor
									<OPTION>Disease
									<OPTION>Protein family
									<OPTION>Names
									</SELECT>	
									
									<!-- Le champ de texte -->
									<input type="text" name="enter" id="txt" size="60" placeholder="Ex: 1.1.1.1/Zinc/PDOC00060/ADH"/> 
									
									
									<!-- Gestion des requetes a la bd -->
									<a href="javascript:open('fiche1.php?val='+document.getElementById('txt').value +' &type=' +document.getElementById('liste').value,'_self')"><input type="BUTTON" value="Search"/></a>
									</form?>
									</center>
									</FORM>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	
	
</html>
