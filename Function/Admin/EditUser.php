<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if($row=$Mysql->get_row('select * from xlch_user where ID = "'.daddslashes(getArgs('UserId')).'"')){
	if(!$GroupInfo[getArgs('Group')]){
		exit(json_encode([
			'Code'=>-1,
			'Message'=>'用户组不存在！'
		]));
	}
	if(!preg_match('/^[\x7f-\xff]{2,20}$/',getArgs('Username'))){
		exit(json_encode([
			'Code'=>-1,
			'Message'=>'姓名只能是中文。'
		]));
	}
	if(getArgs('Username') != $row['Username'] && $Mysql->get_row('select * from xlch_user where Username = "'.daddslashes(getArgs('Username')).'"')){
		exit(json_encode([
			'Message'=>'该姓名已被使用。',
			'Code'=>-1
		]));
	}
	$Mysql->query('update xlch_user set Username = "'.daddslashes(getArgs('Username')).'", `Group` = "'.daddslashes(getArgs('Group')).'" where ID = "'.$row['ID'].'"');
	exit(json_encode([
		'Code'=>1,
		'Message'=>'修改用户信息成功！'
	]));
}else{
	exit(json_encode([
		'Code'=>-1,
		'Message'=>'用户不存在！'
	]));
}