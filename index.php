<?php require_once("csrf.php"); ?>
<html>
   <head>
      <script src="js/jquery-3.1.1.min.js" ></script>
      <script src="js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <title>100% free youtube downloader</title>
      <script>
		$(document).ready(function (){
			$( "#mainform" ).submit(function( event ) {
				event.preventDefault();
				
				var link = $("#txtlink").val();
				var csrf = $("#csrf").val();

				$("#mainform").hide();
				$("#infoprogressbar").show();
				
				$.post( "backend.php", {'act':'getinfo','link':link,'csrf':csrf })
				.done(function( data ) {
				  $("#infodiv").html(data);
				  $("#infoprogressbar").hide();
				  $("#infodiv").show();

				});
				
			});
			

		});
		
	
		function downloadvideo(){
			$("#downloadprogressbar").show();
			
			var link = $("#txtlink").val();
			var csrf = $("#csrf").val();
			var filename = $("#filename").val();
			
			$.post( "backend.php", {'act':'download','link':link,'csrf':csrf,'filename':filename})
			.done(function( data ) {
			  $("#downloadprogressbar").hide();
			  
			  
			  if(data == 0){
				alert("Error in downloading video.");
			  
			  }
			  else
			  {
			    //redirect to downloaded address
				window.location.href = data;
			  }
				

			});
		}
      </script>
   </head>
   <body>
      <div class="container">
         <div class="row" style="height:70px;"></div>
         <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-6">
               <img src="img/logo.jpg" />
            </div>
         </div>
         <form id="mainform" action="fake.php">
            <div class="row">
               <div class="col-md-12">
                  <input id="txtlink" type="text" class="form-control" value="https://www.youtube.com/watch?v=fkkDvKGcNSo" placeholder="ex:https://www.youtube.com/watch?v=fkkDvKGcNSo" />
               </div>
            </div>
            <input type="hidden" id="csrf" value="<?php echo newcsrf(); ?>" />
            <div class="row">
               <div class="col-md-12">
                  <center><input type="submit" class="btn btn-primary" value="Download" /></center>
               </div>
            </div>
         </form>
		 
		<div id="downloadprogressbar" class="progress" style="display:none">
		  <div class="progress-bar progress-bar-striped active" role="progressbar"
		  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
			Downloading video,please wait...
		  </div>
		</div>
		
         <div id="infodiv" style="display:none;">
			
         </div>
		 
		<div id="infoprogressbar" class="progress" style="display:none">
		  <div class="progress-bar progress-bar-striped active" role="progressbar"
		  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
			Getting video information....
		  </div>
		</div>
		
		
	<div class="row">&nbsp;</div>
	<div class="row">&nbsp;</div>
	<div class="row">&nbsp;</div>
	
	  <div class="row">
		<div class="col-md-12">
		<center>Written by <a href="http://github.com/mhsenpc">mhsenpc</a> 2016</center>
		</div>
	  </div>
	  
      </div>
   </body>
</html>