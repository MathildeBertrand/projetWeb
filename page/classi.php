<?php

//Affiche la liste de lensemble des enzymes sous forme dun tableau

require("functions.php");
$AFF=FALSE; 

//Connection a la base : 
include('../includes/dbh.inc.php');


?>

<!DOCTYPE html>
<!-- Mise en page -->
<html>
	<head>
		<meta charset="utf-8">
		<title> Enzyme Classification </title>
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
							<li><a href="../index.php">Home</a></li>
							<li><a href="./aboutUs.php">About us</a></li>
							<li class="active"><a href="./ExplorationBD.php">Exploration BD</a></li>
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

				</div>
			</nav>
	




<link rel="stylesheet" href="../css/bootstrap.min.css" />
<link rel="stylesheet" href="../css/MyStylesheet.css" />
<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
		
				
			<div class="menu" >
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
						<strong><FONT size="9">Enzyme Classification</strong></FONT>
	</div>
	
	
	<center><table border="1" width="1000" id="ini">
		<tr>
			<td style="background-color:#F0F8FF;"><strong>Class</strong></td>
			<td style="background-color:#F0F8FF;"><strong>Definition</strong></td>
			<td style="background-color:#F0F8FF;"><strong>Typical reaction</strong></td>
		</tr>
		<tr>
			<td>EC1 Oxidoreductase</td>
			<td> To catalyze oxidation/reduction reactions; transfer of H and O atoms or electrons from one substance to another </td>
			<td>AH + B → A + BH (reduced) / A + O → AO (oxidized)</td>
		</tr>
		<tr>
			<td>EC2 Transferases</td>
			<td>transfer of functionnal groups from one substance to another</td>
			<td>AB + C → A + BC</td>
		</tr>
		<tr>
			<td>EC3 Hydrolases</td>
			<td>Formation of two products from a substrate by hydrolysis</td>
			<td>AB + H2O → AOH + BH</td>
		</tr>
		<tr>
			<td>EC4 Lyases</td>
			<td>Non-hydrolytic addition or removal of groups from substrates. C-C, C-N, C-O or C-S bonds may be cleaved</td>
			<td>RCOCOOH → RCOH + CO2 or [X-A+B-Y] → [A=B + X-Y]</td>
		</tr>
		<tr>
			<td>EC5 Isomerases</td>
			<td>Intramolecule rearrangement, i.e. isomerization changes within a single molecule</td>
			<td> ABC → BCA</td>
		</tr>
		<tr>
			<td>EC6 Ligases</td>
			<td>Join together two molecules by synthesis of new C-O, C-S, C-N or C-C bonds with simultaneous breakdown of ATP</td>
			<td>X + Y + ATP → XY + ADP + Pi</td>
		</tr>
	</table></center>source : wikipedia<br><br>
	<head>
		<title>ChartJS - Doughnut</title>
		<script type="text/javascript" src="../js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript" src="../js/Chart.js"></script>
		<script type="text/javascript" src="../js/classi.js"></script>
	</head>
	<FONT size="4">The repartition of the enzymes of the db in Enzyme Classification : </FONT><br><br>
	<body><center>
		<canvas id="mycanvas" width="256" height="256"></canvas>
		
	</body>
	</center>
	<br>
	
		<div id="section1">
						<ul style="list-style-type:none;">
							<center>
							<li class="faq-question" style="width:250px;background-color: #6495ED;"> 1. Oxidorectuctases</li>
							<li class="faq-answer">
								<center><table border="1" width="1000" id="ma_table">
								<?php
								$requete=Excecuter($bd,"SELECT Comments.num_EC,Enzyme.accepted_name,group_concat(distinct Comments.comment) AS commenta FROM Enzyme,Comments WHERE Enzyme.num_EC=Comments.num_EC AND Enzyme.num_EC LIKE 'EC 1%'GROUP BY Comments.num_EC"); 
								while($data =$requete->fetch(PDO::FETCH_ASSOC)){
									?><tr>
										<td><a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"><?php echo $data['num_EC'];?></a></td>
										<td><?php echo $data['accepted_name']; ?> </td>
										<td><?php echo $data['commenta']; ?></td>
									</tr>
									<?php } ?>
								</table></center>
							</li>

							<li class="faq-question" style="width:250px;background-color: #90EE90;"> 2. Transferases</li>
							<li class="faq-answer">
								<center><table border="1" width="1000" id="ma_table2">
								<?php
								$requete=Excecuter($bd,"SELECT Comments.num_EC,Enzyme.accepted_name,group_concat(distinct Comments.comment) AS commenta FROM Enzyme,Comments WHERE Enzyme.num_EC=Comments.num_EC AND Enzyme.num_EC LIKE 'EC 2%'GROUP BY Comments.num_EC"); 
								while($data =$requete->fetch(PDO::FETCH_ASSOC)){
									?><tr>
										<td><a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"><?php echo $data['num_EC'];?></a></td>
									 	<td><?php echo $data['accepted_name']; ?> </td>
									  	<td><?php echo $data['commenta']; ?></td>
									</tr>
								<?php } ?>
								</table></center>
							</li>

							<li class="faq-question" style="width:250px;background-color: #FFA500;"> 3. Hydrolases</li>
							<li class="faq-answer">
								<center><table border="1" width="1000" id="ma_table3">
									<?php
									$requete=Excecuter($bd,"SELECT Comments.num_EC,Enzyme.accepted_name,group_concat(distinct Comments.comment) AS commenta FROM Enzyme,Comments WHERE Enzyme.num_EC=Comments.num_EC AND Enzyme.num_EC LIKE 'EC 3%'GROUP BY Comments.num_EC"); 
									while($data =$requete->fetch(PDO::FETCH_ASSOC)){
										?><tr>
											<td><a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"><?php echo $data['num_EC'];?></a></td>
											<td><?php echo $data['accepted_name']; ?> </td>
											 <td><?php echo $data['commenta']; ?></td>
										</tr>
								<?php } ?>	
								</table></center>
							</li>

							<li class="faq-question" style="width:250px;background-color: #FFC0CB;"> 4. Lyases</li>
							<li class="faq-answer">
								<center><table border="1" width="1000" id="ma_table4">
								<?php
								$requete=Excecuter($bd,"SELECT Comments.num_EC,Enzyme.accepted_name,group_concat(distinct Comments.comment) AS commenta FROM Enzyme,Comments WHERE Enzyme.num_EC=Comments.num_EC AND Enzyme.num_EC LIKE 'EC 4%'GROUP BY Comments.num_EC"); 
								while($data =$requete->fetch(PDO::FETCH_ASSOC)){
									?><tr>
										<td><a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"><?php echo $data['num_EC'];?></a></td>
										<td><?php echo $data['accepted_name']; ?> </td>
										 <td><?php echo $data['commenta']; ?></td>
									</tr>
								<?php }?>	
								</table></center>
							</li>

							<li class="faq-question" style="width:250px;background-color: #FFFF00;"> 5. Isomerases</li>
							<li class="faq-answer">
									<center><table border="1" width="1000" id="ma_table5">
									<?php
										$requete=Excecuter($bd,"SELECT Comments.num_EC,Enzyme.accepted_name,group_concat(distinct Comments.comment) AS commenta FROM Enzyme,Comments WHERE Enzyme.num_EC=Comments.num_EC AND Enzyme.num_EC LIKE 'EC 5%'GROUP BY Comments.num_EC"); 
										while($data =$requete->fetch(PDO::FETCH_ASSOC)){
											?><tr>
												<td><a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"><?php echo $data['num_EC'];?></a></td>
												<td><?php echo $data['accepted_name']; ?> </td>
												 <td><?php echo $data['commenta']; ?></td>
												</tr>
											<?php } ?>
									</table></center>
							</li>

							<li class="faq-question" style="width:250px;background-color: #008000;"> 6. Ligases </li>
							<li class="faq-answer">

								<center><table border="1" width="1000" id="ma_table6">
						
								<?php
									$requete=Excecuter($bd,"SELECT Comments.num_EC,Enzyme.accepted_name,group_concat(distinct Comments.comment) AS commenta FROM Enzyme,Comments WHERE Enzyme.num_EC=Comments.num_EC AND Enzyme.num_EC LIKE 'EC 6%'GROUP BY Comments.num_EC"); 
									while($data =$requete->fetch(PDO::FETCH_ASSOC)){
										?><tr>
											<td><a href="fiche1.php?val=<?php echo $data['num_EC']; ?> &type=EC"><?php echo $data['num_EC'];?></a></td>
											<td><?php echo $data['accepted_name']; ?> </td>
											 <td><?php echo $data['commenta']; ?></td>
											</tr>
										<?php } ?>
								</table></center>
							</li>
							</center>
						</ul>
		</div>
		
		<br>
	
	<a href="comparaison.php"><input type="BUTTON" value="Comparaison of the enzyme function on different spiecies" style="width:600px; height:50px;background-color: #FFFFFF; color: #000000;font-size : 20px;" /></a>
	
	</div>
	
	</div>
	
	<script>
				$(document).ready(function(){
					$('li.faq-answer').hide();
					$('li.faq-question').click(function () {
						$(this).next().slideToggle();
					});
				});
				

	</script>
	
										

						
				
										
		


