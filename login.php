<SCRIPT type='text/javascript'>
										
/*Fonction verifier formulaire*/
/*Si le champ text nest pas remplis alors on ne pourra pas cliquer sur le bouton search */
function verifForm()
{
if(document.getElementById('username').value =='')
{
	document.getElementById('bouton').disabled=false;
	}else{
	document.getElementById('bouton').disabled=true;
	open('EspaceClient.php?id='+document.getElementById('username').value+' &ps='+ document.getElementById('password').value,'_self');
	}
}
															
</script>

<?php
require("functions.php");
$AFF=FALSE; 

///////////////////////////////////////////////////////////////////////////////
//Mise en page pour la connection login////////////////////////////////////////
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
	
	fond();
?>

			</nav>
					<div class="container">
								<div class="jumbotron1">
									<h1><center><img src="UI/img/atomix_user31.png"  width="150"/></center></h1>
									
									<form>
										<div class="form_input">
											<FONT color="#00000"><p><center><input type="text" name="username" id="username" placeholder="Enter your User Name" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></center></p></FONT>
										</div>
										
										<div class="form_input">
											<FONT color="#00000"><p><center><input type="text" name="password"  id="password" placeholder="Enter your Password" style="background-image:url(UI/img/user1.png);background-position:left;background-repeat:no-repeat;padding-left:18px;width:185px;"/></center></p></FONT>
										</div>
										
											<FONT color="#00000"><p><center><input type="BUTTON" id="bouton" name="BUTTON"  value="LOGIN" class="btn-login" onchange="verifForm();" OnClick="verifForm();"/></FONT>
											<a href="fichenew.php"><FONT color="#00000"><input type="BUTTON" name="submit"  value="New User ?"/></center></p></FONT></a>
									</form>
								</div>
					</div>
				
				
	
	</html>



