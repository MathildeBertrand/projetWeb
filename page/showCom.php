<?php
session_start();
include_once '../includes/dbh.inc.php';

$newNumCom=$_POST['postnumCom'];
$mail=$_SESSION['mail'];
$mailName=explode('.',$mail)[0];
$mailName=explode('@',$mailName)[0].explode('@',$mailName)[1];

$sql="SELECT nom,prenom,comments FROM Users,ClientComments WHERE Users.mail=ClientComments.mail AND forwho='$mailName' ORDER BY ClientComments.id DESC LIMIT $newNumCom;";
$result = $bd->prepare($sql); 
$result->execute();

$sqlCheck="SELECT nom,prenom,comments FROM Users,ClientComments WHERE Users.mail=ClientComments.mail AND forwho='$mailName' ORDER BY ClientComments.id";
$resultCheck = $bd->prepare($sqlCheck); 
$resultCheck->execute();
$row_count =$resultCheck->rowCount();

if	($row_count > 0 and $newNumCom < $row_count){ 
	while ($row = $result->fetch(PDO::FETCH_ASSOC)){
		$name=$row['nom']." ".$row['prenom'];
		echo "<p><div class='name'>$name<br></div>";
		echo $row['comments'];
		echo "</p>";
	}
}elseif($row_count > 0 and $newNumCom >= $row_count){
	while ($row = $result->fetch(PDO::FETCH_ASSOC)){
		$name=$row['nom']." ".$row['prenom'];
		echo "<p><div class='name'>$name<br></div>";
		echo $row['comments'];
		echo "</p>";
	}
	echo "<p><br>no more comments</p>";
}else{
		echo "There is no comments";
}

?>
