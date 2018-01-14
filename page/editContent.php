<?php session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> My Count </title>
		<link rel="stylesheet" href="../css/bootstrap.min.css" />
		<link rel="stylesheet" href="../css/MyStylesheet.css" />
<!--
		<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
-->
		<script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
		<script type="text/javascript" src="../js/FileSaver.min.js"></script>
		<script type="text/javascript" src="../js/bootstrap.js"></script>
		<script src="../js/jquery-2.1.4.min.js" type="text/javascript"></script>
	</head>
	
  <body>
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
							<li><a href="./contact.html">Contact</a></li>
						</ul>	
						<ul class="nav navbar-nav navbar-right">
							<img src="../img/user1.png"  width="35"/>
							<li><a href="../includes/logout.inc.php"> Log out</a></li>
							
						</ul>
					</div>
					
				</div>
			</nav>

		<Form >	


		<textarea name="content" id="content"></textarea>
		

			<button type="submit" id="save" name="save">Save</button>
			<button type="submit" id="download" name="download">Download</button>
			<button type="submit" id="share" name="share">Share</button>



		

			
<!--
		<div id="autosave"></div>
-->
		
		<script>
			
			CKEDITOR.plugins.addExternal( 'save', 'ckeditor/plugins/save/', 'plugin.js' );
			 var instances=CKEDITOR.replace( 'content',{ customConfig: '/ckeditor/custom_config.js'} );
			 var data = CKEDITOR.instances.content.getData();
			
			//~ CKEDITOR.plugins.addExternal( 'save', '../save', 'plugin.js' );
		 
		 		 $(document).ready(function(){
					 //~ CKEDITOR.replace( 'content');
					 //~ var textarea = document.body.appendChild( document.createElement( 'textarea' ) );
				//~ var ckEditor=CKEDITOR.replace( textarea );
			 //~ var txt=encodeURIComponent(ckEditor.getData());
			 $('save').click(function (){
				   $.ajax({
							 data: {content:data},
							 type: "post",
							 url: "../includes/saveFile.inc.php",
							 success: function(data){
								  alert("Data Save: " + data);
							 }
					});
				});
				});
		</script>
		
		</Form>
		
		<script type="text/javascript">

				 //~ open('../includes/saveFile.inc.php?editor='+txt,'_self');
			 //~ });
				 //~ $.ajax({
					//~ method:"POST",
					//~ data:{postData:data},
					//~ dataType:"text",
					//~ url:'../includes/saveFile.inc.php',
					//~ success:function(data) {
						//~ alert("saved");
						//~ }
				//~ });
			//~ }
			 //~ function autosave(){ 
				 //~ var data = CKEDITOR.instances.editor.getData();
				 //~ var data=document.getElementById('editor');
				 //~ $.ajax({
					//~ method:"POST",
					//~ data:{postData:data},
					//~ dataType:"text",
					//~ url:'../includes/saveFile.inc.php',
					//~ success:function(data) {
						  //~ if(data!=''){
							  //~ alert(data);
							  //~ $('#autosave').text("Post save as draft");
							  //~ setInterval(function(){$('#autosave').text('');},2000);
						   //~ }
					//~ }
				  //~ });
			  //~ }
		  
		  //~ setInterval(function(){autosave();},1000);
		  //~ });
		  
		 
		 
		//~ let theEditor;
			
		//~ ClassicEditor
			//~ .create( document.querySelector( '#editor' ) )
			//~ .then( editor => {
				//~ console.log( editor );
			//~ } )
			//~ .catch( error => {
				//~ console.error( error );
		//~ } );
		
		//~ function save(output){
			//~ var content=theEditor.getData();
			//~ var blob= new Blob([content],{type:"type/plain;charset=utf-8"});
			//~ saveAs(blob, output);
		//~ });
		</script>

		

    
  </body>
</html>
