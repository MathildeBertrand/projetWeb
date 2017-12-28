<?php
session_start();
require("functions.php");


///////////////////////////////////////////////////////////////////////////////
//Construction des requetes qui interrogent la bd//////////////////////////////
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
	
?>		
<?php
			$mail=$_SESSION['mail'];
			echo $mail;
			$sql="SELECT history,COUNT(history) FROM EspaceClient WHERE mail='$mail' GROUP BY history ORDER BY COUNT(history) DESC LIMIT 50;";

			$response=Excecuter($bd,"SELECT history,COUNT(history) FROM EspaceClient WHERE mail='$mail' GROUP BY history ORDER BY COUNT(history) DESC LIMIT 50;");
			while($data =$response->fetch()){
				echo $data['history'];
			}
			//~ $result=mysqli_query($conn,$sql);
			//~ $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			//~ var_dump($row);

			//~ while ($row = mysqli_fetch_assoc($result)){
				//~ $mot=$row['history'];
				//~ echo $mot;
			//~ }
			//~ echo $result;
			//~ $resultCheck=mysqli_num_rows($result);
			//~ echo $resultCheck;
			//~ if ($resultCheck > 0){ // si utilisateur avait cherche qqc
				//~ while ($row = mysqli_fetch_assoc($result)){
					//~ $mot=$row['history'];
				//~ }
			//~ }
			//~ echo $mot;?>

