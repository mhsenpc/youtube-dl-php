<?php
require_once("csrf.php");
$act = $_POST["act"];
$csrf = $_POST["csrf"];
$link = $_POST["link"];
switch($act){
	case "getinfo":
		if(isvalidcsrf($csrf)){
			$info = getinfo($link);
			if(empty($info->title)){?>
				<div class="alert alert-warning">
					<strong>Error!</strong> Your links seems invalid.
				</div>

			
			<?php 
			}
			else{
				
			?>
		
			<div class="row">
				<div class="col-md-6">
				  <div class="row">
					   <div class="col-md-12" id="video_title"><?=$info->title;?></div>
					</div>
					<div class="row">
					   <div class="col-md-12" id="video_duration"><?=$info->duration;?></div>
					</div>
					<div class="row">&nbsp;</div>
					
					

				</div>
			
				<div class="col-md-6">
					<img width=300 height=200 src="<?=$info->thumbnail;?>" id="video_thumbnail" />
				</div>
			</div>
			
  
			<input type="hidden" id="filename" value="<?=$info->filename;?>" />
			
			
			<script>downloadvideo();</script>
		
			<?php
			}//is valid video
		}//is valid csrf
		else
			echo "Invalid request.";
		break;
	case "download":
		if(isvalidcsrf($csrf)){
			expirecsrf($csrf);
			$filename = $_POST["filename"];
			addtodb($filename);
			if(file_exists(__DIR__."/files/$filename") || downloadvideo($link) ){
				echo "files/$filename";
			}
			else{
				echo "0";
			}
		}
		else{
			echo "Invalid request.";
		}
		break;
}



function getinfo($link){
	//$command = "youtube-dl --get-thumbnail --get-duration --get-filename --get-title --get-filename --proxy '192.168.88.245:7777'  $link";
	$command = "youtube-dl --get-thumbnail --get-duration --get-filename --get-title --get-filename $link";
	exec($command,$t);
	
	//some operations
	$info = new videoinfo();
	$info->link = $link;
	$info->title=$t[0];
	$info->duration =$t[3];
	$info->filename=$t[2];
	$info->thumbnail = $t[1];
	return $info;
}

function downloadvideo($link){
	$t = exec("cd ".__DIR__."/files;youtube-dl $link");
	if(strpos($t,"100.0%")!==false)
		return true;
	else
		return false;
}

class videoinfo{
	public $title;
	public $duration;
	public $thumbnail;
	public $filename;
	public $link;
	public $csrf;
}

function addtodb($filename){
	$fpath = "files.txt";
	$files = file_get_contents($fpath);
	$files = json_decode($files);
	$files[] = array("$filename",time());
	file_put_contents($fpath,json_encode($files));
}