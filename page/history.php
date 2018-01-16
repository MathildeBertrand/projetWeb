<?php
session_start();
require("functions.php");


//Connection a la base : 
include_once '../includes/dbh.inc.php';
$AFF=FALSE; 
include ('../includes/header.inc.php');
?>

	<div class="col-sm-1 col-md-1 col-lg-2 col-lg-offset-1">
		<div class="panel panel-primary" style="height:550px;">
		  <div class="panel-heading"><FONT size="3"><strong><center>EC</center></strong></FONT></div>
		  <div class="panel-body">
			<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						
						$response=Excecuter($bd,"SELECT num_EC,COUNT(num_EC) AS Comptage FROM History WHERE mail='".$mail."' and type='EC' GROUP BY num_EC ORDER BY COUNT(num_EC) DESC LIMIT 50");
					//	$sql="SELECT DISTINCT Name,COUNT(Name) FROM History WHERE mail='".$mail."' and type='EC' GROUP BY Name ORDER BY COUNT(Name) DESC LIMIT 50; ";
					//	$response=$bd->query($sql);
						
						while($data =$response->fetch()){
							array_push($mots,$data['Name']);
							echo $data['num_EC'];
							echo " : ";
							echo $data['Comptage'];
							echo " views";
							?> <br><?php
						}
						foreach ($mots as $mot){
							$submot=substr($mot,3,-1);
							//echo"<a href='./fiche1.php?val=$submot&type=EC'><strong>$mot</strong></a><br>";
						}
				?>	
		  </div>
		</div>
	</div>

	<div class="col-sm-1 col-md-1 col-lg-2">
		<div class="panel panel-primary" style="height:550px;">
		  <div class="panel-heading"><FONT size="3"><strong><center>Cofactor</center></strong></FONT></div>
		  <div class="panel-body">
			<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT DISTINCT cofactor,COUNT(cofactor) AS Comptage FROM History WHERE mail='".$mail."' and type='Cofactor' GROUP BY cofactor ORDER BY COUNT(cofactor) DESC LIMIT 50");
						//$response=$bd->query($sql);
						while($data =$response->fetch()){
							array_push($mots,$data['name']);
							echo $data['cofactor'];
							echo " : ";
							echo $data['Comptage'];
							?> <br> <?php
						}
						foreach ($mots as $mot){
							//echo "<a href='/fiche1.php?val=$mot&type=Cofactor'><strong>$mot</strong></a><br>";
						}
				?>	
		  </div>
		</div>
	</div>
        
	<div class="col-sm-1 col-md-1 col-lg-2">
		<div class="panel panel-primary" style="height:550px;">
		  <div class="panel-heading"><FONT size="3"><strong><center>Protein family</center></strong></FONT></div>
		  <div class="panel-body">
			<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT DISTINCT family,COUNT(family) AS Comptage FROM History WHERE mail='".$mail."' and type='Protein family' GROUP BY family ORDER BY COUNT(family) DESC LIMIT 50");
						while($data =$response->fetch()){
							array_push($mots,$data['name']);
							echo $data['family'];
							echo " : ";
							echo $data['Comptage'];
							?> <br> <?php
						}
						foreach ($mots as $mot){
						//	echo "<a href='/fiche1.php?val=$mot&type=Protein family'><strong>$mot</strong></a><br>";
						}
				?>	
		  </div>
		</div>
	</div>
			
	<div class="col-sm-1 col-md-1 col-lg-2">
		<div class="panel panel-primary" style="height:550px;">
		  <div class="panel-heading"><FONT size="3"><strong><center>Name</center></strong></FONT></div>
		  <div class="panel-body">
			<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT DISTINCT Name,COUNT(Name) AS Comptage FROM History WHERE mail='".$mail."' and type='Names' GROUP BY Name ORDER BY COUNT(Name) DESC LIMIT 50");
						while($data =$response->fetch()){
							array_push($mots,$data['name']);
							echo $data['Name'];
							echo " : ";
							echo $data['Comptage'];
							?> <br> <?php
						}
						foreach ($mots as $mot){
							//echo "<a href='/fiche1.php?val=$mot&type=Name'><strong>$mot</strong></a><br>";
						}
				?>	
		  </div>
		</div>
	</div>
			
	<div class="col-sm-1 col-md-1 col-lg-2">
		<div class="panel panel-primary" style="height:550px;">
		  <div class="panel-heading"><FONT size="3"><strong><center>Prosite </center></strong></FONT></div>
		  <div class="panel-body">
			<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT ProtSeq,COUNT(ProtSeq)  AS Comptage FROM History WHERE mail='".$mail."' and type='Protein sequence' GROUP BY ProtSeq ORDER BY COUNT(ProtSeq) DESC LIMIT 50");
						while($data =$response->fetch()){
							array_push($mots,$data['name']);
							echo $data['ProtSeq'];
							echo " : ";
							echo $data['Comptage'];
							?> <br> <?php
						}
						foreach ($mots as $mot){
							//echo "<a href='/fiche1.php?val=$mot&type=Name'><strong>$mot</strong></a><br>";
						}
				?>	
		  </div>
		</div>
	</div>		
			
	</body>
</html>
	

