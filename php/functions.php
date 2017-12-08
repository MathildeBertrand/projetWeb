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



// Sources www.stackoverflow.com
//Crypter un mot de passe pour securiser le site
function encrypt($pure_string, $encryption_key) {

    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
    return $encrypted_string;

}

//decrypter le mot de passe
function decrypt($encrypted_string, $encryption_key) {

    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
    return $decrypted_string;

}

//Fonction qui definit un fond decran neutre
function fond (){
	?>
	<html>
	<head>
		<meta charset="utf-8">
		<title> Home page </title>
		<link rel="stylesheet" href="UI/css/bootstrap.min.css" />
		<link rel="stylesheet" href="UI/css/MyStylesheet.css" />
	</head>
	
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
						<ul class="nav navbar-nav navbar-right">
							<img src="UI/img/user1.png"  width="35"/>
							<li><a href="login.php"> log in </a><li>
						</ul>
					</div>
			
			</div>
		
	</body>	
	</html>
	<?php
}
