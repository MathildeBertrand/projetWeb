<?php
session_start();
?>

<html>
<head>
	<meta charset="utf-8">
	<title> Profil </title>
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/MyStylesheet.css" />
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
							<img src="../img/user1.png"  width="35"/>
							<li><a href="./login.php"> Log out</a></li>
							
						</ul>
					</div>
					
				</div>
	</nav>
			
	<div class="jumbotron jumbotron-fluid" style="background:none;">
		<div class="row" >
			<?php 
			if ($_SESSION['img']!=NULL){
				$img="../img/".$_SESSION['img'];
				echo $img;
			}else{
				$img="../img/user1.png";
			}
			?>
			<div class="col-sm-1 col-md-2 col-lg-4" style="padding-right:100px;">	
				<center><img src"<?php echo $img;?>" height="200" width="200"/></center>
				<form action="../includes/upload.inc.php" method="POST" enctype="multipart/form-data">
					<input type="file" name="file">
					<center><button class="btn btn-primary" name="submit" type="submit" style="margin-top:50px;">Upload profil image</button></center>
				</form>
			</div>
			            
			<div class="col-sm-2 col-md-6 col-lg-8">
				 <blockquote>
					<p><?php echo $_SESSION['prenom']." ".$_SESSION['nom']?></p> <small><cite title="Source Title">Gotham, United Kingdom  <i class="glyphicon glyphicon-map-marker"></i></cite></small>
				</blockquote>
				<p>  <br/> <i class="glyphicon glyphicon-envelope"></i> Mail: <?php echo $_SESSION['mail']?>
					<br/>  <br/> <i class="glyphicon glyphicon-briefcase"></i> Job: <?php echo $_SESSION['job']?>
					<br/> <br/> <i class="glyphicon glyphicon-home"></i> Institute: none
					<br/> <br/> <i class="glyphicon glyphicon-earphone"></i> Tel: none
					<br/>  <br/> <i class="glyphicon glyphicon-globe"></i> Personal Website: none
					<br/> <br/> <i class="glyphicon glyphicon-gift"></i> Birthday: none
				</p>		
			</div>
			
		</div>
	</div>

</body>
</html>
