<?php 

///////////////////////////////////////////////////////////////////////////////
//Les differentes statistiques associees a la bd///////////////////////////////
///////////////////////////////////////////////////////////////////////////////

require("functions.php");

$AFF=FALSE; 
//Connection a la base : 
mysql_close;
$dsn = 'mysql:host=127.0.0.1; dbname=ProjetWeb2017';
$username = 'root';
//$password = 'Pachadu92'
$password = 'mysql2017';
	
try
	{
	$bd=new PDO($dsn, $username, $password);
	
	}
	catch(Exception $e){
		echo "Connexion non reussie a Mysql";
		die('Erreur: '.$e->getMessage());
	}
	
	
	
	$response=Excecuter($bd,"SELECT COUNT(num_EC) FROM Enzyme");
	
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Statistics </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
		<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="../js/Chart.js"></script>
		<script src="../js/Chart.min.js"></script>
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
						<li ><a href="./aboutUs.php">About us</a></li>
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
		
		<script type="text/javascript">
					function imprimer_page(){
					  window.print();
				}
				</script>
				<form>
				  <input id="impression" name="impression" type="button" onclick="imprimer_page()" value="Print this page" />
				</form>
				
		<div class="menu">
				<u><strong><FONT size="6">Menu</FONT></u></strong> <br>
				
					<UL>
						<LI><a href="#Visitors"><FONT size="3">About the visitors</a></FONT><br>
						<LI><a href="#Database"><FONT size="3">About the database</a></FONT><br>
						
						
					</UL>
					<br><br>
				</div>

	<!-- Mise en page -->
		<div class="contenu">
				<div class="jumbotron_enzyme">
				
			<strong><FONT size="9">  Statistics </FONT></strong>
			<title>ChartJS - BarGraph</title>
				<style type="text/css">
					#chart-container {
						width: 640px;
						height: auto;
					}
				</style>
		
			</div>
		
		<!--Les Visiteurs du site-->
		<UL TYPE="sqare">
			<strong><FONT size="6" color="#DB0073" id="Visitors"><strong>About the visitors</FONT></strong><br>
			<hR  width="100%" >
		
		<!--Nombre de visites du site -->
		<strong><FONT id='TopEnzyme'> Number of visits :  </FONT></strong>
		
		<?php
			$nb_visites=fopen('pagesvues.txt','r');
			while (!feof($nb_visites)){
				$buffer=fgets($nb_visites); 
				echo ' <strong>' . $buffer . '</strong><br/>';
			}

			?><br>
		
		<!--Qui est connecte ?
		<strong><FONT id='TopEnzyme'> Number of people connected  :  </FONT></strong>-->
		<?php
	
			$nb_connected=fopen('Connected.txt','r');
			while (!feof($nb_connected)){
				$buffer=fgets($nb_connected); 
				echo ' <strong>' . $buffer . '</strong><br/>';
			}
	
		?><br><br>
		
		<!--Les jobs des utilisateurs -->
		<strong><FONT id='Jobs'>Jobs of the users </strong></FONT>
		<center><div id="chart-container">
			<canvas id="mycanvas1" width="1000" height="400"></canvas>
		</div>	
			<script type="text/javascript" src="../js/jquery.min.js"></script>
			<script type="text/javascript" src="../js/graph_users.js"></script>
		</center>
		
		<!--A propos de la bd -->
		<FONT size="6" color="#DB0073" id="Database"><strong>About the database</FONT></strong>
		<hr>
		
		<!--Nombre denzymes dans la bd -->
		<strong>Number of enzymes in the database : </strong>
		<?php
		while($data =$response->fetch(PDO::FETCH_ASSOC)){
			?>
			 <?php echo $data['COUNT(num_EC)'];
			
		}	
		
		?><br><br>
		
		<!--Les enzymes a la mode :-->
		
		<center>
			<strong><FONT id='Top'>The 10 most Popular enzymes</FONT></strong><br>
			<div id="chart-container">
			
			<canvas id="mycanvas0" width="800" height="300"></canvas>
		</div></center>
		
		<script type="text/javascript" src="../js/graph_top.js"></script>
		
	
		<br><br>
		<!--Nombre de publications par enzyme -->
		<center>
		<img src="data_publi.php" alt="Graphique JPGraph">
		<div id="chart-container" style="float:right;" margin-left="50;" >
		<strong><FONT id='orgaa'>The 10 firsts enzymes with the most number of publications : </strong></FONT><br><br><br><br><br><br><br>
				<canvas id="mycanvaspub" width="700" height="300"></canvas>
			
				<script type="text/javascript" src="../js/data_publi_top.js"></script>
		</div>

		<br>

		<!--Nombre de synonymes par enzyme -->
		<img src="testgraph.php" alt="Graphique JPGraph" width="250" height="550">
		<div id="chart-container" style="float:right;" margin-left="50;" >
				<strong><FONT id='orgaa'>The 10 firsts enzymes with the most number of synonyms : </strong></FONT><br><br><br><br><br><br><br>
				<canvas id="mycanvassyn" width="700" height="300"></canvas>
			
				<script type="text/javascript" src="../js/data_syn_top.js"></script>
		</div>
	
		
	
		
		<!--Nombre de denzymes par organisme -->
		<img src="data_orga.php" alt="Graphique JPGraph" width="250" height="550">
		<div id="chart-container" style="float:right;" margin-left="50;" >
				<strong><FONT id='orgaa'>The 10 first organisms that have the most number of enzymes : </strong></FONT><br><br><br><br><br><br><br>
				<canvas id="mycanvasLast" width="700" height="300"></canvas>
			
			<script type="text/javascript" src="../js/graph_top_orga.js"></script>
		</div>
		
		<br><br>

		<!--Nombre de maladies par enzyme -->
		
		</center>
		<strong><FONT id='Diseases'>Number of disease per Enzyme  : </strong>0</FONT>
			
			<!--<div id="chart-container">

			<canvas id="mycanvas2" width="1000" height="400"></canvas>
		</div>	
			<script type="text/javascript" src="../js/disease.js"></script>
		-->
		<br><br>
		<center>
		<!--Data coverage -->

		<strong><FONT id='Top'> Data covergae  </FONT></strong><br>
		<strong><FONT id='buble'></strong></FONT>
		<center><div id="chart-container">
		</center>
			<canvas id="popChart" width="50" height="20"></canvas>

		</div>
		
		<script type="text/javascript" src="../js/sp_prosite.js"></script>
		</div>
	</body>	
	<br><br>
</html>
