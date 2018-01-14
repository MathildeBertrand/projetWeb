<?php
session_start();
include_once '../includes/dbh.inc.php';

if (isset($_POST['done'])){
	$msg=$_POST['inputcomment'];
	$user=$_POST['user'];
	$mail=$_SESSION['mail'];

	if (!trim($msg) == ''){
		
		$sql = "INSERT INTO shareKnowledge(mail, knowledge) VALUES('".$mail."','".$msg."');";
		$result = $bd->prepare($sql); 
		$result->execute();
		
		$sqlSelect = "SELECT prenom, nom, knowledge, time FROM Users,shareKnowledge WHERE Users.mail=shareKnowledge.mail ORDER BY shareKnowledge.id DESC LIMIT 1;";
		$result=$bd->query($sqlSelect);
		while($row=$result->fetch()){			
			$name=$row['nom']." ".$row['prenom']."\t".$row['time'];
			echo "<div class='panel panel-default'>";
			echo "<div class='panel-heading'><STRONG>$name</STRONG></div>";
			echo "<div class='panel-body'>";
			echo $row['knowledge'];
			echo "</div></div>";
		}


		//~ echo $msg;
		//~ echo "<br>";
	}
}else{
	header("location: ./myAccount.php?user=$user");
	exit();
}
?>
