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
		$sql = "INSERT INTO ClientComments(mail, comments, forwho) VALUES('".$mail."','".$msg."','".$user."');";
		$bd->query($sql);
		echo $msg;
		echo "<br>";
	}
}else{
	header("location: ./myAccount.php?user=$user");
	exit();
}
?>
