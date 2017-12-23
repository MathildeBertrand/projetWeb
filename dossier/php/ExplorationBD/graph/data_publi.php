

<?php


require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Histogramme du nombre de publications par enzyme/////////////////////////////
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
		
	//Excecute the query
	$response=Excecuter($bd,"SELECT num_EC AS playerid,COUNT(num_EC) AS score  FROM Publication GROUP BY num_EC");
	
	//loop through the returned data
	$data = array();
	while($row =$response->fetch(PDO::FETCH_ASSOC)){
		$data[] = $row;
		
	}
	
	//now print the data
	print json_encode($data);
	
	
	
	
	
?>
