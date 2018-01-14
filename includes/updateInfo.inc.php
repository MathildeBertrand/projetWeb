<?php
session_start();

if (isset($_SESSION['mail'])){
	include_once 'dbh.inc.php';

	$job=$_POST['job'];
	$institute=$_POST['institute'];
	$tel=$_POST['tel'];
	$birthday=$_POST['birthday'];
	$mail=$_SESSION['mail'];
	
	if (isset($institute)){
		$sql="UPDATE Users SET institute='$institute' WHERE mail='$mail';";
		$bd->query($sql); 
	}
	if (isset($tel)){
		$sql="UPDATE Users SET tel='$tel' WHERE mail='$mail';";
		$bd->query($sql);
	}
	if(isset($birthday)){
		$sql="UPDATE Users SET birthday='$birthday' WHERE mail='$mail';";
		$bd->query($sql);
	}
	if(isset($job)){
		$sql="UPDATE Users SET job='$job' WHERE mail='$mail';";
		$bd->query($sql);
	}
	
	$sql="SELECT id FROM Users WHERE mail='$mail';";
	$result=$bd->query($sql);
	while($row=$result->fetch()){
		echo $row['id'];
	}
	
}
?>
