<?php

$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Construction des requetes qui interrogent la bd//////////////////////////////
///////////////////////////////////////////////////////////////////////////////

//Connection a la base : 
mysql_close;
$dsn = 'mysql:host=127.0.0.1; dbname=ProjetWeb2017';
$username = 'root';
//$password = 'Pachadu92';
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
