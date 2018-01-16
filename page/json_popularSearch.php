<?php
session_start();
header('Content-Type:application/json');
include_once '../includes/dbh.inc.php';

$sql="SELECT name,COUNT(name) as cpt from History GROUP BY name ORDER BY cpt DESC LIMIT 5;";
$response=$bd->query($sql);
$data = array();
while($row =$response->fetch(PDO::FETCH_ASSOC)){
	$data[] = $row;	
}
print json_encode($data);
?>
