<?php
session_start();
include_once '../includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> My Account </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
	</head>

	<body>
		
		<?php 
		include ('../includes/header.inc.php');
		$mail=$_SESSION['mail'];
		
		$sql="SELECT * FROM Users WHERE mail!='$mail';";
		$result=$bd->query($sql);
		
		while ($row=$result->fetch()){
			$id=$row['id'];
			$name=$row['nom']." ".$row['prenom'];
			$description=$row['description'];
			echo "<div class='panel panel-primary' style='margin-left: 20px; margin-top: 10px; height:100px; width:300px'>
					  <div class='panel-heading'>
						<h3 class='panel-title'><a href=./otherAccount.php?user=$id>$name</a></h3>
					  </div>
					  <div class='panel-body'>$description</div>
					</div>";
		}	
		?>

	</body>
</html>
