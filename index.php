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
<a href="https://github.com/mhsenpc/youtube-dl-php"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/365986a132ccd6a44c23a9169022c0b5c890c387/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f7265645f6161303030302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_red_aa0000.png"></a>


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
		<center>Files will be stored for 24 hours only because of storage limits.</center>
		</div>
	  </div>
	  
	  <div class="row">
		<div class="col-md-12">
		<center>Written by <a href="http://github.com/mhsenpc">mhsenpc</a> 2016</center>
		</div>
	  </div>
		
     </div>
	 
   </body>
</html>