<?php

//Affiche la liste de lensemble des publis de la bd sous forme dun tableau

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

$requete=Excecuter($bd,"SELECT DISTINCT titre,auteurs,year,pubmed FROM Publication ORDER BY titre  ");

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
						<strong><FONT size="9">All publications of the database</strong>							
	</div>	
		<center><table border="1" width="1000" id="ma_table">
			<tr>
				
				<td width="150"style="background-color:#F0F8FF;"><strong>Title</strong></td>
				<td style="background-color:#F0F8FF;"><strong>Authors</strong></td>
				<td width="50" style="background-color:#F0F8FF;"><strong>Year</strong></td>
				<td style="background-color:#F0F8FF;"><strong>Pubmed</strong></td>
				
			</tr>
		
<?php	
while($data =$requete->fetch(PDO::FETCH_ASSOC)){
	?>		
				<tr>
					 <td><?php echo $data['titre'];?></td>
					  <td><?php echo $data['auteurs']; ?> </td>
					  <td><?php echo $data['year']; ?></td>
					
					<?php
					if($data['pubmed'] !=0){ ?> <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/?term=<?php echo $data['pubmed'];?>"> <?php echo $data['pubmed'];?> </td></a>  <?php 
					}
					if($data['pubmed'] ==0){ ?> <td> <?php echo "no link available";?> </td></a>  <?php
					} ?>
				</tr>
				
		<?php
}


?>
</div>	

