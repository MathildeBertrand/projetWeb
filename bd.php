<?php
	
	require("functions.php");
	$AFF=TRUE; //Sert pour le debuggage
	try
	{
	//Connexion a Mysql
	$bd=new PDO('mysql:host=localhost; dbname=ProjetWeb2017','root','Pachadu92');
	echo "Connexion reussie a Mysql";
	
	}
	catch(Exception $e){
		//Si erreur, on affiche un message et on arrete tout
		echo "Connexion non reussie a Mysql";
		die('Erreur: '.$e->getMessage());
	}
	
	
//Creation des tables
	//Tableau de requetes
	
$requetes=array(
"Enzyme"=>"CREATE TABLE IF NOT EXISTS Enzyme
	(num_EC VARCHAR(20) NOT NULL,
	reaction TEXT,
	comments TEXT,
	cofactor TEXT ,
	disease_name VARCHAR(20),
	titre TEXT ,
	auteurs TEXT,
	first_page INT,
	last_page INT,
	volume INT,
	pubmed INT,
	medline INT,
	accepted_name VARCHAR(500),
	synonym_name VARCHAR(500),
	SP TEXT,
	PROSITE TEXT,
	PRIMARY KEY (num_EC)
	)",

);
	
	
	//Excecution des requetes
	while(list($cle,$valeur)= each ($requetes)){ //Parcours du tableau de requetes
		Excecuter($bd,$valeur); 
	}	
	
	
//Remplissage des tables
	echo "Lecture des fichiers textes";
	//Lecture des fichiers textes
	$enzyme=fopen('/home/mathilde/Bureau/gitrepertoire/projetWeb/enzymeInsertion.txt','r');
	
	while (!feof($enzyme)){
		$buffer=fgets($enzyme); //lecture de la ligne
		Excecuter2($bd,$buffer);
		
	}
	fclose($enzyme);
	
	$disease=fopen('/home/mathilde/Bureau/gitrepertoire/projetWeb/publiInsertion.txt','r');
	while (!feof($disease)){
		$buffer=fgets($disease); //lecture de la ligne
		Excecuter2($bd,$buffer);	
	}
	fclose($disease);
?>
