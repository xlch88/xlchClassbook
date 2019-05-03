<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

if(!class_exists('XlchAuth')){
	SysInfo([
		'Code'=>'403214',
		'Title'=>'XlchAuth - 绚丽彩虹安全验证系统',
		'Info'=>'绚丽彩虹授权验证系统损坏',
		'Text'=>'1.您干了点不好的事情导致授权系统无法正常工作。'
	]);
}else{
	if(!isset($_SESSION['xlch_safe']) && IsLogin() && $GroupInfo[$UserInfo['Group']]['Type'] == 'Admin') {
		$XlchAuth->CheckSafe();
	}
	if((!isset($_SESSION['xlch_auth']) or $_SESSION['xlch_auth'] + 600 < time()) && IsLogin() && $GroupInfo[$UserInfo['Group']]['Type'] == 'Admin') {
		$XlchAuth->CheckAuth();
	}
}