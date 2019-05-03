<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if($row=$Mysql->get_row('select * from xlch_user where ID = "'.daddslashes(getArgs('UserId')).'"')){
	$Mysql->query('DELETE FROM `xlch_user` WHERE `ID` = '.$row['ID']);
	$Mysql->query('DELETE FROM `xlch_comment` WHERE `UserId` = '.$row['ID']);
	$Mysql->query('DELETE FROM `xlch_image` WHERE `UploadId` = '.$row['ID']);
	$Mysql->query('DELETE FROM `xlch_image_dir` WHERE `CreaterId` = '.$row['ID']);
	exit(json_encode([
		'Code'=>1,
		'Message'=>'删除用户成功！'
	]));
}else{
	exit(json_encode([
		'Code'=>-1,
		'Message'=>'用户不存在！'
	]));
}