<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if(!preg_match('/^[\x7f-\xff]+$/',getArgs('Username'))){
	exit(json_encode([
		'Message'=>'姓名只能是中文。',
		'Code'=>-1
	]));
}
if(!preg_match('/^[a-zA-Z0-9\_\.\!\@\#\$\%\^\&\*\(\)]{6,20}$/',getArgs('Password'))){
	exit(json_encode([
		'Message'=>'密码格式错误，只能为数字字母下划线以及英文标点符号且长度在6~20位！',
		'Code'=>-1
	]));
}
if($row=$Mysql->get_row('select * from xlch_user where Username = "'.daddslashes(getArgs('Username')).'"')){
	if($row['Password']!=getArgs('Password')){
		exit(json_encode([
			'Message'=>'密码错误！',
			'Code'=>-1
		]));
	}
	Login($row);
	exit(json_encode([
		'Message'=>'登录成功！',
		'Code'=>1
	]));
}else{
	exit(json_encode([
		'Message'=>'用户名不存在！',
		'Code'=>-1
	]));
}