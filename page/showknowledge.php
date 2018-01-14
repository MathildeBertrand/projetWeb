<?php
session_start();
include_once '../includes/dbh.inc.php';

$newNumCom=$_POST['postnumCom'];
$mail=$_SESSION['mail'];

$sql="SELECT nom,prenom,knowledge,time FROM Users,shareKnowledge WHERE Users.mail=shareKnowledge.mail ORDER BY shareKnowledge.id DESC LIMIT $newNumCom;";
$result = $bd->prepare($sql); 
$result->execute();

$sqlCheck="SELECT nom,prenom,knowledge FROM Users,shareKnowledge WHERE Users.mail=shareKnowledge.mail ORDER BY shareKnowledge.id";
$resultCheck = $bd->prepare($sqlCheck); 
$resultCheck->execute();
$row_count =$resultCheck->rowCount();

if	($row_count > 0 and $newNumCom < $row_count){ 
	while ($row = $result->fetch(PDO::FETCH_ASSOC)){
		$name=$row['nom']." ".$row['prenom']."\t".$row['time'];
		echo "<div class='panel panel-default'>";
		echo "<div class='panel-heading'><STRONG>$name</STRONG></div>";
		echo "<div class='panel-body'>";
		echo $row['knowledge'];
		echo "</div></div>";
	}
}elseif($row_count > 0 and $newNumCom >= $row_count){
	while ($row = $result->fetch(PDO::FETCH_ASSOC)){
		$name=$row['nom']." ".$row['prenom']."\t".$row['time'];
		echo "<div class='panel panel-default'>";
		echo "<div class='panel-heading'><STRONG>$name</STRONG></div>";
		echo "<div class='panel-body'>";
		echo $row['knowledge'];
		echo "</div></div>";
	}
	echo "<p><br>no more comments</p>";
}
?>
