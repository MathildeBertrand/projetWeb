<?php
session_start();

header('Content-Type:application/json');
include_once '../includes/dbh.inc.php';

$q=parse_str($_SERVER["QUERY_STRING"], $query_array);
$user_id=$query_array['user'];
//~ $user_id = trim(explode("=", $_SERVER['QUERY_STRING'])[1]);
$response=$bd->query("SELECT mail FROM Users WHERE id='$user_id';");
while($row =$response->fetch(PDO::FETCH_ASSOC)){
	$name = $row['mail'];	
}
$sql="SELECT name,COUNT(name) as cpt FROM History WHERE mail='$name' GROUP BY name ORDER BY cpt DESC LIMIT 5;";
$response=$bd->query($sql);
$data = array();
while($row =$response->fetch(PDO::FETCH_ASSOC)){
	$data[] = $row;	
}
print json_encode($data);
?>
