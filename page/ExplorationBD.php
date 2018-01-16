<?php session_start();?>

<?php
////////////////////////////////////////////////////////////////////////
//Exploration de la base de donnees///////////////////////////////////
//3 boutons : exploration des publis,des enzymes ou des maladies//////
//////////////////////////////////////////////////////////////////////		
?>
<!DOCTYPE html>
<!-- Mise en page -->
<html>
	<head>
		<meta charset="utf-8">
		<title> Exploration BD </title>
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
							<li class="active"><a href="#">Exploration BD</a></li>
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
			
	
		<div>
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-3 col-md-8 col-lg-12"></div>
						<div class="jumbotron1">
							<center><strong><FONT size="8">Exploration of the database</strong></FONT></center><br>
							<div class="col">
								<div class="col-sm-3 col-md-8 col-lg-12">
									<FORM>	
										<center><strong>
										<a href="bargraphMain.php"><input type="BUTTON" value="Statistics" style="width:300px; height:200px;background-color: #E0FFFF; color: #000000;font-size : 30px;border-radius: 10%;" /></a>
										<a href="allEnzyme.php"><input type="BUTTON" value="All enzymes" style="width:300px; height:200px;background-color: #F5FFFA; color: #000000;font-size : 30px;border-radius: 10%;"/></a> 
										<a href="allPubli.php"><input type="BUTTON" value="All publications" style="width:300px; height:200px;background-color: #E0FFFF; color: #000000;font-size : 30px;border-radius: 10%;"/></a> 
										<a href="classi.php"><input type="BUTTON" value="Classification" style="width:300px; height:200px;background-color: #F5FFFA; color: #000000;font-size : 30px;border-radius: 10%;"/></a> <br><br>
										</center></strong>
									
									</FORM>
									
			</ul>	
	</div>	

	</body>			
	
	
									

									
