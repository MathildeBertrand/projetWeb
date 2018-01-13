<?php

include ("jpgraph-4.1.1/src/jpgraph.php");
include ("jpgraph-4.1.1/src/jpgraph_stock.php");

require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Histogramme du nombre denzymes par organismes////////////////////////////////
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
		
	//Excecute the query
	//$response=Excecuter($bd,"SELECT organisme AS playerid,COUNT(num_EC) AS score  FROM ProtSeq GROUP BY organisme");
	$response=Excecuter($bd,"select avg(test) AS moyenne,std(test) AS score,MIN(test) AS min, MAX(test) AS max from (select count(*) AS test from ProtSeq group by organisme)AS T");
	

	
	while($data =$response->fetch(PDO::FETCH_ASSOC)){
		$min=$data['min'];
		$max=$data['max'];
		$mean=$data['moyenne'];
		$std=$data['score'];
	}
	
	$datay = array($mean,$std,$min,$max,$mean);
	

	$graph = new Graph(300,500);

	$graph->SetScale("textlin");
	$graph->yaxis->scale->SetAutoMin(-1);

	$graph->SetMarginColor('lightblue');
	$graph->xaxis->Hide();

	$graph->xaxis->SetLabelMargin(10);

	//$graph->yaxis->SetTickLabels($datay);
	$graph->yaxis->scale->SetGrace(15);
	$graph->ygrid->SetFill(true,'#FFFFFF','#FFFFFF'); 
	$graph->ygrid->SetLineStyle('dashed'); 

	$graph->title-> SetFont( FF_FONT2, FS_BOLD);  
	$graph->title->Set('Number of enzymes per organism');
	 
	
	$p1 = new boxplot($datay);
	$p1->SetWidth(60);
	$p1->SetCenter();
	$graph->Add($p1);
	$graph->Stroke();
	
	
	
?>

