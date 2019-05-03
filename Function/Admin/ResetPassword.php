<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if($row=$Mysql->get_row('select * from xlch_user where ID = "'.daddslashes(getArgs('UserId')).'"')){
	$Mysql->query('update xlch_user set Password = "123456" where ID = "'.$row['ID'].'"');
	exit(json_encode([
		'Code'=>1,
		'Message'=>'重置密码成功！'
	]));
}else{
	exit(json_encode([
		'Code'=>-1,
		'Message'=>'用户不存在！'
	]));
}