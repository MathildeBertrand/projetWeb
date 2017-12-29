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
		$mail=$_SESSION['mail'];
		$sql="SELECT * FROM Users WHERE mail!='$mail';";
		$result=$bd->query($sql);
		while ($row=$result->fetch()){
			$mailname=explode('.',$row['mail']);
			$mailname=explode('@',$mailname)[0].explode('@',$mailname)[1];
			$name=$row['nom']." ".$row['prenom'];
			echo "<div class='name'><a href=./otherAccount.php?user=$mailname>$name</a></div>";
		}
		
		?>
	</body>
</html>
