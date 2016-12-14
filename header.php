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
		
		function startbatchdownload(){
			$('tr').each(function() {
				var $this = $(this);
				var link = $this.find(".linkitem").html();
				var csrf = $this.find(".linkcsrf").html();

				$.post( "backend.php", {'act':'getfilename','link':link,'csrf':csrf})
				.done(function( infodata ) {
				if(infodata=="0")
					$this.find("a").text("error in get filename");
				else
				{
					$this.find("a").html("Downloading...");
					$.post( "backend.php", {'act':'download','link':link,'csrf':csrf,'filename':infodata})
					.done(function( data ) {

					  if(data == 0){
						$this.find("a").text("Error when downloading");
					  }
					  else
					  {
						$this.find("a").attr("href",data);
						$this.find("a").html(infodata);
					  }
						

					});
				}
				
				});
			});

		}
				
		function makeid()
		{
			var text = "";
			var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

			for( var i=0; i < 5; i++ )
				text += possible.charAt(Math.floor(Math.random() * possible.length));

			return text;
		}
      </script>
   </head>