<?php

include ("jpgraph-4.1.1/src/jpgraph.php");
include ("jpgraph-4.1.1/src/jpgraph_stock.php");

require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Histogramme du nombre de noms differents pour un enzyme//////////////////////
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
		
	

	$response2=Excecuter($bd,"select avg(test) AS moyenne,std(test) AS score,MIN(test) AS min, MAX(test) AS max from ( select count(*) AS test from Names group by num_EC)AS T");
	while($data =$response2->fetch(PDO::FETCH_ASSOC)){
		$min2=$data['min'];
		$max2=$data['max'];
		$mean2=$data['moyenne'];
		$std2=$data['score'];
	}
	
	
	
	$datay = array($mean2,$std2,$min2,$max2,$mean2);
	

	$graph = new Graph(300,500);
	$graph->SetScale("textlin");
	$graph->SetMarginColor('lightblue');
	$graph->xaxis->Hide();
	$graph->xaxis->SetLabelMargin(60);
	
	$graph->SetShadow();
	$graph->yaxis->SetLabelMargin(10);
	$graph->yaxis->scale->SetGrace(15);


	$graph->ygrid->SetFill(true,'#FFFFFF','#FFFFFF'); 
	$graph->ygrid->SetLineStyle('dashed'); 

	$graph->yaxis->SetTickLabels($datay);
	
 	
	$graph->title-> SetFont(FF_FONT2, FS_BOLD);  
	$graph->title->Set('Number of synonym per enzymes');
	 
	// Create a new stock plot
	$p1 = new boxplot($datay);
	 
	// Width of the bars (in pixels)
	$p1->SetWidth(60);
	$p1->SetCenter();
	 
	// Add the plot to the graph and send it back to the browser
	$graph->Add($p1);
	$graph->Stroke();

	
	
	
	
	
?>
