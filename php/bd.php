<?php
	/////////////////////////////////////////////////////
	#author : Mathilde Bertrand
	#Purpose : creation et remplissage de la bd
	/////////////////////////////////////////////////////
	
	require("functions.php");
	$AFF=TRUE; //Sert pour le debuggage
	try
	{
	//Connexion a Mysql
	$bd=new PDO('mysql:host=127.0.0.1;dbname=ProjetWeb2017','root','Pachadu92');
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
	cofactor TEXT ,
	disease_name VARCHAR(20),
	accepted_name VARCHAR(500),
	o_name VARCHAR(500),
	history TEXT,
	PRIMARY KEY (num_EC)
	)",
	"Names"=>"CREATE TABLE IF NOT EXISTS Names
	(id INT AUTO_INCREMENT,
	num_EC VARCHAR(20) NOT NULL,
	synonym_name VARCHAR(500),
	PRIMARY KEY (id)
	)",
	"Comments"=>"CREATE TABLE IF NOT EXISTS Comments
	(id INT AUTO_INCREMENT,
	num_EC VARCHAR(20) NOT NULL,
	comment TEXT,
	PRIMARY KEY (id)
	)",
	"Publication"=>"CREATE TABLE IF NOT EXISTS Publication
	(id INT AUTO_INCREMENT,
	num_EC VARCHAR(20) NOT NULL,
	titre TEXT,
	auteurs TEXT,
	first_page INT,
	last_page INT,
	volume INT,
	pubmed INT,
	medline INT,
	year INT,
	PRIMARY KEY (id)
	)",
	"Family"=>"CREATE TABLE IF NOT EXISTS Family
	(id INT AUTO_INCREMENT,
	num_EC VARCHAR(20) NOT NULL,
	PROSITE TEXT,
	PRIMARY KEY (id)
	)",
	"ProtSeq"=>"CREATE TABLE IF NOT EXISTS ProtSeq
	(id INT AUTO_INCREMENT,
	num_EC VARCHAR(20) NOT NULL,
	SP_id TEXT,
	SP_name TEXT,
	organisme TEXT,
	chain VARCHAR(20),
	PRIMARY KEY (id)
	)",
	"Users"=>"CREATE TABLE IF NOT EXISTS Users
	(mail VARCHAR(100) NOT NULL,
	nom VARCHAR(100),
	prenom VARCHAR(100),
	password CHAR(128) NOT NULL, 
	job VARCHAR(100), 
	PRIMARY KEY (mail) 
	)",
	"Notes"=>"CREATE TABLE IF NOT EXISTS Notes
	(id INT AUTO_INCREMENT,
	note INT NOT NULL,
	PRIMARY KEY (id) 
	)"
);
	
	
	//Excecution des requetes
	while(list($cle,$valeur)= each ($requetes)){ //Parcours du tableau de requetes
		Excecuter($bd,$valeur); 
	}	
	
	
//Remplissage des tables
	echo "Lecture des fichiers textes";
	//Lecture des fichiers textes
	$enzyme=fopen('enzymeInsertion.txt','r');
	
	while (!feof($enzyme)){
		$buffer=fgets($enzyme); //lecture de la ligne
		Excecuter2($bd,$buffer);
		
	}
	fclose($enzyme);
	
	$disease=fopen('publiInsertion.txt','r');
	while (!feof($disease)){
		$buffer=fgets($disease); //lecture de la ligne
		Excecuter2($bd,$buffer);	
	}
	fclose($disease);
?>
