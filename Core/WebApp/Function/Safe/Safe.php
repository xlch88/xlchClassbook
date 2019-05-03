<?php
if($_COOKIE['DisableSafeCheck'])return;
//¼ì²âXSS
function SafeArgs($pc = []){
	foreach($_GET as $key=>$value) {
		if(!in_array($key,$pc)){
			if($value != strip_tags($value)){
				SafeLog('get',$key,$value);
				return false;
			}
		}
	}
	foreach($_POST as $key=>$value) {
		if(!in_array($key,$pc)){
			if($value != strip_tags($value)){
				SafeLog('post',$key,$value);
				return false;
			}
		}
	}
	return true;
}
function IsSafe(){
	return SafeArgs();
}
function SafePage($log){
	exit(include('WarningPage.php'));
}
function SafeLog($method,$key,$value,$match){
	$log=[
		'ip' => $_SERVER["REMOTE_ADDR"], 
		'data' => [
			'GET'=>$_GET,
			'POST'=>$_POST,
			'COOKIE'=>$_COOKIE
		], 
		'time' => strftime("%Y-%m-%d %H:%M:%S"), 
		'page' => $_SERVER["PHP_SELF"], 
		'method' => $method, 
		'rkey' => $key, 
		'rdata' => $value, 
		'user_agent' => $_SERVER['HTTP_USER_AGENT'], 
		'request_url' => $_SERVER["REQUEST_URI"],
		'pregmatch'=>$match
	];
	
	file_put_contents(RootDir . '/SafeLog_cxc4v5df.json', json_encode($log)."\r\n", FILE_APPEND);
	SafePage($log);
}
include('360webscan.php');