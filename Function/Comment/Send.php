<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if(!IsLogin()){
	exit(json_encode([
		'Code'=>'-9',
		'Message'=>'未登录！'
	]));
}
if(strlen(getArgs('Text')) < 10){
	exit(json_encode([
		'Code'=>'-1',
		'Message'=>'内容最少5个汉字或10个字母。'
	]));
}

include(AppDir . '/Function/SysFunction/xn_html_safe.func.php');

$UserId = $UserInfo['ID'];
$Text = daddslashes(xn_html_safe(getArgs('Text')));
$Date = date($DatetimeFormat);
$CommentId = getArgs('CommentId') ? (int)daddslashes(getArgs('CommentId')) : null;
$CommentType = (int)getArgs('CommentType');
$IsPrivate = (getArgs('IsPrivate') == 'true' ? '1' : '0');

if($WebConfig['FuckRobot']['Comment']['Open'] && $UserGroup['Type'] != 'Admin'){
	if($CommentType != '1'){
		$row = $Mysql->get_row('select count(1) as count from xlch_comment where `UserId` = '.$UserId.' and Type != 1 and `AddDate` > date_sub(now(), interval 1 hour)');
		if($row['count'] >= $WebConfig['FuckRobot']['Comment']['Send']){
			exit(json_encode([
				'Code'=>'-1',
				'Message'=>'您一小时内发布留言超过了 '.$WebConfig['FuckRobot']['Comment']['Send'].' 条，歇歇吧！'
			]));
		}
	}else{
		$row = $Mysql->get_row('select count(1) as count from xlch_comment where `UserId` = '.$UserId.' and Type = 1 and `AddDate` > date_sub(now(), interval 1 hour)');
		if($row['count'] >= $WebConfig['FuckRobot']['Comment']['Reply']){
			exit(json_encode([
				'Code'=>'-1',
				'Message'=>'您一小时内回复留言超过了 '.$WebConfig['FuckRobot']['Comment']['Reply'].' 条，歇歇吧！'
			]));
		}
	}
}

if($CommentType == '0'){
	$Mysql->query('INSERT INTO `xlch_comment` set `UserId` = '.$UserId.', `Type` = "0", `Text`="'.$Text.'" , `AddDate` = "'.$Date.'"');
	$CommentId=mysqli_insert_id($Mysql->link);
}else if($CommentType == '1'){
	if(!$Mysql->get_row('select * from xlch_comment where ID = "'.$CommentId.'" and Type != 1')){
		exit(json_encode([
			'Code'=>'-1',
			'Message'=>'回复的留言不存在！'
		]));
	}
	$Mysql->query('INSERT INTO `xlch_comment` set `UserId` = '.$UserId.', `Type` = 1, `To` = "'.$CommentId.'", `Text`="'.$Text.'", `AddDate` = "'.$Date.'"');
	$CommentId=mysqli_insert_id($Mysql->link);
}else if($CommentType == '2'){
	if(!$Mysql->get_row('select * from xlch_user where ID = "'.$CommentId.'"')){
		exit(json_encode([
			'Code'=>'-1',
			'Message'=>'发送对象不存在！'
		]));
	}
	$Mysql->query('INSERT INTO `xlch_comment` set `UserId` = '.$UserId.', `Type` = 2, `To` = "'.$CommentId.'", `Text`="'.$Text.'", `AddDate` = "'.$Date.'" , `Private` = "'.$IsPrivate.'"');
	$CommentId=mysqli_insert_id($Mysql->link);
}else if($CommentType == '3'){
	if(!$Mysql->get_row('select * from xlch_image_dir where ID = "'.$CommentId.'"')){
		exit(json_encode([
			'Code'=>'-1',
			'Message'=>'发送相册不存在！'
		]));
	}
	$Mysql->query('INSERT INTO `xlch_comment` set `UserId` = '.$UserId.', `Type` = 3, `To` = "'.$CommentId.'", `Text`="'.$$Text.'", `AddDate` = "'.$Date.'"');
	$CommentId=mysqli_insert_id($Mysql->link);
}else{
	exit(json_encode([
		'Code'=>'-1',
		'Message'=>'类型错误！'
	]));
}
exit(json_encode([
	'Code'=>'1',
	'Message'=>'回复成功！',
	'CommentId'=>$CommentId
]));