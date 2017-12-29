<?php

//Affiche la liste de lensemble des enzymes sous forme dun tableau

require("functions.php");
$AFF=FALSE; 

//Connection a la base : 
mysql_close;
$dsn = 'mysql:host=127.0.0.1; dbname=ProjetWeb2017';
$username = 'root';
//$password = 'Pachadu92'
$password = 'mysql2017';
	
try
	{
	$bd=new PDO($dsn, $username, $password);
	
	}
	catch(Exception $e){
		echo "Connexion non reussie a Mysql";
		die('Erreur: '.$e->getMessage());
	}

//On met le fond decran :
fond();

$requete=Excecuter($bd,"SELECT Comments.num_EC,Enzyme.accepted_name,group_concat(distinct Comments.comment) AS commenta FROM Enzyme,Comments WHERE Enzyme.num_EC=Comments.num_EC GROUP BY Comments.num_EC  ");

?>
<link rel="stylesheet" href="UI/css/MyStylesheet.css" />
			<div class="menu">
				<u><strong><FONT size="6">Links</FONT></u></strong><br> <br>
					<center>
						<a href=https://www.ncbi.nlm.nih.gov/pubmed><img src="../img/pubmed.png"  width="100"/></a><br><br>
						<a href=http://prosite.expasy.org/><img src="../img/prosite.gif" width="100"/></a><br><br>
						<a href=http://www.uniprot.org><img src="../img/sp.png"  width="100"/></a><br><br>
						<a href=http://www.kegg.jp/><img src="../img/kegg.jpg"  width="100"/></a><br><br>
					</center>
			</div>
</nav>
<div class="contenu">
	<div class="jumbotron_enzyme">
						<strong><FONT size="9">All enzymes of the database</strong>							
	</div>	
		<center><table border="1" width="1000" id="ma_table">
			<tr>
				
				<td width="150" style="background-color:#F0F8FF;"><strong>EC number</strong></td>
				<td style="background-color:#F0F8FF;"><strong>Accepted Name</strong></td>
				<td style="background-color:#F0F8FF;"><strong>Comments</strong></td>
				
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
