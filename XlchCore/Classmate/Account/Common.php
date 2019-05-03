<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

$pageName=[
	'Index'=>'登录',
	'Register'=>'注册',
	'ResetPassword'=>'重置密码',
];
define('PageName',(isset($pageName[$mod2]) ? $pageName[$mod2] : $pageName['Index']));