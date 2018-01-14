<?php
session_start();

if (isset($_POST['submit'])){
	include_once 'dbh.inc.php';

	if (isset($_SESSION['mail'])){ //user has logged in
		$f=$_FILES['file'];
		$fName=$f['name'];
		$fTmpName=$f['tmp_name'];
		$fError=$f['error'];
			
		$fExt=explode('.',$fName);
		$fActualExt=strtolower(end($fExt));
		
		$mailName=explode('@',$_SESSION['mail']);
		$mailName=$mailName[0];
		
		$img=$_SESSION['img'];
		
		$mail=$_SESSION['mail'];
		$sql="SELECT * FROM Users WHERE mail='$mail';";
		$result=mysqli_query($conn, $sql);
	
		while($row=mysqli_fetch_assoc($result)){
			if(in_array($fActualExt,$allowed)){
				if ($fError === 0){ //pas d'erreur
					$newFileName="profil".$mailName.".".$fActualExt;
					$fDest='http://localhost/projetWeb/img/users_uploads/'.$newFileName;
					//~ echo $fDest;
					//~ echo "\n".$fTmpName;
					move_uploaded_file($fTmpName,$fDest);
					$sql="UPDATE Users SET img='$img' WHERE mail='$mail';";
					mysqli_query($conn,$sql);
					header('location: ../page/editProfil.php');
				}else{
					echo "error occurred when uploading";
				}
			}else{
				echo "cannot upload this type of file";
			}
		}
		
	}else{ //user has not logged in
		header('location: ../page/login.php');
	}
}
?>

