<?php
session_start();

if (isset($_SESSION['mail'])){
	include_once 'dbh.inc.php';

	$job=$_POST['job'];
	$institute=$_POST['institute'];
	$tel=$_POST['tel'];
	$birthday=$_POST['birthday'];
	$description=$_POST['description'];
	$mail=$_SESSION['mail'];
	
	if ($institute!=NULL){
		$sql="UPDATE Users SET institute='$institute' WHERE mail='$mail';";
		$bd->query($sql); 
		$_SESSION['institute']=$institute;
	}
	if ($tel!=NULL){
		$sql="UPDATE Users SET tel='$tel' WHERE mail='$mail';";
		$bd->query($sql);
		$_SESSION['tel']=$tel;
	}
	if($birthday!=NULL){
		$sql="UPDATE Users SET birthday='$birthday' WHERE mail='$mail';";
		$bd->query($sql);
		$_SESSION['birthday']=$birthday;
	}
	if($job!=NULL){
		$sql="UPDATE Users SET job='$job' WHERE mail='$mail';";
		$bd->query($sql);
		$_SESSION['job']=$job;
	}
	if($description!=NULL){
		$sql="UPDATE Users SET description='$description' WHERE mail='$mail';";
		$bd->query($sql);
		$_SESSION['description']=$description;
	}
	
	$sql="SELECT id FROM Users WHERE mail='$mail';";
	$result=$bd->query($sql);
	while($row=$result->fetch()){
		echo $row['id'];
	}
	
}
?>
