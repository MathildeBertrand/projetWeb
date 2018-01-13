<!-- connection BD -->

<?php
//~ $server="localhost";
//~ $user="root";
//~ $password="mysql2017";
//~ $dbname="ProjetWeb2017";

//~ $conn=mysqli_connect($server,$user,$password,$dbname);

//~ if (mysqli_connect_errno()) {
    //~ printf("Échec de la connexion : %s\n", mysqli_connect_error());
    //~ exit();
//~ }

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
