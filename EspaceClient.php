<?php

////////////////////////////////////////////////
//Page daffichage quand le client a fait login//
//Et calcul du nombre de personnes connectees///
////////////////////////////////////////////////
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

//On met le fond decran
fond();

	$pass_hache = password_hash($_GET['ps'], PASSWORD_DEFAULT);

	$response=Excecuter($bd,"SELECT * FROM USERS WHERE mail='".$_GET['id']."'AND password='".$_GET['ps']."'");
	
	if($data =$response->fetch()){ //Le client est dans la bd
		
			////////////////////////////////////////////////////////////////////
			///////Message d acceuil : /////////////////////////////////////////
			////////////////////////////////////////////////////////////////////
			
			?><strong><FONT size="9">Welcome </strong>  <?php echo $data['nom']; echo " "; echo $data['prenom']; echo "!"; ?></FONT><br><br> <?php
			
			////////////////////////////////////////////////////////////////////
			///////Comptage du nombre de personnes connectees : ////////////////
			////////////////////////////////////////////////////////////////////
			
			
			$page = substr($_SERVER['PHP_SELF'], 1);
			$time=time();
			$timestamp_5min = time() + (60 * 5); // 60 * 5 = nombre de secondes écoulées en 5 minutes (temps quil etait il y a 5 min)
			echo $time;
			echo " ";
			echo $timestamp_5min;
		
			$retour=Excecuter($bd,"SELECT COUNT(mail) AS nb_connectes FROM Connected WHERE mail='".$data['mail']."'"); //On regarde qui est connecte
			
			while($donnees=$retour->fetch()){
				if ($donnees['nb_connectes'] == 0) // Si il n'y est pas, on l'ajoute
				{
					Excecuter2($bd,"INSERT INTO Connected(mail, timestamp, page) VALUES('".$data['mail']."','".$time."','".$page."')");
				}else{//Sinon on remet le decompte de 5 min a 0
					
				}
			}
			
			//Excecuter2($bd, "DELETE FROM Connected WHERE timestamp > '" . $timestamp_5min."'"); //On commence par virer les entrées trop vieilles (+ de 5 minutes)
			//Calcul du nbr total dentrees puis affichage et ecriture dans le fichier de sortie
			$requete=Excecuter($bd,"SELECT COUNT(*) AS nb_connectes FROM Connected");
			$data=$requete->fetch();
			//echo 'Visiteurs connectés : <strong>' . $data['nb_connectes'] . '</strong><br/>';
			require_once("vote.html");
			
			$file=fopen('Connected.txt','r+');
			fputs($file, $data['nb_connectes']); 
			fclose($file);

		
		}else{ //Le client nest pas reconnu
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
