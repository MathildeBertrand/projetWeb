<?php
session_start();
require("functions.php");


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
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> My Count </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
	</head>
	
	<body>
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
							<li><a href="../includes/logout.inc.php"> Log out</a></li>
							
						</ul>
					</div>
					
				</div>
			</nav>

			<div class="jumbotron jumbotron-fluid" style="padding-bottom: 10px; padding-top: 10px; background: url('../img/adn.jpg') no-repeat center fixed; background-size:cover;">
				<div class="container">
					<div class="col-sm-1 col-md-2 col-lg-4" >
						<img class="portrait" src="../img/smiley.jpeg" height="200" width="150"/>
					</div>
					<div class="col-sm-2 col-md-6 col-lg-8"> 
						<div class="row" style="padding-top:25px;">
								 <blockquote>
									<p>
										<?php echo $_SESSION['prenom']." ".$_SESSION['nom']?>
									</p>
								</blockquote>
								
								<i class="glyphicon glyphicon-envelope"></i> Mail: <?php echo $_SESSION['mail']?>
								<br><i class="glyphicon glyphicon-briefcase"></i> Job: <?php echo $_SESSION['job']?>
								
								<div class="text-left" style="padding-top:30px;">	
									<a href="./favori.php"><button type="button" class="btn btn-warning" style="margin-right: 10px; margin-left: 10px;">Favorites</button></a>
									<a href="./history.php"><button type="button" class="btn btn-warning" style="margin-right: 10px; margin-left: 10px;">History</button></a>
									<a href="./editProfil.php"><button type="button" class="btn btn-warning" style="margin-right: 10px; margin-left: 10px;">Edit Profil</button></a>
									<a href="./editContent.php"><button type="button" class="btn btn-warning" style="margin-right: 10px; margin-left: 10px;">Edit Text</button></a>
								</div>
						
						</div>
					</div>
				</div>
			</div>

	
		<?php
			$favori=array();
			$mail=$_SESSION['mail'];
			$response=Excecuter($bd,"SELECT DISTINCT favorites FROM EspaceClient WHERE mail='$mail'");
			while($data =$response->fetch()){
				array_push($favori,$data['favorites']);
			}
			foreach ($favori as $f){
				echo "<div style='margin:10px;'>$f</div>";
			}
		?>
			
	</body>
</html>
	


