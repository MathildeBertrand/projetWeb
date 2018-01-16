<?php
ob_start();
if (isset($_POST['submit'])){
	include_once 'dbh.inc.php';
	
	$first=$_POST['FirstName'];
	$last=$_POST['LastName'];
	$mail=$_POST['mail'];
	$job=$_POST['job'];
	$ps=$_POST['ps'];
	
	//error handlers
	if (empty($first)||empty($last)||empty($mail)||empty($job)||empty($ps)){
		header('Location: ../page/signup.php?signup=empty');
		exit(); //stop continuing
	}else{
		//check if input characters are valid
		if (!preg_match("/^[a-zA-Z]*$/",$first)||!preg_match("/^[a-zA-Z]*$/",$last)){
			header('location: ../page/signup.php?signup=invalidName');
			exit();
		}else{
			if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
				header('location: ../page/signup.php?signup=invalidMail');
				exit();
			}else{
				$hashedPs=password_hash($ps,PASSWORD_DEFAULT);
				$sql = "INSERT INTO Users(mail,nom,prenom,password,job) VALUES ('".$mail."','".$last."','".$first."','".$hashedPs."','".$job."');";
				$bd->query($sql);
				header('location: ../page/login.php');
				exit();
			}
		}
			
	}
	
}else{
	header('Location: ../page/signup.php?signup=error');
	exit();
}
ob_end_flush();
?>
