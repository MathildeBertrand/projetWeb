<!DOCTYPE html>

<!-- Mise en page -->

<?php
require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Construction des requetes qui interrogent la bd//////////////////////////////
///////////////////////////////////////////////////////////////////////////////

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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////Si on demande un enzyme////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	
	if($_GET['type']=='EC'){ 
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){ //On test le nom de lenzyme (si contient EC ou pas)
			$response=Excecuter($bd,"SELECT Enzyme.o_name,Enzyme.num_EC,Enzyme.accepted_name FROM Enzyme WHERE Enzyme.num_EC='".$_GET['val']."'");
		}else{
			$response=Excecuter($bd,"SELECT Enzyme.o_name,Enzyme.num_EC,Enzyme.accepted_name FROM Enzyme WHERE Enzyme.num_EC='EC ".$_GET['val']."'");
		}	
		
		//Haut de page : 
		?>
			
			<a href="#Abstract">Abstract</a><br>
			<a href="#History">History</a><br>
			<a href="#Publications">Publications</a><br>
			<a href="#PROSITE">PROSITE</a><br>
			<a href="#SP">SP</a><br>
		<?php
		
		//Resume sur lenzyme ----------------------------------------------------------------------------------------------------------------------
		while($data =$response->fetch()){ //On boucle pour recuperer o_name,num_EC et accpeted_name
					?>
					
					<div class="container-fluid">
						<strong><FONT size="9">ENZYME</strong> : <?php echo $data['num_EC']; ?></FONT><br><br>							
					</div>
					
					<UL TYPE="sqare">
						
						<strong><FONT size="6" color="#DB0073" id="Abstract"><strong>Abstract</FONT></strong><br>
						<hR  width="100%" >
						<FONT color="#048B9A">accepted_name</FONT></strong> : <?php echo $data['accepted_name']; ?> <br>
						<FONT color="#048B9A"><strong>o_name</FONT></strong>: <?php echo $data['o_name']; ?><br>
						<FONT color="#048B9A"><strong>synonym</FONT></strong>:
								
				<?php 
							
				}
		
			//Les synonyms
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT synonym_name FROM Names WHERE num_EC='". $_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT synonym_name FROM Names WHERE num_EC='EC ". $_GET['val']."'");
		}
		
		while($data =$response->fetch(PDO::FETCH_ASSOC)){
			?>
			 <?php echo $data['synonym_name'];
			 echo ", "; 
		}	
		
			//Les reactions et les cofacteurs
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT reaction,cofactor FROM Enzyme WHERE num_EC='". $_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT reaction,cofactor FROM Enzyme WHERE num_EC='EC ". $_GET['val']."'");
		}
		
		while($data =$response->fetch(PDO::FETCH_ASSOC)){
			?>
			<br><br>
				
					<center><FONT color="#048B9A"><strong>Reaction</FONT></strong> : <?php echo $data['reaction'];?> </center> <br>
					<?php //On regarde si la chaine de cofactor est vide et si non, on ecrit les cofactor associes a lenzyme
					$str2='';
					if (strcmp ($data['cofactor'], $str2 )!=0){ 
					?><FONT color="#048B9A"><strong>Cofactors</FONT></strong> : <?php echo $data['cofactor'];?><br>
					
				
			<?php }
			
		}
		
			//Les commentaires	
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT DISTINCT comment FROM Comments WHERE num_EC='". $_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT DISTINCT comment FROM Comments WHERE num_EC='EC ". $_GET['val']."'");
		}
		
		?><br> <FONT color="#048B9A"><strong>Comments</FONT></strong> :<?php
		
		while($data =$response->fetch(PDO::FETCH_ASSOC)){
			?>
			
			<?php //On regarde si la chaine de commentaire est vide et si non, on ecrit les comments associes a lenzyme
			$str2='';
			if (strcmp ($data['comment'], $str2 )!=0){ 
				
				echo $data['comment'];}?>
			<br>
			
			<?php
		}	
			
		//History----------------------------------------------------------------------------------------------------------------------
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT history FROM Enzyme WHERE num_EC='".$_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT history FROM Enzyme WHERE num_EC='EC ".$_GET['val']."'");
		}
		
		while($data =$response->fetch(PDO::FETCH_ASSOC)){
		
			?>
			<FONT size="6" color="#DB0073" id="History"><strong>History</FONT></strong>
			<hr>
			<?php echo $data['history']; 

		}	
		//Lensemble des publications----------------------------------------------------------------------------------------------------------------------
		
					//On les range dans des tableaux
		?> <br><br>
		<FONT size="6" color="#DB0073" id="Publications"><strong>Publications</FONT></strong>
		<hr ><br>
		<center><table border="1" width="1000" >
			<tr>
				<td>Title</td>
				<td>Authors</td>
				<td>First_page</td>
				<td>Last_page</td>
				<td>volume</td>
				<td>year</td>
				<td>pubmed</td>
			</tr>
			
			<?php	
			
			if((stripos($_GET['val'], 'EC') !== FALSE) ){				
				$response=Excecuter($bd,"SELECT * FROM Publication WHERE num_EC='".$_GET['val']."'"); 
			}else{
				$response=Excecuter($bd,"SELECT * FROM Publication WHERE num_EC='EC ".$_GET['val']."'");
			}	
			
			while($data =$response->fetch(PDO::FETCH_ASSOC)){
				?>
				<tr>
					<td> <?php echo $data['titre']; ?></td>
					<td> <?php echo $data['auteurs']; ?></td>
				
				<?php
				//On test : si on a des valeurs =0, cest que lon a pas dinformation dessus
				if ($data['first_page'] !=0){ ?> <td> <?php echo $data['first_page'];?> </td> <?php }
				if ($data['last_page'] !=0){ ?> <td> <?php echo $data['last_page']; ?></td> <?php } 
				if ($data['volume'] !=0){ ?> <td> <?php echo $data['volume'];?> </td> <?php }
				if($data['year'] !=0){ ?> <td> <?php echo $data['year'];?> </td> <?php }
				if($data['pubmed'] !=0){ ?> <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/?term=<?php echo $data['pubmed'];?>"> <?php echo $data['pubmed'];?> </td></a>  <?php 
				}
	
				
			} ?></table></center><?php
			
		
		//Les Familles proteiques--------------------------------------------------------------------------------------------------------
		
		?>
			<br><br>
			<FONT size="6" color="#DB0073" id="PROSITE"><strong>Protein Family (PROSITE)</FONT></strong>
			<hr  width="100%"><br>
		
		<?php
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT PROSITE FROM Family WHERE num_EC='".$_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT PROSITE FROM Family WHERE num_EC='EC ".$_GET['val']."'");
		}	
		
		while($data =$response->fetch(PDO::FETCH_ASSOC)){
			?>
			<a href="https://prosite.expasy.org/<?php echo $data['PROSITE'];?>">	<?php echo $data['PROSITE']; echo " ; ";?></a>  <?php
		}
	
		//Les Sequences proteiques--------------------------------------------------------------------------------------------------------
		
		
		?><br><br>
		<FONT size="6" color="#DB0073" id="SP"><strong>Protein Sequence (SP)</UL></FONT></strong>
		<hr  width="100%"><br>
		
		<?php
		//Test de la syntaxe de EC
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT SP_name,SP_id FROM ProtSeq WHERE num_EC='".$_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT SP_name,SP_id FROM ProtSeq WHERE num_EC='EC ".$_GET['val']."'");
		}
		
		//Affichage des resultats sous forme dun tableau
		?>
		<center><table border="1" width="1000" >
			<tr>
				<td>Organism</td>
				<td>chaine</td>
				<td>Name</td>
				<td>Key</td>
			</tr>
		
		<?php	
		$i=0;	
		while($data =$response->fetch(PDO::FETCH_ASSOC)){
			//On modifie $name pour ne recuperer que le nom de lorganisme : 
			$name=$data['SP_name'];
			$name_split=explode("_",$name);
			
			//On remplit le tableau tel que lon souhaite lafficher
		//	$table=array();
		//	$table[$i]=array($name[1],$name[0],$data['SP_name'],$data['SP_id']);
			$i++;
			?>
						
				<tr>
					 <td><?php echo $name_split[1];?></td>
					  <td><?php echo $name_split[0];?> </td>
					  <td><?php echo $data['SP_name']; ?></a>  </td>
					 <td><a href="http://www.uniprot.org/uniprot/<?php echo $data['SP_id'];?>">	<?php echo $data['SP_id']; ?></a>  </td>
				</tr>
		<?php
		}
		
		?></table></center>	
			
		<?php
		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
//////////////////////////Si on rentre un cofacteur///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	}else if ($_GET['type']=='Cofactor'){ 
			$response=Excecuter($bd,"Select num_EC FROM Enzyme WHERE cofactor='".$_GET['val']."'");
			
			?><strong><FONT size="6">Liste des enzymes qui utilisent le cofacteur <?php echo $_GET['val']?></strong><br><br> <?php
			
			while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
				?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br><?php 
						
			}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Si on rentre une maladie ///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	}else if ($_GET['type']=='Disease'){
		
		?><strong><FONT size="6">Sorry, we did not find enzymes associated to this disease</strong> <?php
		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////			
//////////////////////////Si on rentre un Names //////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}else if ($_GET['type']=='Names'){
			
			?><strong><FONT size="6">Liste des enzymes qui ont le nom <?php echo $_GET['val']?></strong><br><br> <?php
			
			$response=Excecuter($bd,"Select num_EC FROM Names WHERE Names.synonym_name='".$_GET['val']."'");
			while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
				?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br><?php 
			}
			
			$response=Excecuter($bd,"Select num_EC FROM Enzyme WHERE accepted_name='".$_GET['val']."' OR o_name='".$_GET['val']."'");
			while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
				?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br><?php 
			}
		}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Si on rentre un SP /////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Si on rentre un proteine family ////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
?>
