<?php
session_start();
require("functions.php");


//Connection a la base : 
include_once '../includes/dbh.inc.php';
include ('../includes/header.inc.php');
?>

	<div class="col-sm-1 col-md-1 col-lg-2 col-lg-offset-1">
		<div class="panel panel-primary" style="height:550px;">
		  <div class="panel-heading"><FONT size="3"><strong><center>EC</center></strong></FONT></div>
		  <div class="panel-body">
			<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$sql="SELECT DISTINCT name,COUNT(name) FROM History WHERE mail='$mail' and type='EC' GROUP BY name ORDER BY COUNT(name) DESC LIMIT 50; ";
						$response=$bd->query($sql);
						
						while($data =$response->fetch()){
							array_push($mots,$data['name']);
						}
						foreach ($mots as $mot){
							$submot=substr($mot,3,-1);
							echo"<a href='./fiche1.php?val=$submot&type=EC'><strong>$mot</strong></a><br>";
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
						$sql="SELECT DISTINCT name,COUNT(name) FROM History WHERE mail='$mail' and type='Cofactor' GROUP BY name ORDER BY COUNT(name) DESC LIMIT 50;";
						$response=$bd->query($sql);
						while($data =$response->fetch()){
							array_push($mots,$data['name']);
						}
						foreach ($mots as $mot){
							echo "<a href='/fiche1.php?val=$mot&type=Cofactor'><strong>$mot</strong></a><br>";
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
						$response=Excecuter($bd,"SELECT DISTINCT name,COUNT(name) FROM History WHERE mail='$mail' and type='Protein family' GROUP BY name ORDER BY COUNT(name) DESC LIMIT 50;");
						while($data =$response->fetch()){
							array_push($mots,$data['name']);
						}
						foreach ($mots as $mot){
							echo "<a href='/fiche1.php?val=$mot&type=Protein family'><strong>$mot</strong></a><br>";
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
						$response=Excecuter($bd,"SELECT DISTINCT name,COUNT(name) FROM History WHERE mail='$mail' and type='Name' GROUP BY name ORDER BY COUNT(name) DESC LIMIT 50;");
						while($data =$response->fetch()){
							array_push($mots,$data['name']);
						}
						foreach ($mots as $mot){
							echo "<a href='/fiche1.php?val=$mot&type=Name'><strong>$mot</strong></a><br>";
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
						$response=Excecuter($bd,"SELECT DISTINCT name,COUNT(name) FROM History WHERE mail='$mail' and type='Name' GROUP BY name ORDER BY COUNT(name) DESC LIMIT 50;");
						while($data =$response->fetch()){
							array_push($mots,$data['name']);
						}
						foreach ($mots as $mot){
							echo "<a href='/fiche1.php?val=$mot&type=Name'><strong>$mot</strong></a><br>";
						}
				?>	
		  </div>
		</div>
	</div>		
			
	</body>
</html>
	

