<!DOCTYPE html>

<?php
session_start();
//~ include_once 'includes/dbh.inc.php';
///////////////////////////////////////////////////////////////////////////////
//Fichier qui permet de realiser linterface (page dacceuil)////////////////////
///////////////////////////////////////////////////////////////////////////////

//On compte le nombre de vues sur la page d'acceuil et ecriture dans un fichier text
$file=fopen('pagesvues.txt','r+');
$nb_visites = fgets($file);//On lit la premiere ligne (nb de page lues)
$nb_visites+=1;//On augmente de 1 le nombre de pages vues
fseek($file, 0); // On remet le curseur au début du fichier
fputs($file, $nb_visites); // On écrit le nouveau nombre de pages vues
fclose($file);

//Creation de linterface : 
?>


<html>
	<head>
		<meta charset="utf-8">
		<title> Home page </title>
		<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css" />
		<link rel="stylesheet" type="text/css" href="./css/MyStylesheet.css" />
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
							<li class="active"><a href="../index.php">Home</a></li>
							<li><a href="page/aboutUs.php">About us</a></li>
							<li><a href="page/ExplorationBD.php">Exploration BD</a></li>
							<li><a href="page/faq.php">FAQ</a></li>
							<li><a href="page/contact.html">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
							<?php
							if (isset($_SESSION['mail'])){
								echo "<a href='./includes/logout.inc.php'><img class='icon-logout' src='./img/logout.png'/></a>
									<li><a href='./page/myAccount.php'>Customer Area</a></li>";
							  }else{
								  echo "<img src='./img/user1.png'  width='35'/>
										<li><a href='./page/login.php'> Log in</a></li>";
							  }
							?>
							
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
									<p><center>An enzyme database</center></p>
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
									<OPTION>Protein sequence
									</SELECT>	
									
									<!-- Le champ de texte -->
									<input type="text" name="enter" id="txt" size="60" placeholder="Ex: 1.1.1.1/Zinc/PDOC00060/ADH/ADH1_ALLMI or P80222 "/> 
									
									
									<!-- Gestion des requetes a la bd -->
									
									<SCRIPT type='text/javascript'>
										
									/*Fonction verifier formulaire*/
									/*Si le champ text nest pas remplis alors on ne pourra pas cliquer sur le bouton search */
									function verifForm()
									{
										if(document.getElementById('txt').value =='')
										{
											document.getElementById('bouton').disabled=false;
									 
										}else{
											document.getElementById('bouton').disabled=true;
											open('page/fiche1.php?val='+document.getElementById('txt').value +' &type=' +document.getElementById('liste').value,'_self');
										}
									}
									
								
									</script>
									
									<!-- Le bouton de validation de la requete -->
									<input type="BUTTON" id="bouton" value="Search" onchange="verifForm();" OnClick="verifForm();"/>
								
									</center>
									</FORM>
			
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

	</body>
	
</html>
