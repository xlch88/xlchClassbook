<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if($Type != 'Admin'){
	if(!$WebConfig['Option']['Register']){
		exit(json_encode([
			'Message'=>'管理员关闭了注册！',
			'Code'=>-1
		]));
	}
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
}else{
	if(!IsLogin() or $GroupInfo[$UserInfo['Group']]['Type'] != 'Admin'){
		exit(json_encode([
			'Message'=>'你不是管理员！',
			'Code'=>-1
		]));
	}
	if(!$GroupInfo[getArgs('Group')]){
		exit(json_encode([
			'Code'=>-1,
			'Message'=>'用户组不存在！'
		]));
	}
}
if(!preg_match('/^[\x7f-\xff·]{2,40}$/',getArgs('Username'))){
	exit(json_encode([
		'Message'=>'姓名只能是中文。(名字中带点请使用·)',
		'Code'=>-1
	]));
}
if(!preg_match('/^[a-zA-Z0-9\_\.\!\@\#\$\%\^\&\*\(\)]{6,20}$/',getArgs('Password'))){
	exit(json_encode([
		'Message'=>'密码格式错误，只能为数字字母下划线以及英文标点符号且长度在6~20位！',
		'Code'=>-1
	]));
}
if($Mysql->get_row('select * from xlch_user where Username = "'.daddslashes(getArgs('Username')).'"')){
	exit(json_encode([
		'Message'=>'你的名字已经注册啦~ 请直接登录哦！',
		'Code'=>-1
	]));
}
if(!preg_match("/[1-9][0-9]{4,}/",getArgs("QQ"))){
	exit(json_encode([
		'Message'=>'QQ格式错误。',
		'Code'=>-1
	]));
}
$tmp = $DefaultUserData;
$tmp['SocialAccount']['QQ']=getArgs('QQ');
$sql='INSERT INTO `xlch_user` set
	`Username`="'.daddslashes(htmlspecialchars(getArgs('Username'))).'" , 
	`Password`="'.daddslashes(getArgs('Password')).'", 
	`RegIP`="'.daddslashes(real_ip()).'", 
	`RegCity`="'.daddslashes(get_ip_city(real_ip())).'", 
	`HeadUrl`="QQ:'.daddslashes(getArgs("QQ")).'", 
	`RegDate`="'.date($DatetimeFormat).'", 
	`UserData`="'.daddslashes(json_encode($tmp)).'"';
if($Type === 'Admin')$sql.=',`Group` = "'.daddslashes(getArgs('Group')).'"';
$Mysql->query($sql);
if($Type != 'Admin')Login($Mysql->get_row('select * from xlch_user where Username = "'.daddslashes(getArgs('Username')).'"'));
exit(json_encode([
	'Message'=>'注册成功！',
	'Code'=>1
]));