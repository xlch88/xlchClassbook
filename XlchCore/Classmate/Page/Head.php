<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName',$UInfo['Username'].' 的个人主页 - 修改头像');
if($val == 'Save'){
	if(is_numeric(getArgs('QQ'))){
		$Mysql->query('update xlch_user set HeadUrl = "QQ:'.daddslashes(getArgs('QQ')).'" where ID = '.$UserInfo['ID']);
	}
}