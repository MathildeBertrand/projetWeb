
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
	reaction TEXT NOT NULL,
	comments TEXT NOT NULL,
	cofactor VARCHAR(100) ,
	PRIMARY KEY (num_EC)
	)",
	"Disease"=>"CREATE TABLE IF NOT EXISTS Disease
	(id INT AUTO_INCREMENT NOT NULL,
	disease_name VARCHAR(20) NOT NULL ,
	PRIMARY KEY (id)
	)",
	"Publication"=>"CREATE TABLE IF NOT EXISTS Publication
	(id INT AUTO_INCREMENT NOT NULL,
	titre TEXT NOT NULL,
	auteurs TEXT NOT NULL,
	first_page INT NOT NULL,
	last_page INT NOT NULL,
	volume INT NOT NULL,
	pubmed INT NOT NULL,
	medline INT NOT NULL,
	num_EC VARCHAR(20) NOT NULL,
	PRIMARY KEY (id)
	)",
	"Names"=>"CREATE TABLE IF NOT EXISTS Names
	(accepted_name VARCHAR(500) NOT NULL,
	synonym_name VARCHAR(500) NOT NULL,
	o_name VARCHAR(500) NOT NULL,
	PRIMARY KEY (o_name)
	)",
	"ProteinFamilie"=>"CREATE TABLE IF NOT EXISTS ProteinFamilie
	(id INT AUTO_INCREMENT NOT NULL,
	SP TEXT NOT NULL,
	PROSITE TEXT NOT NULL,
	PRIMARY KEY (id)
	)",
	"ImpliqueDisease"=>"CREATE TABLE IF NOT EXISTS ImpliqueDisease
	(id INT AUTO_INCREMENT NOT NULL,
	num_EC VARCHAR(20) NOT NULL,
	PRIMARY KEY (id,num_EC),
	FOREIGN KEY (id) REFERENCES Disease(id),
	FOREIGN KEY (num_EC) REFERENCES Enzyme(num_EC)
	)",
	"Ecrire"=>"CREATE TABLE IF NOT EXISTS Ecrire
	(num_EC VARCHAR(20) NOT NULL,
	id INT AUTO_INCREMENT NOT NULL,
	PRIMARY KEY (num_EC,id),
	FOREIGN KEY (num_EC) REFERENCES Enzyme(num_EC),
	FOREIGN KEY (id) REFERENCES Publication(id)
	)",
	"Appartient"=>"CREATE TABLE IF NOT EXISTS Appartient
	(num_EC VARCHAR(20) NOT NULL,
	id INT AUTO_INCREMENT NOT NULL,
	PRIMARY KEY (num_EC,id),
	FOREIGN KEY (num_EC) REFERENCES Enzyme(num_EC),
	FOREIGN KEY (id) REFERENCES ProteinFamilie(id)
	)",
	"PossedeNom"=>"CREATE TABLE IF NOT EXISTS PossedeNom
	(num_EC VARCHAR(20) NOT NULL,
	o_name VARCHAR(500) NOT NULL,
	PRIMARY KEY (num_EC,o_name),
	FOREIGN KEY (num_EC) REFERENCES Enzyme(num_EC),
	FOREIGN KEY (o_name) REFERENCES Names(o_name)
	)"
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
