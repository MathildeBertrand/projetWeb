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
			var numCom=3;
			$(document).ready(function(){	
				$('#show').click(function(){
					numCom=numCom+2;
					$('#comments').load('./showCom.php',{
						postnumCom:numCom
					});
				});

				$('#submit').click(function(){
					var user = location.search.split('user=')[1];
					var input=$('#inputcomment').val();
					$.ajax({
						url: "submitComments.php",
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
							numCom=numCom+1;
						}
					});
				});
			});
		</script>
	</head>
	
	<body>
		<nav class="navbar navbar-default">
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
							echo "<a href='../includes/logout.inc.php'><img class='icon-logout' src='../img/logout.png'/></a>
									<li><a href='./myAccount.php'>Customer Area</a></li>";
						  }else{
							  echo "<img src='../img/user1.png'  width='35'/>
									<li><a href='../page/login.php'> Log in</a></li>";
						  }
						?>
							
						</ul>
					</div>
					
				</div>
			</nav>

			<div class="jumbotron jumbotron-fluid" style="padding-bottom: 10px; padding-top: 10px; background: url('../img/adn.jpg') no-repeat center fixed; background-size:cover;">
				<div class="container">
					<div class="col-sm-1 col-md-2 col-lg-4" >
						<img class="portrait" src="../img/smiley.jpeg" height="200" width="150"/>
					</div>
					<div class="col-sm-2 col-md-6 col-lg-8"> 
						<div class="row" style="padding-top:25px;">
								 <blockquote>
									<p>
										<?php echo $_SESSION['nom']." ".$_SESSION['prenom']?>
									</p>
								</blockquote>
								
								<i class="glyphicon glyphicon-envelope"></i> Mail: <?php echo $_SESSION['mail']?>
								<br><i class="glyphicon glyphicon-briefcase"></i> Job: <?php echo $_SESSION['job']?>
						
						</div>
					</div>
				</div>
			</div>
			

			<div class="container">
				<div class="row">
					
					<div class="col-sm-1 col-md-2 col-lg-4" >

						<div id="comments" style="overflow: auto; width:600px; height:200px;">
							<?php
								$mail=$_SESSION['mail'];
								$mailName=explode('.',$mail)[0];
								$mailName=explode('@',$mailName)[0].explode('@',$mailName)[1];
								$sql="SELECT nom,prenom,comments FROM Users,ClientComments WHERE Users.mail=ClientComments.mail AND forwho='$mailName' ORDER BY ClientComments.id DESC LIMIT 3;";
								$result = $bd->prepare($sql); 
								$result->execute();
								$row_count =$result->rowCount();
								if	($row_count > 0){ 
									while ($row = $result->fetch(PDO::FETCH_ASSOC)){
										$name=$row['nom']." ".$row['prenom'];
										echo "<p><div class='name'>$name<br></div>";
										echo $row['comments'];
										echo "</p>";
									}
								}else{
									echo "There is no comments";
								}
							?>
						</div>

						<input name="inputcomment" id="inputcomment" class="comments" placeholder="here your comments"/>

						<button type="button" id="show" name="show">Show more comments</button>
						<button type="submit" id="submit" name="submit">Submit</button>

					</div>
					
					<div class="recentRes">
						Here are your recent searches on our website:<br>
						<?php
							$recentRes=array();
							$type=array();
							$mail=$_SESSION['mail'];
							$response=$bd->query("SELECT * FROM History WHERE mail='$mail'");
							while($data =$response->fetch()){
								for ($i=3;$i<count($data);$i++){
									$element=trim($data[$i]);
									if($element != ''){
										if (! in_array($element,$recentRes)){;
											array_push($recentRes,$element);
											array_push($type,$data[2]);
										}
									}
								}
							}

							for ($i=0;$i<count($recentRes);$i++){
								if (trim($type[$i])=="EC"){
									$substr=substr($recentRes[$i],3);
								}else{
									$substr=$recentRes[$i];
								}
								echo "<a href='./fiche1.php?val=$substr&type=$type[$i]'>$recentRes[$i]</a>; ";
							}
						?>
					</div>
				
				
					<div class="trendingRes">
						Here are the most popular searches on our website:<br>
						<?php
							$recentRes=array();
							$type=array();
							$mail=$_SESSION['mail'];
							$response=$bd->query("SELECT * FROM History;");
							while($data =$response->fetch()){
								for ($i=3;$i<count($data);$i++){
									$element=trim($data[$i]);
									if($element != ''){
										if (! in_array($element,$recentRes)){;
											array_push($recentRes,$element);
											array_push($type,$data[2]);
										}
									}
								}
							}

							for ($i=0;$i<count($recentRes);$i++){
								if (trim($type[$i])=="EC"){
									$substr=substr($recentRes[$i],3);
								}else{
									$substr=$recentRes[$i];
								}
								echo "<a href='./fiche1.php?val=$substr&type=$type[$i]'>$recentRes[$i]</a>; ";
							}
						?>
					
					</div>
					
					<div class="favori">
						Here are your favorites:<br>
						<?php
				
							
							//~ $mail=$_SESSION['mail'];
							//~ $response=$bd->query("SELECT * FROM Favori WHERE mail='$mail';");
							//~ while($data =$response->fetch()){
									
									//~ if(trim($data[1])!= ''){
										//~ $element=trim($data[1]);
									//~ }
								
							//~ }


								//~ if ($element=="EC"){
									//~ $substr=substr($element,3);
								//~ }else{
									//~ $substr=$element;
								//~ }
								//~ echo "<a href='./fiche1.php?val=$substr&type=$type[$i]'>$recentRes[$i]</a>; ";
							//~ }
						?>
					
					</div>
					

					
				</div>	
			</div>

	
	</body>
</html>
	

