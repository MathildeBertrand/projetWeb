<?php

//Ensemble de fonctions qui permettent de gerer la creation des tables dans la base de donnees

	//Pour savoir si une table existe
function mysql_table_exist($tableName){
	$query="SELECT COUNT(*) FROM $tableName";
	$result=mysql_query($query);
	$num_rows=@mysql_num_rows($result);
	
	if($num_rows){
		echo "<small>La table existait deja <br/>";
		return TRUE;
	}else{
		echo "<small>La table nexistait pas <br/>";
		return FALSE;
	}
}

	//Supprime une table avec message approprie
function drop_table($tableName){
	echo "Efface table ".$tableName. "<br/>";
	$result=mysql_query("DROP TABLE $tableName");
	if($result==1){
		echo "Table effacee <br/>";
	}else{
		echo "Erreur en effacant la table <br/>";
	}
}

	//Excecuter une requete
function Excecuter($bdd,$requete){
	global $AFF;
	if($AFF) echo "<hr><b>Requete: </b>$requete<hr>";
	
	if($res=$bdd->query($requete)){ //Si la requete est bien une requete sql
		
		if($AFF) echo "<hr>Requete reussie <br>$requete<hr>";
		return $res; //On renvoie la query sql a la base de donnees
	}else{ //Sinon
		
		if($AFF){
			 echo "<hr>Erreur <br>$requete<hr>";
		 }
		 return FALSE;
	}
}

function Excecuter2($bdd,$requete){ //Pour une requete INSERT,DELETE ou UPDATE
	global $AFF;
	if($AFF) echo "<hr><b>Requete: </b>$requete<hr>";
	
	
	if($res=$bdd->exec($requete)){ 
		
		if($AFF) echo "<hr>Requete reussie <br>$requete<hr>";
		
		return $res;
	
	}else{ 
		
		if($AFF){
			 echo "<hr>Erreur <br>$requete<hr>";
			 echo "error code:",$bdd->errorInfo();
		 }
		 return FALSE;
	}
}

?>
