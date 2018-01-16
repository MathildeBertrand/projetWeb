<!DOCTYPE html>
<?php
//session_start();
require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Construction des requetes qui interrogent la bd//////////////////////////////
///////////////////////////////////////////////////////////////////////////////

//Connection a la base : 
mysql_close;
$dsn = 'mysql:host=127.0.0.1; dbname=ProjetWeb2017';
$username = 'root';
$password = 'mysql2017';
	
try
	{
	$bd=new PDO($dsn, $username, $password);
	
	}
	catch(Exception $e){
		echo "Connexion non reussie a Mysql";
		die('Erreur: '.$e->getMessage());
	}
?>

<html>
	<head>
		<meta charset="utf-8">
		<title> Fiche </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
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
							<li class="active"><a href="../index.php">Home</a></li>
							<li><a href="./aboutUs.php">About us</a></li>
							<li ><a href="ExplorationBD.php">Exploration BD</a></li>
							<li><a href="./faq.php">FAQ</a></li>
							<li><a href="./contact.php">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
						<?php
						if (isset($_SESSION['mail'])){
							echo "<a href='../includes/logout.inc.php'><img class='icon-logout' src='../img/logout.png'/></a>
									<li><a href='./myAccount.php'>Customer Area</a></li>";
						  }else{
							  echo "<img src='../img/user1.png'  width='35'/>
									<li><a href='./login.php'> Log in</a></li>";
						  }
						?>
							
						</ul>
					</div>		
			</nav>
	
<?php
///////////////////////////////////////////////
////// Gestion de la customer Area////////////
///////////////////////////////////////////////

if(isset ($_SESSION['mail'])){ //Si la personne est connectee
	$mail=$_SESSION['mail'];
	
	//Gestion de laffichage
	echo "<a href='../includes/logout.inc.php'><img class='icon-logout' src='../img/logout.png'/></a>
									<li><a href='./myAccount.php'>Customer Area</a></li>";
	
	//Si la personne interroge la base de donnee : 				 
	
	if ($_GET['type']=="EC"){ 
		$num_EC=$_GET['type']." ".$_GET['val'];

		//On test si cest bien un enzyme ; 
		if((stripos($_GET['val'], 'EC') !== FALSE) ){ //On test le nom de lenzyme (si contient EC ou pas)
			$response=Excecuter($bd,"SELECT * FROM Enzyme WHERE Enzyme.num_EC='".$_GET['val']."'");	
		}else{
			$response=Excecuter($bd,"SELECT * FROM Enzyme WHERE Enzyme.num_EC='EC ".$_GET['val']."'");
		}	

		if($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on a rentre le bon truc alors on remplit la table History
			$bd->query("INSERT INTO History(mail,num_EC) VALUES ('".$mail."','".$num_EC."')");
		}//Sinon on ne fait rien

	}elseif ($_GET['type']=="Cofactor"){
		$cofactor=$_GET['val'];

		//On test si le cofacteur est bien un cofacteur : 
		$response=Excecuter($bd,"Select num_EC FROM Enzyme WHERE cofactor like '%".$_GET['val']."%' OR cofactor like '".$_GET['val']."%' OR cofactor like '%".$_GET['val']."' OR  cofactor='".$_GET['val']."' ORDER BY num_EC");

		if($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on a rentre le bon truc alors on remplit la table History
			$bd->query("INSERT INTO History(mail,cofactor) VALUES ('".$mail."','".$cofactor."')");
		}else{}//Sinon on ne fait rien

	//}elseif ($_GET['type']=="Disease"){
	//	$disease=$_GET['val'];
	//	$bd->query("INSERT INTO History(mail,disease_name) VALUES ('".$mail."','".$disease."')");

	}elseif ($_GET['type']=="Protein family"){
		$protF=$_GET['val'];

		//Verification : 
		$response=Excecuter($bd,"Select num_EC FROM Family WHERE PROSITE='".$_GET['val']."'");
		if($data =$response->fetch(PDO::FETCH_ASSOC)){ 
			$bd->query("INSERT INTO History(mail,family) VALUES ('".$mail."','".$protF."')");
		}

	}elseif ($_GET['type']=="Name"){
		$name=$_GET['val'];

		//Verfication : 
		$response=Excecuter($bd,"Select num_EC FROM Family WHERE PROSITE='".$_GET['val']."'");
		if($data =$response->fetch(PDO::FETCH_ASSOC)){ 
			$bd->query("INSERT INTO History(mail,Name) VALUES ('".$mail."','".$name."')");
		}

	}elseif($_GET['type']=="Protein sequence"){
		$protSeq=$_GET['val'];

		//Verification : 
		$response=Excecuter($bd,"Select num_EC FROM ProtSeq WHERE SP_id='".$_GET['val']."' OR SP_name='".$_GET['val']."'"); 
		if($data =$response->fetch(PDO::FETCH_ASSOC)){
			$bd->query("INSERT INTO History(mail,ProtSeq) VALUES ('".$mail."','".$protSeq."')");
		}
	}
} 
	//Pourquoi passer par des query et non pas par la fonction Excecuter2 ?
	// A quoi sert cette ligne ?									
	Excecuter2($bd,"INSERT INTO History(mail,num_EC, cofactor, disease_name, family, ProtSeq, Name)  VALUES ('".$mail."','".$history."')");


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////Si on demande un enzyme////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if($_GET['type']=='EC'){ 
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){ //On test le nom de lenzyme (si contient EC ou pas)
			$response=Excecuter($bd,"SELECT Enzyme.o_name,Enzyme.num_EC,Enzyme.accepted_name FROM Enzyme WHERE Enzyme.num_EC='".$_GET['val']."'");
			
		}else{
			$response=Excecuter($bd,"SELECT Enzyme.o_name,Enzyme.num_EC,Enzyme.accepted_name FROM Enzyme WHERE Enzyme.num_EC='EC ".$_GET['val']."'");
		}	
		
		//Menu de navigation : 
		?>
		<script type="text/javascript">
			function imprimer_page(){
			  window.print();
		}
		</script>
		<form>
		  <input id="impression" name="impression" type="button" onclick="imprimer_page()" value="Print this page" />
		</form>

		<link rel="stylesheet" href="../css/MyStylesheet.css" />
			<div class="menu" >

				<u><strong><FONT size="6">Menu</FONT></u></strong> <br>
					<UL>
						<LI><a href="#Abstract"><FONT size="6">Abstract</a></FONT><br>
						<LI><a href="#History"><FONT size="6">History</a></FONT><br>
						<LI><a href="#Publications"><FONT size="6">Publications</a></FONT><br>
						<LI><a href="#PROSITE"><FONT size="6">Protein Family</a></FONT><br>
						<LI><a href="#SP"><FONT size="6">Protein Sequence</a></FONT><br>
					</UL>
					<br><br>
				<u><strong><FONT size="6">Links</FONT></u></strong><br> <br>
					<center>
						<a href=https://www.ncbi.nlm.nih.gov/pubmed><img src="../img/pubmed.png"  width="100"/></a><br><br>
						<a href=http://prosite.expasy.org/><img src="../img/prosite.gif" width="100"/></a><br><br>
						<a href=http://www.uniprot.org><img src="../img/sp.png"  width="100"/></a><br><br>
						<a href=http://www.kegg.jp/><img src="../img/kegg.jpg"  width="100"/></a><br><br>
					</center>
			
				</ul>
			</div>
		</nav>
					
		<?php
		
		//Resume sur lenzyme ----------------------------------------------------------------------------------------------------------------------
		if($data =$response->fetch()){ //On boucle pour recuperer o_name,num_EC et accpeted_name
					
					//On remplit la table TopEnzyme
					Excecuter2($bd,"INSERT INTO TopEnzyme(num_EC) VALUES ('".$data['num_EC']."')");
		?>
						
					<div class="contenu">
					<div class="jumbotron_enzyme">
						<strong><FONT size="9">ENZYME</strong> : <?php echo $data['num_EC']; ?></FONT><br><br>							
					</div>	
					
					<UL TYPE="sqare">
						
						<strong><FONT size="6" color="#DB0073" id="Abstract"><strong>Abstract</FONT></strong><br>
						<hR  width="100%" >
						<FONT color="#048B9A" size="3">Accepted_name</FONT></strong> : <?php echo $data['accepted_name']; ?> <br>
						<FONT color="#048B9A" size="3"><strong>O_name</FONT></strong>: <?php echo $data['o_name']; ?><br>
						<FONT color="#048B9A" size="3"><strong>Synonyms</FONT></strong>:
						
				<?php 
						$EC=$data['num_EC'];
						$a_name=$data['accepted_name'];
						$o_name=$data['o_name'];

				}else{
					?>
					<div class="contenu">
					<div class="jumbotron_enzyme">
						<strong><FONT size="9">Sorry, not in the database</strong>  <?php echo $data['num_EC']; ?></FONT><br><br>							
					</div>
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
			 $syn=$data['synonym_name'];
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
				
					<FONT color="#048B9A" size="3"><strong>Reaction</FONT></strong> : <?php echo $data['reaction'];?> <br><br>
					<?php //On regarde si la chaine de cofactor est vide et si non, on ecrit les cofactor associes a lenzyme
					$str2='';
					if (strcmp ($data['cofactor'], $str2 )!=0){ 
					?><FONT color="#048B9A" size="3"><strong>Cofactors</FONT></strong> : <?php echo $data['cofactor'];?><br>
					
				
			<?php }
			
		}
		
			//Les commentaires	
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT DISTINCT comment FROM Comments WHERE num_EC='". $_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT DISTINCT comment FROM Comments WHERE num_EC='EC ". $_GET['val']."'");
		}
		
		
		if($data =$response->fetch(PDO::FETCH_ASSOC)){ // Si on a rentre le bon truc
			?><br> <FONT color="#048B9A" size="3"><strong>Comments</FONT></strong> :<?php
			if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT DISTINCT comment FROM Comments WHERE num_EC='". $_GET['val']."'"); 
			}else{
				$response=Excecuter($bd,"SELECT DISTINCT comment FROM Comments WHERE num_EC='EC ". $_GET['val']."'");
			}
			
			while($data =$response->fetch(PDO::FETCH_ASSOC)){
				?>
				
				<?php //On regarde si la chaine de commentaire est vide et si non, on ecrit les comments associes a lenzyme
				$str2='';
				if (strcmp ($data['comment'], $str2 )!=0){ 
					
					echo $data['comment'];}?>
				<br>
				
				<?php	
			}

		}else{ //Si on rentre nimporte quoi, on affiche rien
		}
		?>
		<br> 

		<?php 
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
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){				
				$response=Excecuter($bd,"SELECT * FROM Publication WHERE num_EC='".$_GET['val']."'ORDER BY titre"); 
		}else{
				$response=Excecuter($bd,"SELECT * FROM Publication WHERE num_EC='EC ".$_GET['val']."'ORDER BY titre");
		}	
				
		if($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on a rentre le bon truc
			//On les range dans des tableaux
			?> <br><br>
			<FONT size="6" color="#DB0073" id="Publications"><strong>Publications</FONT></strong>
			<hr ><br>
			<center><table border="1" width="1000" >
				<tr>
					<td><strong>Title</strong></td>
					<td><strong>Authors</strong></td>
					<td><strong>First_page</strong></td>
					<td><strong>Last_page</strong></td>
					<td><strong>volume</strong></td>
					<td><strong>year</strong></td>
					<td><strong>pubmed</strong></td>
				</tr>
			
				<?php	
				if((stripos($_GET['val'], 'EC') !== FALSE) ){				
					$response=Excecuter($bd,"SELECT * FROM Publication WHERE num_EC='".$_GET['val']."'ORDER BY titre"); 
				}else{
					$response=Excecuter($bd,"SELECT * FROM Publication WHERE num_EC='EC ".$_GET['val']."'ORDER BY titre");
				}	
				
				while($data =$response->fetch(PDO::FETCH_ASSOC)){
					?>
					<tr>
						<td> <?php echo $data['titre']; ?></td>
						<td> <?php echo $data['auteurs']; ?></td>
					
					<?php //On test : si on a des valeurs =0, cest que lon a pas dinformation dessus
					if ($data['first_page'] !=0){ ?> <td> <?php echo $data['first_page'];?> </td> <?php }
					if ($data['last_page'] !=0){ ?> <td> <?php echo $data['last_page']; ?></td> <?php } 
					if ($data['volume'] !=0){ ?> <td> <?php echo $data['volume'];?> </td> <?php }
					if($data['year'] !=0){ ?> <td> <?php echo $data['year'];?> </td> <?php }
					if($data['pubmed'] !=0){ ?> <td><a href="https://www.ncbi.nlm.nih.gov/pubmed/?term=<?php echo $data['pubmed'];?>"> <?php echo $data['pubmed'];?> </td></a>  <?php 
					}
			} ?></table></center><?php 

		}else{ //Si on a rentre nimporte quoi 
		}
			
		
		//Les Familles proteiques--------------------------------------------------------------------------------------------------------
		
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT PROSITE FROM Family WHERE num_EC='".$_GET['val']."'"); 
		}else{
			$response=Excecuter($bd,"SELECT PROSITE FROM Family WHERE num_EC='EC ".$_GET['val']."'");
		}	

		if($data =$response->fetch(PDO::FETCH_ASSOC)){
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
			
			$cpt=0;
			while($data =$response->fetch(PDO::FETCH_ASSOC)){
				$cpt++;
				?>
				<a href="https://prosite.expasy.org/<?php echo $data['PROSITE'];?>">	<?php echo $data['PROSITE']; echo " ; ";?></a>  <?php
			}
			if($data['PROSITE'] ==FALSE && $cpt==0){ //Si les numeros ne sont pas dans la base
					echo 'Nothing in the Database';
			}
				
			}else{}
		
		//Les Sequences proteiques--------------------------------------------------------------------------------------------------------
		
		//Test de la syntaxe de EC
		if((stripos($_GET['val'], 'EC') !== FALSE) ){	
			$response=Excecuter($bd,"SELECT * FROM ProtSeq WHERE num_EC='".$_GET['val']."' ORDER BY organisme"); 
		}else{
			$response=Excecuter($bd,"SELECT * FROM ProtSeq WHERE num_EC='EC ".$_GET['val']."'ORDER BY organisme");
		}

		if($data =$response->fetch(PDO::FETCH_ASSOC)){
			?><br><br>
			<FONT size="6" color="#DB0073" id="SP"><strong>Protein Sequence (SP)</UL></FONT></strong>
			<hr  width="100%"><br>
			
			<?php
			if((stripos($_GET['val'], 'EC') !== FALSE) ){	
				$response=Excecuter($bd,"SELECT * FROM ProtSeq WHERE num_EC='".$_GET['val']."' ORDER BY organisme"); 
			}else{
				$response=Excecuter($bd,"SELECT * FROM ProtSeq WHERE num_EC='EC ".$_GET['val']."'ORDER BY organisme");
			}
			
			//Affichage des resultats sous forme dun tableau
			?><center><table border="1" width="1000" id="ma_table">
				<tr>
					<td><strong>Organism</strong></td>
					<td><strong>Chain</strong></td>
					<td><strong>Name</strong></td>
					<td><strong>Key</strong></td>
				</tr>
			<?php	
			
			$cpt=0;
			while($data =$response->fetch(PDO::FETCH_ASSOC)){
				$cpt++;
				?>		
					<tr>
						 <td><?php echo $data['organisme'];?></td>
						  <td><?php echo $data['chain']; ?> </td>
						  <td><?php echo $data['SP_name']; ?></a>  </td>
						 <td><a href="http://www.uniprot.org/uniprot/<?php echo $data['SP_id'];?>">	<?php echo $data['SP_id']; ?></a>  </td>
					</tr>
			<?php } ?></table></center>	
		<?php

		if($data['SP_name'] ==FALSE && $cpt==0){ //Si pas dinfos concernant le SP, alors on supprime le tableau
				
				echo 'Nothing in the Database';
		} ?>	</div>
		<?php }else{ }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
//////////////////////////Si on rentre un cofacteur///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	}else if ($_GET['type']=='Cofactor'){ 
			$response=Excecuter($bd,"Select num_EC FROM Enzyme WHERE cofactor like '%".$_GET['val']."%' OR cofactor like '".$_GET['val']."%' OR cofactor like '%".$_GET['val']."' OR  cofactor='".$_GET['val']."' ORDER BY num_EC");
			?>
			<div class="menu">
				<u><strong><FONT size="6">Links</FONT></u></strong> <br>
					<center>
						<a href=https://www.ncbi.nlm.nih.gov/pubmed><img src="../img/pubmed.png"  width="100"/></a><br><br>
						<a href=http://prosite.expasy.org/><img src="../img/prosite.gif" width="100"/></a><br><br>
						<a href=http://www.uniprot.org><img src="../img/sp.png"  width="100"/></a><br><br>
					</center>
			</div>
			<div class="contenu">
					<div class="jumbotron_enzyme">
					<?php	$response=Excecuter($bd,"Select num_EC FROM Enzyme WHERE cofactor like '%".$_GET['val']."%' OR cofactor like '".$_GET['val']."%' OR cofactor like '%".$_GET['val']."' OR  cofactor='".$_GET['val']."' ORDER BY num_EC");
					if($data =$response->fetch(PDO::FETCH_ASSOC)){ 
							?>
								<strong><FONT size="6">Enzymes that use the cofactor <?php echo $_GET['val']?></strong><br><br> 
							</div><?php
								while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
									?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br>		
					<?php } ?>
					</div> <?php
				}else{?>
						<strong><FONT size="6">Sorry, <?php echo $_GET['val']?> is not in the database</strong><br><br>
					<?php }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Si on rentre une maladie ///////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	}else if ($_GET['type']=='Disease'){
		
		?><strong><FONT size="6">Sorry, we did not find enzymes associated to this disease</strong> <?php
		
//////////////////////////////////////////////////////////////////////////////////////////////////////////////			
//////////////////////////Si on rentre un Names //////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	}else if ($_GET['type']=='Names'){
			?>
			<div class="menu">
				<u><strong><FONT size="6">Links</FONT></u></strong> <br>
					<center>
						<a href=https://www.ncbi.nlm.nih.gov/pubmed><img src="../img/pubmed.png"  width="100"/></a><br><br>
						<a href=http://prosite.expasy.org/><img src="../img/prosite.gif" width="100"/></a><br><br>
						<a href=http://www.uniprot.org><img src="../img/sp.png"  width="100"/></a><br><br>
					</center>
			</div>
			
			<?php
			
			$response=Excecuter($bd,"Select Names.num_EC FROM Names WHERE  Names.synonym_name='".$_GET['val']."' ORDER BY num_EC");
			if($data =$response->fetch(PDO::FETCH_ASSOC)){ 
				?>
				<div class="contenu">
					<div class="jumbotron_enzyme">
						<strong><FONT size="6">Enzyme that have the name <?php echo $_GET['val']?></strong><br><br> 
					</div>


				<?php
				$response=Excecuter($bd,"Select Names.num_EC FROM Names WHERE  Names.synonym_name='".$_GET['val']."' ORDER BY num_EC");
				while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
					?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br><?php 
				}
				
				$response=Excecuter($bd,"Select num_EC FROM Enzyme WHERE accepted_name='".$_GET['val']."' OR o_name='".$_GET['val']."'");
				while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
					?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br><?php }?>
				</div>
			
			 <?php }else{ ?>
			 <div class="contenu">
					<div class="jumbotron_enzyme">
						<strong><FONT size="6">Sorry <?php echo $_GET['val']?> is not a Name</strong><br><br> 
					</div>
				<?php }
			

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Si on rentre un Protein Family /////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	}else if ($_GET['type']=='Protein family'){
		?>
			<div class="menu">
				<u><strong><FONT size="6">Links</FONT></u></strong> <br>
					<center>
						<a href=https://www.ncbi.nlm.nih.gov/pubmed><img src="../img/pubmed.png"  width="100"/></a><br><br>
						<a href=http://prosite.expasy.org/><img src="../img/prosite.gif" width="100"/></a><br><br>
						<a href=http://www.uniprot.org><img src="../img/sp.png"  width="100"/></a><br><br>
					</center>
			</div>
			
			<?php
			$response=Excecuter($bd,"Select num_EC FROM Family WHERE PROSITE='".$_GET['val']."'");

			if($data =$response->fetch(PDO::FETCH_ASSOC)){ 
				?>
				<div class="contenu">
						<div class="jumbotron_enzyme">
							<strong><FONT size="6">Enzyme in the same protein Family <?php echo $_GET['val']?></strong><br><br> 
						</div><?php
						$response=Excecuter($bd,"Select num_EC FROM Family WHERE PROSITE='".$_GET['val']."'");
						while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
							?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br><?php 
				}
				?></div> <?php
			}else{
				?>
				<div class="contenu">
						<div class="jumbotron_enzyme">
							<strong><FONT size="6">Sorry <?php echo $_GET['val']?> is not in the database</strong><br><br> 
						</div><?php
			}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Si on rentre un SP//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

	}else if ($_GET['type']=='Protein sequence'){
		?>
			<div class="menu" style="position:fixed;">
				<u><strong><FONT size="6">Links</FONT></u></strong> <br>
					<center>
						<a href=https://www.ncbi.nlm.nih.gov/pubmed><img src="../img/pubmed.png"  width="100"/></a><br><br>
						<a href=http://prosite.expasy.org/><img src="../img/prosite.gif" width="100"/></a><br><br>
						<a href=http://www.uniprot.org><img src="../img/sp.png"  width="100"/></a><br><br>
					</center>
			</div>
			

			<?php $response=Excecuter($bd,"Select num_EC FROM ProtSeq WHERE SP_id='".$_GET['val']."' OR SP_name='".$_GET['val']."'"); 

			if($data =$response->fetch(PDO::FETCH_ASSOC)){ ?>
				<div class="contenu">
						<div class="jumbotron_enzyme">
							<strong><FONT size="6">Enzyme in the same protein Family <?php echo $_GET['val']?></strong><br><br> 
						</div><?php
						$response=Excecuter($bd,"Select num_EC FROM ProtSeq WHERE SP_id='".$_GET['val']."' OR SP_name='".$_GET['val']."'");
						while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
							?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br><?php 
						}
				?></div> <?php
				}else{
					?>
					<div class="contenu">
							<div class="jumbotron_enzyme">
								<strong><FONT size="6">Sorry <?php echo $_GET['val']?> is not in the database</strong><br><br> 
							</div><?php
				}
	


//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////Si on rentre un autheur/////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}else if ($_GET['type']=='Author'){
		?>
			<div class="menu" style="position:fixed;">
				<u><strong><FONT size="6">Links</FONT></u></strong> <br>
					<center>
						<a href=https://www.ncbi.nlm.nih.gov/pubmed><img src="../img/pubmed.png"  width="100"/></a><br><br>
						<a href=http://prosite.expasy.org/><img src="../img/prosite.gif" width="100"/></a><br><br>
						<a href=http://www.uniprot.org><img src="../img/sp.png"  width="100"/></a><br><br>
					</center>
			</div>
			<?php $response=Excecuter($bd,"Select num_EC,auteurs FROM Publication WHERE auteurs like '%".$_GET['val']."' OR auteurs like '".$_GET['val']."%' OR auteurs='".$_GET['val']."' OR auteurs like '%".$_GET['val']."%'"); 

			if($data =$response->fetch(PDO::FETCH_ASSOC)){ 
				$aut=$data['auteurs'];?>
				
				<div class="contenu">
						<div class="jumbotron_enzyme">
							<strong><FONT size="6"><?php echo $aut ?> wrote about :</strong><br><br> 
						</div><?php
						$response=Excecuter($bd,"Select num_EC FROM Publication WHERE auteurs like '%".$aut."' OR auteurs like '".$aut."%' OR auteurs='".$aut."'");
						while($data =$response->fetch(PDO::FETCH_ASSOC)){ //Si on clique sur une enzyme, on peut avoir sa fiche descriptive
							?><strong><FONT size="6">ENZYME</strong> :<a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"> <?php echo $data['num_EC']; ?></a></FONT><br><?php 
						}
						?></div> <?php
				}else{
					?>
					<div class="contenu">
							<div class="jumbotron_enzyme">
								<strong><FONT size="6">Sorry <?php echo $_GET['val']?> is not in the database</strong><br><br> 
							</div><?php
				}
			}
?>

	</body>	
</html>
