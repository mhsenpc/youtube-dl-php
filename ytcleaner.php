<?php
$list = file_get_contents("files.txt");
$list = json_decode($list);
$duration = 60 * 60 ; //1 hour
$duration = $duration * 24; //1 day
foreach($list as $key=>$item){
	if(time() - $item[1] >= $duration ){
		$filepath = __DIR__."/files/".$item[0];
		if(file_exists($filepath))
			unlink($filepath);
		
		
		echo $item[0]." removed  \n";
		unset($list[$key]);
	}	
}

file_put_contents("files.txt",json_encode($list));
echo "done";