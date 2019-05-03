<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if(!IsLogin()){
	exit(json_encode([
		'Code'=>'-9',
		'Message'=>'未登录！'
	]));
}
$UserInfo['UserData']['Public']['Sign']=htmlspecialchars(getArgs('Sign'));
$Mysql->query('update xlch_user set UserData = "'.daddslashes(json_encode($UserInfo['UserData'])).'" where ID = "'.$UserInfo['ID'].'"');
exit(json_encode([
	'Code'=>'1',
	'Message'=>'保存成功！'
]));