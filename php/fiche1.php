<!DOCTYPE html>

<!-- Mise en page -->
<html>
	<head>
		<meta charset="utf-8">
		<title> Home page </title>
		<link rel="stylesheet" href="UI/css/bootstrap.min.css" />
		<link rel="stylesheet" href="UI/css/MyStylesheet.css" />
	</head>
	
	<body class="bg">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
				
					<!-- website name -->
					<div class="navbar-header">
						<a href="" class="navbar-brand">ENZyclopédia</a>
					</div>
					
					<!-- Menu items -->
					<div>
						<ul class="nav navbar-nav">
							<li class="active"><a href="cover.php">Home</a></li>
							<li><a href="#">About us</a></li>
							<li><a href="ExplorationBD.php">Exploration BD</a></li>
							<li><a href="#">FAQ</a></li>
							<li><a href="#">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
							<img src="UI/img/user1.png"  width="35"/>
							<li><a href="login.php"> log in </a><li>
						</ul>
					</div>
			
		</div>
		
	</body>	
<?php
require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Construction des requetes qui interrogent la bdC/////////////////////////////
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



///////////////////////Si on demande un enzyme////////////////////////////////////////////////////////////////
	
	if($_GET['type']=='EC'){ 
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){ //On test le nom de lenzyme (si contient EC ou pas)
			$response=Excecuter($bd,"SELECT Enzyme.o_name,Enzyme.num_EC,Enzyme.accepted_name FROM Enzyme WHERE Enzyme.num_EC='".$_GET['val']."'");
		}else{
			$response=Excecuter($bd,"SELECT Enzyme.o_name,Enzyme.num_EC,Enzyme.accepted_name FROM Enzyme WHERE Enzyme.num_EC='EC ".$_GET['val']."'");
		}	
	

		//Resume sur lenzyme ----------------------------------------------------------------------------------------------------------------------
		while($data =$response->fetch()){ //On boucle pour recuperer o_name,num_EC et accpeted_name
					?>
					
					<div class="container-fluid">
						<strong><FONT size="9">ENZYME</strong> : <?php echo $data['num_EC']; ?></FONT><br><br>							
					</div>
					
					<UL TYPE="sqare">
						
						<strong><FONT size="6" color="#DB0073"><strong>Abstract</FONT></strong><br>
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
				<p style="text-align:center">
					<FONT color="#048B9A"><strong>Reaction</FONT></strong> : <?php echo $data['reaction'];?>  <br>
				
					<?php //On regarde si la chaine de cofactor est vide et si non, on ecrit les cofactor associes a lenzyme
					$str2='';
					if (strcmp ($data['cofactor'], $str2 )!=0){ 
					?><FONT color="#048B9A"><strong>Cofactors</FONT></strong> : <?php echo $data['cofactor'];?><br>
					
				</p>
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
			
			
		//Lensemble des publications----------------------------------------------------------------------------------------------------------------------
		
						
		?> <br>
		<FONT size="6" color="#DB0073"><strong>Publication</FONT></strong>
		<hr ><br>
		<?php	
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){				
			$response=Excecuter($bd,"SELECT * FROM Publication WHERE num_EC='".$_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT * FROM Publication WHERE num_EC='EC ".$_GET['val']."'");
		}	
		
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
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT history FROM Enzyme WHERE num_EC='".$_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT history FROM Enzyme WHERE num_EC='EC ".$_GET['val']."'");
		}
		
		while($data =$response->fetch(PDO::FETCH_ASSOC)){
		
			?>
			<FONT size="6" color="#DB0073"><strong>History</FONT></strong>
			<hr><br>
			<?php echo $data['history']; 

		}
		
		//Les Sequences proteiques--------------------------------------------------------------------------------------------------------
		
		
		?><br><br>
		<FONT size="6" color="#DB0073"><strong>Protein Sequence</UL></FONT></strong>
		<hr  width="100%"><br>
		<u>SP</u> :
		<?php
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT SP_name,SP_id FROM ProtSeq WHERE num_EC='".$_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT SP_name,SP_id FROM ProtSeq WHERE num_EC='EC ".$_GET['val']."'");
		}
		while($data =$response->fetch(PDO::FETCH_ASSOC)){
			?>
			 <a href="http://www.uniprot.org/uniprot/<?php echo $data['SP_id'];?>">	<?php echo $data['SP_name']; echo " ; ";?></a>  <?php
		
		}
		
		//Les Familles proteiques--------------------------------------------------------------------------------------------------------
		
		?>
			<br><br>
			<FONT size="6" color="#DB0073"><strong>Protein Family</FONT></strong>
			<hr  width="100%"><br>
			<u>PROSITE</u> :
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
	
	
//////////////////////////Si on rentre un cofacteur////////////////////////////////////////////////////////////////
	
	}else if ($_GET['type']=='Cofactor'){ 
			$response=Excecuter($bd,"Select num_EC FROM Enzyme WHERE cofactor='".$_GET['val']."'");
			
			?><strong><FONT size="6">Liste des enzymes qui utilisent le cofacteur <?php echo $_GET['val']?></strong><br><br> <?php
			
			while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
				?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br><?php 
						
			}
//////////////////////////Si on rentre une maladie ////////////////////////////////////////////////////////////////

	}else if ($_GET['type']=='Disease'){
		
		?><strong><FONT size="6">Sorry, we did not find enzymes associated to this disease</strong> <?php
		
			//////////////////////////Si on rentre un Names ////////////////////////////////////////////////////////////////
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

		
	

//////////////////////////Si on rentre un SP //////////////////////////////////////////////////////////////////

//////////////////////////Si on rentre un proteine family //////////////////////////////////////////////////////
?>
