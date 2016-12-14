<?php 
require_once("header.php");
require_once("csrf.php");

if($_POST){
	echo "Downloading videos";
	$links = explode("\n",$_POST["links"]);
	if(count($links)>0){
		echo "<table border=1>";
		foreach($links as $link){
			if(empty($link))
				continue;
			
			$newcsrf=newcsrf();
			echo "<tr class='linkrow'><td style='display:none;' class='linkcsrf'>$newcsrf</td><td class='linkitem'>$link</td><td><a class='linkstatus' href=''>Ready</a></td></tr>";
		}
		echo "</table>";
		echo "<script>startbatchdownload();</script>";
	}
	else
		echo "no link entered";
}
else{
?>
<body>

<br>
<form method="post">
Enter your youtube links:
<textarea name="links" cols="60" rows="10"></textarea>
<br>
<input class="btn btn-success" type="submit" value="Download">
</form>
<?php } ?>
</body>
</html>