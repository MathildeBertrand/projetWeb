<?php


require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Les 10 organismes qui ont le plus dentrees denzymes dans la bd//////////////
///////////////////////////////////////////////////////////////////////////////

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
		
	//Excecute the query
	$response=Excecuter($bd,"SELECT organisme AS playerid,COUNT(num_EC) AS score  FROM ProtSeq GROUP BY organisme ORDER BY score DESC LIMIT 10");
	
	//loop through the returned data
	$data = array();
	while($row =$response->fetch(PDO::FETCH_ASSOC)){
		$data[] = $row;
		
	}
	
	//now print the data
	print json_encode($data);
	
	
	
	
	
?>


