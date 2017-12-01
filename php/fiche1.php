<?php
require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Construction des requetes en fonction des resultats//////////////////////////
///////////////////////////////////////////////////////////////////////////////


//Connection a la base : 
mysql_close;
try
	{
	$bd=new PDO('mysql:host=127.0.0.1; dbname=ProjetWeb2017','root','Pachadu92');
	echo "Connexion reussie a Mysql";
	
	}
	catch(Exception $e){
		echo "Connexion non reussie a Mysql";
		die('Erreur: '.$e->getMessage());
	}



//Afficher la fiche descriptive de lenzyme selectionnee :

//Resume sur lenzyme ----------------------------------------------------------------------------------------------------------------------
	$response=Excecuter($bd,"SELECT Enzyme.o_name,Enzyme.num_EC,Enzyme.accepted_name FROM Enzyme WHERE Enzyme.num_EC='".$_GET['num_EC']."'");	
 
	
	while($data =$response->fetch()){ //On boucle pour recuperer o_name,num_EC et accpeted_name
				?>
				<p style="text-align:center">
					<strong><FONT size="6">ENZYME</strong> : <?php echo $data['num_EC']; ?></FONT><br><br>
				</p>
				
				<p
					<UL TYPE="sqare">
					<LI><FONT color="#8B0000"><strong>Abstract</UL></FONT></strong><br>
					<u>accepted_name</u> : <?php echo $data['accepted_name']; ?> 
					<u>o_name</u> : <?php echo $data['o_name']; ?>
					<u>synonym</u> :
							
			<?php 
						
			}
			
	$response=Excecuter($bd,"SELECT synonym_name FROM Names WHERE num_EC='". $_GET['num_EC']."'"); //Les synonyms
	while($data =$response->fetch(PDO::FETCH_ASSOC)){
		?>
		 <?php echo $data['synonym_name'];
		 echo ", "; 
	}	
	
	$response=Excecuter($bd,"SELECT reaction,cofactor FROM Enzyme WHERE num_EC='". $_GET['num_EC']."'"); //Les reactions et les cofacteurs
	while($data =$response->fetch(PDO::FETCH_ASSOC)){
		?>
		<br>
			<u>Reaction</u> : <?php echo $data['reaction'];?>  <br>
			
			<?php //On regarde si la chaine de cofactor est vide et si non, on ecrit les cofactor associes a lenzyme
			$str2='';
			if (strcmp ($data['cofactor'], $str2 )!=0){ 
			?><u>Cofactors</u> : <?php echo $data['cofactor'];?><br>
		<?php }
		
	}
	
	$response=Excecuter($bd,"SELECT comment FROM Comments WHERE num_EC='". $_GET['num_EC']."'"); //Les commentaires	
	while($data =$response->fetch(PDO::FETCH_ASSOC)){
		?>
		
		<br><?php //On regarde si la chaine de commentaire est vide et si non, on ecrit les comments associes a lenzyme
		$str2='';
		if (strcmp ($data['comment'], $str2 )!=0){ 
			?><u>Comments</u> :<?php
			echo $data['comment'];}?><br> 
		<br>
		
		<?php
	}	
		
		
	//Lensemble des publications----------------------------------------------------------------------------------------------------------------------
	
	?><UL TYPE="sqare">
	<LI><FONT color="#8B0000"><strong>Publication</UL></FONT></strong><br>
	<?php	
				
	$response=Excecuter($bd,"SELECT * FROM Publication WHERE num_EC='".$_GET['num_EC']."'"); 	
	while($data =$response->fetch(PDO::FETCH_ASSOC)){
		?>
		
		<u>Title</u> : <?php echo $data['titre']; ?> <br>
		<u>authors</u> : <?php echo $data['auteurs']; 
		
		//On test : si on a des valeurs =0, cest que lon a pas dinformation dessus
		if ($data['first_page'] !=0){ ?> <br> <u>first_page</u> : <?php  echo $data['first_page'];} 
		if ($data['last_page'] !=0){ ?> <br><u>last_page</u> : <?php echo $data['last_page']; }
		if ($data['volume'] !=0){ ?> <br><u>volume</u> : <?php echo $data['volume'];} 
		if($data['pubmed'] !=0){ ?> <br> <u>pubmed</u> : <a href="https://www.ncbi.nlm.nih.gov/pubmed/?term=<?php echo $data['pubmed'];?>"><?php echo $data['pubmed']; ?></a>  <?php }

		 if($data['year'] !=0){ ?> <br><u>year</u> : <?php echo $data['year'];} ?> <br><br>
		
		<?php
	}
	
	//History----------------------------------------------------------------------------------------------------------------------
	
	$response=Excecuter($bd,"SELECT history FROM Enzyme WHERE num_EC='".$_GET['num_EC']."'"); 
	while($data =$response->fetch(PDO::FETCH_ASSOC)){
	?>
	 <UL TYPE="sqare">
	<LI><FONT color="#8B0000"><strong>History</UL></FONT></strong><br>
	<?php echo $data['history']; 

	}
	
	//Les Sequences proteiques--------------------------------------------------------------------------------------------------------
	
	?><UL TYPE="sqare">
	<LI><FONT color="#8B0000"><strong>Protein Sequence</UL></FONT></strong><br>
	<u>SP</u> :
	<?php
	
	$response=Excecuter($bd,"SELECT SP_name,SP_id FROM ProtSeq WHERE num_EC='".$_GET['num_EC']."'"); 
	while($data =$response->fetch(PDO::FETCH_ASSOC)){
		?>
		 <a href="http://www.uniprot.org/uniprot/<?php echo $data['SP_id'];?>">	<?php echo $data['SP_name']; echo " ; ";?></a>  <?php
	
	}
	
	//Les Familles proteiques--------------------------------------------------------------------------------------------------------
	
	?><UL TYPE="sqare">
		<LI><FONT color="#8B0000"><strong>Protein Family</UL></FONT></strong><br>`
		<u>PROSITE</u> :
	<?php
	
	$response=Excecuter($bd,"SELECT PROSITE FROM Family WHERE num_EC='".$_GET['num_EC']."'"); 
	while($data =$response->fetch(PDO::FETCH_ASSOC)){
		?>
		<a href="https://prosite.expasy.org/<?php echo $data['PROSITE'];?>">	<?php echo $data['PROSITE']; echo " ; ";?></a>  <?php
		 
	
	}

?>
