<?php
session_start();
include_once '../includes/dbh.inc.php';

if (isset($_POST['done'])){
	$msg=$_POST['inputcomment'];
	$user=$_POST['user'];
	$mail=$_SESSION['mail'];

	if (!trim($msg) == ''){
		$sqlSelect = "SELECT prenom, nom FROM Users WHERE mail='$mail';";
		$result=$bd->query($sqlSelect);
		while($row=$result->fetch()){
			$name=$row['nom']." ".$row['prenom'];
			echo "<div class='name'>$name<br></div>";
		}
		$sqlSelect = "SELECT mail FROM Users WHERE id='$user';";
		$result=$bd->query($sqlSelect);
		while($row=$result->fetch()){
			$forwho=$row['mail'];
		}
		$sql = "INSERT INTO ClientComments(mail, comments, forwho) VALUES('".$mail."','".$msg."','".$forwho."');";
		$result = $bd->prepare($sql); 
		$result->execute();
		echo $msg;
		echo "<br>";
	}
}else{
	header("location: ./myAccount.php?user=$user");
	exit();
}
?>
