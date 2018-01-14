<?php
session_start();

if (isset($_FILES['file'])){
	include_once 'dbh.inc.php';

	if (isset($_SESSION['mail'])){ //user has logged in
		$mail=$_SESSION['mail'];
		
			$job=$_POST['Job'];
	$institute=$_POST['Institute'];
	$tel=$_POST['Tel'];
	$birthday=$_POST['Birthday'];
	
	$sql="UPDATE Users SET job=$job,institute='$institute',tel='$tel',birthday='$birthday';";
	$bd->query($sql); 
			
		$f=$_FILES['file'];
		$fName=$f['name'];
		$fTmpName=$f['tmp_name'];
		$fError=$f['error'];
			
		$fExt=explode('.',$fName);
		$fActualExt=strtolower(end($fExt));
		
		$mailName=explode('@',$_SESSION['mail']);
		$mailName=$mailName[0];
		
		//~ $img=$_SESSION['img'];
		
		
		$sql="SELECT * FROM Users WHERE mail='$mail';";
		$result=$bd->query($sql);
		
		$allowed=array('jpg','jpeg','png','gif');
		
		while($row=$result->fetch()){
			if(in_array($fActualExt,$allowed)){
				if ($fError === 0){ //pas d'erreur
					$newFileName="profil".$mailName.".".$fActualExt;
					$fDest='../img/users_uploads/'.$newFileName;
					
					if(move_uploaded_file($fTmpName,$fDest)){
						echo '<div><img id="profil_image" src="'.$fDest.'"/></div>';
						$sql="UPDATE Users SET img='$fDest' WHERE mail='$mail';";
						$bd->query($sql);
						$_SESSION['img']=$fDest;
					}

				}else{
					echo "<script>alert(error occurred when uploading)</script>";
				}
			}else{
				echo "<script>alert(cannot upload this type of file)</script>";
			}
		}
		
	}else{ //user has not logged in
		header('location: ../page/login.php');
	}
}
?>
