<?php
session_start();
include_once 'dbh.inc.php';

if (isset($_POST['content'])){
	$txt = $_POST['content'];
	echo $txt;
	$sql="INSERT INTO txt(mail,txt) VALUES('"$_SESSION['mail']"','"$txt"');";
	$bd->query($sql);
}
	





?>

