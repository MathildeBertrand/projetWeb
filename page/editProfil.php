<?php
session_start();
include ('../includes/dbh.inc.php');
?>

<html>
<head>
	<meta charset="utf-8">
	<title> Profil </title>
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/MyStylesheet.css" />
	<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script>
	$(document).ready(function(){	
		$("#uploadimage").on('change',(function(e) {
			e.preventDefault();
			$.ajax({
				url: '../includes/upload.inc.php',
				type: "POST",
				data: new FormData(this),
				contentType: false,
				processData: false,
				cache: false,
				success: function(data){
					$("#profil_image").html(data);
				}
			});	
		}));
		
		 $('#update').click(function() {

			 $.ajax({
			  type: "POST",
			  url: '../includes/updateInfo.inc.php',
			  data: {institute: $("#Institute").val(), job: $("#Job").val(), tel: $("#Tel").val(), birthday: $("#Birthday").val() }
			}).done(function( msg ) {
			  window.location.href='./myAccount.php?user='+msg;
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
								$mail=$_SESSION['mail'];
								$sql="SELECT * FROM Users WHERE mail='$mail';";
								$result=$bd->query($sql);
								while ($row=$result->fetch()){
									$id=$row['id'];
								}
								echo "<li><a href=./myAccount.php?user=$id>Customer Area</a></li>
								<a href='../includes/logout.inc.php'><img class='icon-logout' src='../img/logout.png'/></a>";
							}else{
								echo "<li><a href='./myAccount.php?user=expire'>Customer Area</a></li>
								<a href='../includes/logout.inc.php'><img class='icon-logout' src='../img/logout.png'/></a>";
							}?>
							
							
						</ul>
					</div>
					
				</div>
	</nav>
			
	<div class="jumbotron jumbotron-fluid" style="background:none;">
		<div class="row" >
			<?php 

			?>
			<div class="col-sm-1 col-md-2 col-lg-4" style="padding-right:100px; padding-left:20px;">	
				
				<center><div id="profil_image">
				<?php
				 if (isset($_SESSION['img'])){
					 $img=$_SESSION['img'];
					 echo '<img id="profil_image" src="'.$img.'" />';
				}else{
					 echo "<img id='profil_image' src='../img/index.png' />";
				}
				?>				
				</div>
				
				<form id="uploadimage" action="" method="POST" enctype="multipart/form-data">
					<input type="file" name="file" required/>
<!--
					<input type="submit" value="submit" id="submit" class="submit"/>
<!--
					<center><button class="btn btn-primary" id="submit" name="submit" type="submit" style="margin-top:50px;">Upload profil image</button></center>
-->

				
				</form>
			</div></center>
			           
			<div class="col-sm-2 col-md-6 col-lg-8">
				 <blockquote>
					<p><?php echo $_SESSION['prenom']." ".$_SESSION['nom']?></p> <small><cite title="Source Title">Gotham, United Kingdom  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
				</blockquote>
				<p>  <br/> <i class="glyphicon glyphicon-envelope"></i> Mail: <?php echo $_SESSION['mail']?>
					<br/>  <br/> <i class="glyphicon glyphicon-briefcase"></i> Job: <input name="Job" id="Job" value=<?php echo $_SESSION['job']?>>
					<br/> <br/> <i class="glyphicon glyphicon-home"></i> Institute: <input name="Institute" id="Institute" placeholder="none">
					<br/> <br/> <i class="glyphicon glyphicon-earphone"></i> Tel: <input name="Tel" id="Tel" placeholder="none"/>
					<br/> <br/> <i class="glyphicon glyphicon-gift"></i> Birthday: <input name="Institute" id="Institute" placeholder="none"/>
					<br/> <br/> <button id="update">update</button>
				</p>		
			</div>
			
			
			
		</div>
	</div>

</body>
</html>
