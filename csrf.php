<?php
$csrf_file_name = __DIR__ . "/csrf.txt";

function isvalidcsrf($csrf){
		global $csrf_file_name;
		$t = exec("cat $csrf_file_name|grep $csrf");
		if(empty($t))
			return false;
		else
			return true;
}


function newcsrf(){
	global $csrf_file_name;
	$t = md5(time() * rand(1,100));
	file_put_contents($csrf_file_name,$t."\n",FILE_APPEND);
	return $t;
}

function expirecsrf($csrf){
	global $csrf_file_name;
	$contents = file_get_contents($csrf_file_name);
	$contents = str_replace($csrf, '', $contents);
	file_put_contents($csrf_file_name, $contents);
}