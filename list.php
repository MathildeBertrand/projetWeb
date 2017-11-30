<?php
require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Ensemble de requetes pour afficher la liste de tous les EC de la base////////
//On peut cliquer sur le nom des enzymes pour afficher leur fiche descriptive//
///////////////////////////////////////////////////////////////////////////////

//Connection a la base : 
mysql_close;
try
	{
	$bd=new PDO('mysql:host=127.0.0.1; dbname=ProjetWeb2017','root','Pachadu92');
	echo "Connexion reussie a Mysql";
	
	}
	catch(Exception $e){
		echo "Connexion non reussie a Mysql";
		die('Erreur: '.$e->getMessage());
	}
	
//Afficher la liste de tous le enzymes :

$response=Excecuter($bd,"SELECT Enzyme.num_EC FROM Enzyme");

while($data =$response->fetch(PDO::FETCH_ASSOC)){ 
	//Le num_EC est clicable est envoie sur une autre page
	?>
	
	<strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?num_EC=<?php echo $data['num_EC']; ?>"> <?php echo $data['num_EC']; ?></a></FONT><br><br>
	
	<?php 
						
}
			
?>
