

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

//On met le fond decran
fond();


	$response=Excecuter($bd,"SELECT * FROM USERS WHERE mail='".$_GET['id']."'AND password='".$_GET['ps']."'");
	if($data =$response->fetch()){
		
		
			?><strong><FONT size="9">Welcome </strong>  <?php echo $data['nom']; echo " "; echo $data['prenom']; echo "!"; ?></FONT><br><br> <?php
			require_once("vote.html");
		}else{
				?>
				<center>
				<strong><FONT size="8">Wrong id or password !</FONT> </strong> <br>
				<strong><FONT size="8">Create a new account if you dont have one :</FONT></strong>
				<a href="fichenew.php"><FONT color="#00000"><input type="BUTTON" name="submit"  value="New Account"/></center></FONT></a>
				</div>
				</div>
				
				<?php
	}
	
?>	
