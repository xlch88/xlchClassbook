<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName',$UInfo['Username'].' 的个人主页 - 自拍');
if($val == 'Save'){
	if(is_numeric(getArgs('QQ'))){
		$UserInfo['UserData']['Public']['Photo']='QQ:'.getArgs('QQ');
		$Mysql->query('update xlch_user set UserData = "'.daddslashes(json_encode($UserInfo['UserData'])).'" where ID = '.$UserInfo['ID']);
	}
}