<?php
// +----------------------------------------------------------------------
// | AdminPHP [V1.0]
// +----------------------------------------------------------------------
// | Copyright (c) 2013~2017 http://www.qq-admin.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 绚丽彩虹 <me@qq-admin.cn>
// +----------------------------------------------------------------------

//设置框架目录
define("AdminPHPDir",RootDir."Core/AdminPHP/");

//设置头部
header("Content-Type: text/html; charset=UTF-8");
header("Powered-By: Xlch-AdminPHP");

if(version_compare('5.4', PHP_VERSION, ">")) {
	die('请使用PHP 5.4 或更高的版本运行本程序！<hr>Powered By AdminPHP! (C) Flandre-Studio.cn');
}

//引入框架文件
include(AdminPHPDir."Config/Config.php");
include(AdminPHPDir."Function/Function.php");

//开启session
session_id('xlch-txl-'.md5(real_ip().'XlchQQ408214421AndHuamengQQ1991550400'));
session_start();

//设置时区
date_default_timezone_set('PRC');

//解析URL
include("Content/Url/Url.php");

//定义目录
define("ExpandDir",AppDir."Expand/");
define("PluginDir",AppDir."Plugin/");

//输出
include("Content/View/View.php");

if(!isset($NoCore) or !$NoCore){
	$Core_File_Function=AppDir.'Function/Function.php';
	
	//引入 WebApp 
	if(is_file($Core_File_Function)){
		include_once($Core_File_Function);
	}else{
		SysInfo(array(
			"Title"=>"XlchCore错误",
			"Code"=>"50002",
			"Info"=>"系统内部文件[ $Core_File_Function ]缺失",
			"Text"=>"1.核心文件损坏，请尝试重新安装。",
		));
	}
	
	// ================= FuckCrack !!! =================
	if(!class_exists('XlchAuth')){
		SysInfo([
			'Code'=>'40320',
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
	// ================= FuckCrack !!! =================
}

//AdminPHP初始化完成
define("AdminPHP","1.0.0");

if(isset($func)){
	include("Content/View/Func.php");
}else{
	include("Content/View/Template.php");
}