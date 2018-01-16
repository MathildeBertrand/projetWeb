<?php
session_start();
include_once '../includes/dbh.inc.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> My Account </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
		<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
		<script>
			var numCom=5;
			$(document).ready(function(){	
				$('#show').click(function(){
					numCom=numCom+2;
					$('#comments').load('./showknowledge.php',{
						postnumCom:numCom,
					});
				});

				$('#submit').click(function(){
					var user = location.search.split('user=')[1];
					var input=$('#inputcomment').val();
					$.ajax({
						url: "submitKnowledge.php",
						type: "POST",
						async: false,
						data:{
							"done":1,
							"inputcomment": input,
							"user": user
						},
						success: function(data){
							$("#inputcomment").val('');
							$("#comments").prepend(data);
							//~ numCom=numCom+1;
						}
					});
				});
				
				//~ $("#submitFile").on("click",(function(e) {
					//~ e.preventDefault();
					//~ var form = $("#myForm");
					//~ $.ajax({
						//~ url: '../includes/upload.inc.php',
						//~ type: "POST",
						//~ data: new FormData(form[0]),
						//~ processData: false,  // tell jQuery not to process the data
						//~ contentType: false,  // tell jQuery not to set contentType
						//~ success: function(data){
							//~ alert(data);
						//~ }
					//~ });
				
				//~ }));
				
			});
		</script>
	</head>
	
	<body class="share_bg">
		<nav class="navbar navbar-default" style="margin-bottom:10px;">
				<div class="container-fluid">

					<!-- website name -->
					<div class="navbar-header">
						<a href="#" class="navbar-brand">ENZyclopédia</a>
					</div>
				
					<!-- Menu items -->
					<div>
						<ul class="nav navbar-nav">
							<li><a href="../index.php">Home</a></li>
							<li><a href="./aboutUs.php">About us</a></li>
							<li><a href="./ExplorationBD.php">Exploration BD</a></li>
							<li><a href="./faq.php">FAQ</a></li>
							<li><a href="./contact.php">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
							<?php
						if (isset($_SESSION['mail'])){
							$mail=$_SESSION['mail'];
							$sql="SELECT id FROM Users WHERE mail='$mail';";
							$result = $bd->prepare($sql); 
							$result->execute();
							while ($row = $result->fetch(PDO::FETCH_ASSOC)){
								$id=$row['id'];
							}
							echo "<a href='../includes/logout.inc.php'><img class='icon-logout' src='../img/logout.png'/></a>
									<li><a href=./myAccount.php?user=$id>Customer Area</a></li>";
						  }else{
							  header('location: ./login.php?=expiration');
						  }
						?>
							
						</ul>
					</div>
					
				</div>
			</nav>

			
			

			<div class="container">
				<div class="row">
					

						<div id="comments" style="overflow: auto; width:1150px; height:450px;">
							<?php
								$sql="SELECT nom,prenom,knowledge,time FROM Users,shareKnowledge WHERE Users.mail=shareKnowledge.mail ORDER BY shareKnowledge.id DESC LIMIT 5;";
								$result = $bd->prepare($sql); 
								$result->execute();
								$row_count =$result->rowCount();
								if	($row_count > 0){ 
									while ($row = $result->fetch(PDO::FETCH_ASSOC)){
										$name=$row['nom']." ".$row['prenom']."\t".$row['time'];
										
										echo "<div class='panel panel-default'>";
										echo "<div class='panel-heading'><STRONG>$name</STRONG></div>";
										echo "<div class='panel-body'>";
										echo $row['knowledge'];
										echo "</div></div>";
									}
								}else{
									echo "There is no comments";
								}
							?>
						</div>

						<textarea name="inputcomment" id="inputcomment" class="text_area" placeholder="Here to share what you know"></textarea>

						<button type="button" id="show" name="show">Show more information</button>
						<button type="submit" id="submit" name="submit">Submit</button>

					

<!--
					<div>
						<form id="myForm" method="post" action="" enctype="multipart/form-data">

							 <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br />

							 <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />

							 <input type="file" name="mon_fichier" id="mon_fichier" required/><br />

							 <input id="submitFile" type="submit" name="submit" value="Envoyer" />

						</form>
					</div>
-->

					

					
				</div>	
			</div>

	
	</body>
</html>
	

