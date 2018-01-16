<?php
ob_start();
session_start();
require("../page/functions.php");

if (isset($_POST['submit'])){
	include_once 'dbh.inc.php';
	
	$username=$_POST['username'];
	$ps=$_POST['password'];
	$email=$_POST['username'];
	
	//Error handlers
	if (empty($_POST['username'])||empty($_POST['password'])){
		header('location: ../page/login.php?login=empty');
		exit();
	}else{
		$sql="SELECT * FROM Users WHERE prenom='$username' OR mail='$email';";
		$result = $bd->prepare($sql); 
		$result->execute();
		$row_count =$result->rowCount();
		if	($row_count < 1){ // if this user doesn't exist
			header('location: ../page/login.php?login=noUser');
			exit();
		}else{
			echo "here";
			while ($row = $result->fetch(PDO::FETCH_ASSOC)){//transform result of bd into array in php
				$hashedPscheck = password_verify($ps,$row['password']);
				var_dump($row);
				if($hashedPscheck == false){
					header('location: ../index.php');
					exit();
				}elseif($hashedPscheck == true){
					//log in the user here
					$_SESSION['mail']=$row['mail'];
					$_SESSION['nom']=$row['nom'];
					$_SESSION['prenom']=$row['prenom'];
					$_SESSION['password']=$row['password'];
					$_SESSION['job']=$row['job'];
					$_SESSION['img']=$row['img'];
					$id=$row['id'];
					header("location: ../page/myAccount.php?user=$id");
					exit();
				}
			}
		}
	}
}else{
	header('location: ../page/login.php?login=error');
	exit();
}
ob_end_flush();
?>
