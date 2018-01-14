<?php
session_start();
require("functions.php");


//Connection a la base : 
include_once '../includes/dbh.inc.php';
include ('../includes/header.inc.php');
?>


		
				<nav class="col-sm-1 col-md-2 col-lg-3" id="myScrollspy">
					<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">
						<li><a href="#EC"><h2>EC</h2></a></li>
						<li><a href="#Cofactor"><h2>Cofactor</h2></a></li>
						<li><a href="#Disease"><h2>Disease</h2></a></li>
						<li><a href="#ProtF"><h2>Protein Family</h2></a></li>
						<li><a href="#Name"><h2>Name</h2></a></li>
						<li><a href="#ProtSeq"><h2>Protein Sequence</h2></a></li>
					</ul>
				</nav>





        
		<div class="col-sm-2 col-md-6 col-lg-8">
			<div id="EC">
				<h1>EC</h1>				
					<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT num_EC,COUNT(num_EC) FROM History WHERE mail='$mail' GROUP BY num_EC ORDER BY COUNT(num_EC) DESC LIMIT 50;");
						while($data =$response->fetch()){
							if (!in_array($data['num_EC'],$mots)){
								array_push($mots,$data['num_EC']);
							}
						}
						foreach ($mots as $mot){
							$submot=substr($mot,3,-1);
							echo "<div style='margin:10px;'><a href='./fiche1.php?val=$submot&type=EC'>$mot</a></div>";
						}
					?>	
			</div>
		
			<div id="Cofactor">
				<h1>Cofactor</h1>				
					<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT cofactor,COUNT(cofactor) FROM History WHERE mail='$mail' GROUP BY cofactor ORDER BY COUNT(cofactor) DESC LIMIT 50;");
						while($data =$response->fetch()){
							if (!in_array($data['cofactor'],$mots)){
								array_push($mots,$data['cofactor']);
							}
						}
						foreach ($mots as $mot){
							echo "<div style='margin:10px;'><a href='/fiche1.php?val=$mot&type=Disease'>$mot</a></div>";
						}
					?>	
			</div>
			
			<div id="Disease">
				<h1>Disease</h1>				
					<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT disease_name,COUNT(disease_name) FROM History WHERE mail='$mail' GROUP BY disease_name ORDER BY COUNT(disease_name) DESC LIMIT 50;");
						while($data =$response->fetch()){
							if (!in_array($data['disease_name'],$mots)){
								array_push($mots,$data['disease_name']);
							}
						}
						foreach ($mots as $mot){
							echo "<div style='margin:10px;'><a href='/fiche1.php?val=$mot&type=Disease'>$mot</a></div>";
						}
					?>	
			</div>
			
			<div id="ProtF">
				<h1>Protein Family</h1>				
					<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT family,COUNT(family) FROM History WHERE mail='$mail' GROUP BY family ORDER BY COUNT(family) DESC LIMIT 50;");
						while($data =$response->fetch()){
							if (!in_array($data['family'],$mots)){
								array_push($mots,$data['family']);
							}
						}
						foreach ($mots as $mot){
							echo "<div style='margin:10px;'><a href='/fiche1.php?val=$mot&type=Protein family'>$mot</a></div>";
						}
					?>	
			</div>
			
			<div id="Name">
				<h1>Name</h1>				
					<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT Name,COUNT(Name) FROM History WHERE mail='$mail' GROUP BY Name ORDER BY COUNT(Name) DESC LIMIT 50;");
						while($data =$response->fetch()){
							if (!in_array($data['Name'],$mots)){
								array_push($mots,$data['Name']);
							}
						}
						foreach ($mots as $mot){
							echo "<div style='margin:10px;'><a href='/fiche1.php?val=$mot&type=Name'>$mot</a></div>";
						}
					?>	
			</div>
			
			<div id="ProtSeq">
				<h1>Protein Sequence</h1>				
					<?php
						$mots=array();
						$mail=$_SESSION['mail'];
						$response=Excecuter($bd,"SELECT ProtSeq,COUNT(ProtSeq) FROM History WHERE mail='$mail' GROUP BY ProtSeq ORDER BY COUNT(ProtSeq) DESC LIMIT 50;");
						while($data =$response->fetch()){
							array_push($mots,$data['ProtSeq']);
						}
						foreach ($mots as $mot){
							echo "<div style='margin:10px;'><a href='/fiche1.php?val=$mot&type=Protein sequence'>$mot</a></div>";
						}
					?>	
			</div>
			
		</div>
			
	</body>
</html>
	

