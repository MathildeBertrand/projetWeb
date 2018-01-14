<?php

include ("jpgraph-4.1.1/src/jpgraph.php");
include ("jpgraph-4.1.1/src/jpgraph_stock.php");

require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Histogramme du nombre de publications par enzyme/////////////////////////////
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
		

	#$response=Excecuter($bd,"SELECT num_EC AS playerid,COUNT(titre) AS score  FROM Publication GROUP BY num_EC");
	$response=Excecuter($bd,"select avg(test) AS moyenne,std(test) AS score,MIN(test) AS min, MAX(test) AS max from ( select count(*) AS test from Publication group by num_EC)AS T");
	
	
	while($data =$response->fetch(PDO::FETCH_ASSOC)){
		$min=$data['min'];
		$max=$data['max'];
		$mean=$data['moyenne'];
		$std=$data['score'];
	}
	

	$datay = array($mean,$std,$min,$max,$mean);	

	$graph = new Graph(300,500);
	$graph->SetScale("textlin");
	
	$graph->xaxis->Hide();
	$graph->yaxis->scale->SetGrace(10);
	$graph->ygrid->SetFill(true,'#FFFFFF','#FFFFFF'); 
	$graph->ygrid->SetLineStyle('dashed'); 
	
	$graph->title-> SetFont( FF_FONT2, FS_BOLD);  
	$graph->title->Set('Number of publications per enzyme');
	 
	// Create a new stock plot
	$p1 = new boxplot($datay);
	$p1->SetWidth(60);
	$p1->SetCenter();
	$graph->Add($p1);
	$graph->Stroke();
	
	
	
	
	
?>
