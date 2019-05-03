<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if($row=$Mysql->get_row('select * from xlch_user where ID = "'.daddslashes(getArgs('UserId')).'"')){
	$Mysql->query('update xlch_user set Status = "'.daddslashes(getArgs('BanText') ? getArgs('BanText') : 'On').'" where ID = "'.$row['ID'].'"');
	exit(json_encode([
		'Code'=>1,
		'Message'=>'设置封禁状态成功！'
	]));
}else{
	exit(json_encode([
		'Code'=>-1,
		'Message'=>'用户不存在！'
	]));
}