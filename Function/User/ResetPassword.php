<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if(!preg_match('/^[\x7f-\xff]+$/',getArgs('Username'))){
	exit(json_encode([
		'Message'=>'姓名只能是中文。',
		'Code'=>-1
	]));
}
if(!($row=$Mysql->get_row('select * from xlch_user where Username = "'.daddslashes(getArgs('Username')).'"'))){
	exit(json_encode([
		'Message'=>'用户名不存在！',
		'Code'=>-1
	]));
}
if($Type == 'GetSafeQuestion'){
	if($row['Safe_Question'] == '' or $row['Safe_Answer'] == ''){
		exit(json_encode([
			'Message'=>'获取失败！您的密保未设置，请联系本站管理员重置！',
			'Code'=>-1
		]));
	}
	
	exit(json_encode([
		'Message'=>'获取成功！',
		'Value'=>$row['Safe_Question'],
		'Code'=>1
	]));
}else if($Type == 'Set'){
	if(strtolower(getArgs('VCode')) != strtolower($_SESSION["VCode"])){
		unset($_SESSION["VCode"]);
		exit(json_encode([
			'Message'=>'验证码错误！',
			'Code'=>-1
		]));
	}
	unset($_SESSION["VCode"]);
	
	if(getArgs('ClassPassword') != $WebConfig['Option']['RegisterPassword']){
		exit(json_encode([
			'Message'=>'班级密码错误，请联系站点管理员获取。',
			'Code'=>-1
		]));
	}
	
	if($row['Safe_Question'] == '' or $row['Safe_Answer'] == ''){
		exit(json_encode([
			'Message'=>'您的密保未设置，请联系本站管理员重置！',
			'Code'=>-1
		]));
	}
	
	if($row['Safe_Answer'] != getArgs('SafeAnswer')){
		exit(json_encode([
			'Message'=>'密保答案错误！',
			'Code'=>-1
		]));
	}
	
	if(!preg_match('/^[a-zA-Z0-9\_\.\!\@\#\$\%\^\&\*\(\)]{6,20}$/',getArgs('NewPassword'))){
		exit(json_encode([
			'Message'=>'密码格式错误，只能为数字字母下划线以及英文标点符号且长度在6~20位！',
			'Code'=>-1
		]));
	}
	
	$Mysql->query('update xlch_user set Password = "'.daddslashes(getArgs('NewPassword')).'" where ID = "'.$row['ID'].'"');
	
	exit(json_encode([
		'Message'=>'重置成功！',
		'Code'=>1
	]));
}