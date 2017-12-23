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

$requete=Excecuter($bd,"SELECT Comments.num_EC,Enzyme.accepted_name,group_concat(distinct Comments.comment) AS commenta FROM Enzyme,Comments WHERE Enzyme.num_EC=Comments.num_EC GROUP BY Comments.num_EC  ");

?>
<div class="contenu">
	<div class="jumbotron_enzyme">
						<strong><FONT size="9">All enzymes of the database</strong>							
	</div>	
		<center><table border="1" width="1000" id="ma_table">
			<tr>
				
				<td width="150"><strong>EC number</strong></td>
				<td><strong>Accepted Name</strong></td>
				<td><strong>Comments</strong></td>
				
			</tr>
		
<?php	
while($data =$requete->fetch(PDO::FETCH_ASSOC)){
	?>		
				<tr>
					 <td><a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"><?php echo $data['num_EC'];?></a></td>
					  <td><?php echo $data['accepted_name']; ?> </td>
					  <td><?php echo $data['commenta']; ?></td>
					
				</tr>
				
		<?php
}


?>
</div>	
