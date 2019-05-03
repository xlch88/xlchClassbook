<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

$UInfo=($Type == 'Me' ? $UserInfo : $Mysql->get_row('select * from xlch_user where ID = "'.((int)$Type).'"'));
if(!$UInfo){
	$RInfo=[
		'T'=>'错误',
		'C'=>'red',
		'I'=>'用户不存在！'
	];
	return false;
}
define('PageName',$UInfo['Username'].' 的个人主页');
if(!is_array($UInfo['UserData']))$UInfo['UserData']=json_decode($UInfo['UserData'],true);
$I['Rand']=DecodeUserData(ToArrayRow($Mysql->query('select * from xlch_user order by rand() limit 6')));