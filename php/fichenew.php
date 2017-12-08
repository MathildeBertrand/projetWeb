<!-- Formulaire pour rentrer le nouveau user dans la bd -->

<?php
require("functions.php");
$AFF=FALSE; 

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
	
	//On definit le fond de base
	fond();
?>

	<!-- Et on rajoute ce dont on a besoins --> 
	</nav>
	<div class="container">
			<div class="jumbotron1">
			<form>
				
					<div class="form_input">
						<center>
							<strong><FONT size="9">Please create a new account</strong></FONT> <br><br>
							First Name *  :  <FONT color="#00000"><input type="text" name="Name" id="FirstName"  placeholder="Ex : Jean" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT> <br>
							Last Name * : <FONT color="#00000"><input type="text" name="Name" id="LastName" placeholder="Ex : Jean" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT> <br>
							mail *      : <FONT color="#00000"><input type="text" name="Name"  id ="mail" placeholder="Ex : Jean@gmail.com" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT><br>
							job *       : <FONT color="#00000"><input type="text" name="Name"  id="job" placeholder="Ex : biologist" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT><br>
							Password * : <FONT color="#00000"><input type="text" name="Name" id="ps" placeholder="Ex:num CB" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></FONT>
							<br>
							<a href="javascript:open('fichenew.php?FirstName='+document.getElementById('FirstName').value +' &LastName=' +document.getElementById('LastName').value +' &mail='+document.getElementById('mail').value+ ' &job='+document.getElementById('job').value + ' &ps='+document.getElementById('ps').value,'_self')"><input type="BUTTON" name="submit"  value="Submit"/></a>	
					</center>
				</div>
				</form>
	</div>
</div>

<?php
//Si lutilisateur a remplis le formulaire, alors on remplit la base de donnee
$requete=Excecuter2($bd,"INSERT INTO Users (mail,nom,prenom,password,job) VALUES('".$_GET['mail']."','".$_GET['LastName']."','".$_GET['FirstName']."','".$_GET['ps']."','".$_GET['job']."')");
?>

