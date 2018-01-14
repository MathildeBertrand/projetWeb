<html>
<head>
	<meta charset="utf-8">
	<title> Profil </title>
	<link rel="stylesheet" href="../css/bootstrap.min.css" />
	<link rel="stylesheet" href="../css/MyStylesheet.css" />
	<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
	<script>
	$(document).ready(function(){	
		$("#submit").on("click",(function(e) {
			e.preventDefault();
			var form = $("#myForm");
			$.ajax({
				url: '../includes/upload.inc.php',
				type: "POST",
				data: new FormData(form[0]),
				processData: false,  // tell jQuery not to process the data
				contentType: false,  // tell jQuery not to set contentType
				success: function(data){
					alert(data);
				}
			});
				
		}));
	});
	</script>
</head>

<form id="myForm" method="post" action="" enctype="multipart/form-data">

     <label for="mon_fichier">Fichier (tous formats | max. 1 Mo) :</label><br />

     <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />

     <input type="file" name="mon_fichier" id="mon_fichier" /><br />

     <input id="submit" type="submit" name="submit" value="Envoyer" />

</form>
