<?php

function upload($index,$destination,$maxsize=FALSE,$extensions=FALSE)

{

   //Test1: fichier correctement uploadé

     if (!isset($_FILES[$index]) OR $_FILES[$index]['error'] > 0) return FALSE;

   //~ //Test2: taille limite

     //~ if ($maxsize !== FALSE AND $_FILES[$index]['size'] > $maxsize) return FALSE;

   //~ //Test3: extension

     //~ $ext = substr(strrchr($_FILES[$index]['name'],'.'),1);

     //~ if ($extensions !== FALSE AND !in_array($ext,$extensions)) return FALSE;

   //Déplacement

     return move_uploaded_file($_FILES[$index]['tmp_name'],$destination);

}

 

//EXEMPLES

  //~ $upload1 = upload($_POST['icone'],'../users_uploads/files/monicone1' );

  $upload2 = upload($_POST['mon_fichier'],'../img/users_uploads/files/file112' );

 

  //~ if ($upload1) "Upload de l'icone réussi!<br />";

  if ($upload2) "Upload du fichier réussi!<br />";

?>
