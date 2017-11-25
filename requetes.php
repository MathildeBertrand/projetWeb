<?php
require("functions.php");
$AFF=FALSE; 

////////////////////////////////////////////////////////
//Ensemble de requetes pour interroger la base de donnees
////////////////////////////////////////////////////////
mysql_close;
try
	{
	$bd=new PDO('mysql:host=localhost; dbname=ProjetWeb2017','root','Pachadu92');
	echo "Connexion reussie a Mysql";
	
	}
	catch(Exception $e){
		echo "Connexion non reussie a Mysql";
		die('Erreur: '.$e->getMessage());
	}
	

//Recuperer les informations sur lenzyme a partir du numEC

	$response=Excecuter($bd,"SELECT * FROM Enzyme WHERE Enzyme.num_EC='EC 1.1.1.1'");
	
	?>	
	
	<?php
	while($data =$response->fetch(PDO::FETCH_ASSOC)) //Tant quil y a un enregistrement, les instructions sexectutent dans la boucle pour mise en forme
	{
		?>
		<p style="text-align:center">
			
			<strong><FONT size="6">ENZYME</strong> : <?php echo $data['num_EC']; ?></FONT><br><br>
		</p>
		
		<p
			<UL TYPE="sqare">
			<LI><FONT color="#8B0000"><strong>Abstract</UL></FONT></strong>
			<u>Different names</u> : <?php echo $data['accepted_name']; echo ','; echo $data['synonym_name'];?><br>
			<u>Reaction</u> : <?php echo $data['reaction'];?>  <br>
			<u>Cofactors</u> : <?php echo $data['cofactor'];?><br>
			<u>Comments</u> : <?php echo $data['comments'];?><br><br>
			
			<UL TYPE="sqare">
			<LI><FONT color="#8B0000"><strong>Publication </UL></FONT></strong>
			<u> <?php echo $data['titre'];?> </u> 
			
			<UL TYPE="circle">
			<LI>auteurs : <?php echo $data['auteurs'];?>
			<LI>First_page : <?php echo $data['first_page']; ?><br>
			<LI>Last_page : <?php echo $data['last_page']; ?><br>
			<LI>Medline : <?php echo $data['medline']; ?><br>
			<LI>Volume : <?php echo $data['volume'];?><br>
			<LI>Pubmed reference: <?php echo $data['pubmed'];?><br>
			</UL>
			
			<UL TYPE="sqare">
			<LI><FONT color="#8B0000"><strong>Familie </UL></FONT></strong>
				<UL TYPE="circle">
				<LI>SP : <?php echo $data['SP'];?>
				<LI>Prosite : <?php echo $data['PROSITE'];?>
				</UL>
		</p>
	<?php
	}
	
	$sql->closeCursor();//Termine le traitement de la requete
	
	$response=Excecuter($bd,"SELECT * FROM Enzyme");
	while($data =$response->fetch(PDO::FETCH_ASSOC)) //Tant quil y a un enregistrement, les instructions sexectutent dans la boucle pour mise en forme
	{
		?>
		<p >
			<strong><FONT size="6">ENZYME</strong> : <?php echo $data['num_EC']; ?></FONT><br><br>
		</p>
		<?php
	}
	$sql->closeCursor();

?>
