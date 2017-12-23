<?php

//Affiche la liste de lensemble des enzymes sous forme dun tableau

require("functions.php");
$AFF=FALSE; 

//Connection a la base : 
mysql_close;
try
	{
	$bd=new PDO('mysql:host=127.0.0.1; dbname=ProjetWeb2017','root','Pachadu92');
	
	}
	catch(Exception $e){
		echo "Connexion non reussie a Mysql";
		die('Erreur: '.$e->getMessage());
	}

//On met le fond decran :
fond();

$requete=Excecuter($bd,"SELECT Comments.num_EC,Enzyme.accepted_name,Comments.comment FROM Enzyme,Comments WHERE Enzyme.num_EC=Comments.num_EC ORDER BY Enzyme.num_EC ");

?>
		<center><table border="1" width="1000" id="ma_table">
			<tr>
				
				<td><strong>EC number</strong></td>
				<td><strong>Accepted Name</strong></td>
				<td><strong>Comments</strong></td>
				
			</tr>
		
<?php	
while($data =$requete->fetch(PDO::FETCH_ASSOC)){
	?>		
				<tr>
					 <td><?php echo $data['num_EC'];?></td>
					  <td><?php echo $data['accepted_name']; ?> </td>
					  <td><?php echo $data['comment']; ?></td>
					
				</tr>
		<?php
}


?>
