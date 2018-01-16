<?php

//Affiche la liste de lensemble des enzymes sous forme dun tableau

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

//On met le fond decran :

?>

<!DOCTYPE html>
<!-- Mise en page -->
<html>
	<head>
		<meta charset="utf-8">
		<title> Classification by spieces </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
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
							<li><a href="../index.php">Home</a></li>
							<li><a href="./aboutUs.php">About us</a></li>
							<li class="active"><a href="./ExplorationBD.php">Exploration BD</a></li>
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
	



<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/MyStylesheet.css" />
<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
<div class="menu" >
				<u><strong><FONT size="6">Links</FONT></u></strong><br> <br>
					<center>
						<a href=https://www.ncbi.nlm.nih.gov/pubmed><img src="../img/pubmed.png"  width="100"/></a><br><br>
						<a href=http://prosite.expasy.org/><img src="../img/prosite.gif" width="100"/></a><br><br>
						<a href=http://www.uniprot.org><img src="../img/sp.png"  width="100"/></a><br><br>
						<a href=http://www.kegg.jp/><img src="../img/kegg.jpg"  width="100"/></a><br><br>
					</center>
			</div>
		</nav>
			
			<script type="text/javascript">
					function imprimer_page(){
					  window.print();
				}
				</script>
				<form>
				  <input id="impression" name="impression" type="button" onclick="imprimer_page()" value="Print this page" />
				</form>
	
<div class="contenu">
	<div class="jumbotron_enzyme">
						<strong><FONT size="5">The repartition of enzyme function on different spiecies</strong></FONT>
	</div>
	<br>
	<br>
	<head>
		<title>ChartJS - Doughnut</title>
		<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="../js/Chart.js"></script>
		<script type="text/javascript" src="../js/classi_Human.js"></script>
	</head>
	
	<body><center>
			<FONT size="4">Human : </FONT>
			<canvas id="mycanvas" width="256" height="256"></canvas>
			
			<script type="text/javascript" src="../js/classi_ecoli.js"></script>
			<FONT size="4">E-Coli : </FONT>
				<canvas id="mycanvas1" width="256" height="256"></canvas>
			
			<br>
			<br><br><br>
			<script type="text/javascript" src="../js/classi_mouse.js"></script>
			<FONT size="4">Mouse : </FONT>
				<canvas id="mycanvas2" width="256" height="256"></canvas>
			
			<script type="text/javascript" src="../js/classi_yeast.js"></script>
			<FONT size="4">Yeast : </FONT>
				<canvas id="mycanvas3" width="256" height="256"></canvas><br>


			<br><br>
			<script type="text/javascript" src="../js/classi_pois.js"></script>
			<FONT size="4">Pea : </FONT>
				<canvas id="mycanvas4" width="256" height="256"></canvas>

	
			<script type="text/javascript" src="../js/classi_arabidopsis.js"></script>
			<FONT size="4"> Pennisetum glaucum: </FONT>
				<canvas id="mycanvas5" width="256" height="256"></canvas></center>

	
				
				<input   style="width:25px; height:25px;background-color: #6495ED; color: #000000;" /> Oxydoreductases<br>
				<input   style="width:25px; height:25px;background-color: #90EE90; color: #000000;" /> Transferases<br>
				<input   style="width:25px; height:25px;background-color: #FFA500; color: #000000;" /> Hydrolases<br>
				<input   style="width:25px; height:25px;background-color: #FFC0CB; color: #000000;" /> Lyases<br>
				<input   style="width:25px; height:25px;background-color: #FFFF00; color: #000000;" /> Isomerases<br>
				<input   style="width:25px; height:25px;background-color: #008000; color: #000000;" /> Ligases
		</body>
			
			<br>
