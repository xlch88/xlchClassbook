<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if($row=$Mysql->get_row('select * from xlch_comment where ID = "'.daddslashes(getArgs('CommentId')).'"')){
	$Mysql->query('DELETE FROM `xlch_comment` WHERE `ID` = '.$row['ID']);
	exit(json_encode([
		'Code'=>1,
		'Message'=>'删除留言成功！'
	]));
}else{
	exit(json_encode([
		'Code'=>-1,
		'Message'=>'留言不存在！'
	]));
}