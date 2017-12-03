

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


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Espace Client </title>
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
			

		</body>
		
			
<?php

	$response=Excecuter($bd,"SELECT * FROM USERS WHERE mail='".$_GET['id']."'AND password='".$_GET['ps']."'");
	if($data =$response->fetch()){
		
		
			?><strong><FONT size="9">Welcome </strong>  <?php echo $data['nom']; echo " "; echo $data['prenom']; echo "!"; ?></FONT><br><br> <?php
			require_once("vote.html");
		}else{
				?>
				<center>
				<strong><FONT size="8">Wrong id or password !</FONT> </strong> <br>
				<strong><FONT size="8">Create a new account if you dont have one :</FONT></strong>
				<a href="fichenew.php"><FONT color="#00000"><input type="BUTTON" name="submit"  value="New Account"/></center></FONT></a>
				</div>
				</div>
				
				<?php
	}
	
?>	
