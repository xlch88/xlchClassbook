<?php
if(getArgs("SetTemplate") && is_file(TemplateDir.strFilter(getArgs("SetTemplate"))."/_Main/TemplateInfo.php")){
	setcookie($CookieName["Template"], strFilter(getArgs("SetTemplate")),0,"/");
	$_COOKIE[$CookieName["Template"]]= strFilter(getArgs("SetTemplate"));
}
if(!empty($_COOKIE[$CookieName["Template"]])){
	if(!is_file(TemplateDir.$_COOKIE[$CookieName["Template"]]."/_Main/Function.php")){
		setcookie($CookieName["Template"], "", time() - 3600,"/");
		if(!isset($WebConfig["Template"]["File"]) or !is_file(TemplateDir.$WebConfig["Template"]["File"]."/_Main/Function.php")){
			$Template=$DefaultTemplate;
		}else{
			$Template=$WebConfig["Template"]["File"];
		}
	}else{
		$Template=$_COOKIE[$CookieName["Template"]];
	}
}else{
	if(!isset($WebConfig["Template"]["File"]) or !is_file(TemplateDir.$WebConfig["Template"]["File"]."/_Main/Function.php")){
		$Template=$DefaultTemplate;
	}else{
		$Template=$WebConfig["Template"]["File"];
	}
}

$TemplateDir=TemplateDir.$Template."/";
$_TemplateDir=$TemplateDir.'_Template/';
if(!$mod2){
	$mod2=($mod=="Welcome") ? $WebConfig["Info"]["Welcome"]["Page"] : "Index";
}
$Template_Core=$Core[$Template] ? $Core[$Template] : $Core["Default"];

if($mod=="Welcome"){
	$Template_Print=RootDir."Template/Welcome/".$mod2.".php";
	$Template_Php=CoreDir."$Template_Core/$mod/Common.php";
}else{
	$Template_Print=is_file("$TemplateDir$mod/$mod2.php") ? "$TemplateDir$mod/$mod2.php" : "$TemplateDir$mod/Index.php";
	$Template_Php=CoreDir."$Template_Core/$mod/$mod2.php";
	$Template_CommonPhp=CoreDir."$Template_Core/$mod/Common.php";
}
$Template_Common=CoreDir."$Template_Core/_Common/Common.php";
$Template_Info=$TemplateDir."_Main/TemplateInfo.php";
$Template_Config=$TemplateDir."_Main/Config.php";
$Template_Func=$TemplateDir."_Main/Function.php";
$Template_Error=$TemplateDir."_Common/Error.php";
if(!is_file($Template_Config)){
	SysInfo(array(
		"Title"=>"XlchView错误",
		"Code"=>"5000",
		"Info"=>"模板文件[ $Template_Config ]缺失",
		"Text"=>"1.模板文件损坏或安装不完整，请尝试重新安装。",
	));
}
if(!is_file($Template_Func)){
	SysInfo(array(
		"Title"=>"XlchView错误",
		"Code"=>"5000",
		"Info"=>"模板文件[ $Template_Func ]缺失",
		"Text"=>"1.模板文件损坏或安装不完整，请尝试重新安装。",
	));
}
if(!is_file($Template_Print)){
	SysInfo(array(
		"Info"=>"页面[ $Template_Print ]不存在",
	));
}
if(!is_file($Template_CommonPhp) && $mod != "Welcome"){
	SysInfo(array(
		"Info"=>"页面[ $Template_CommonPhp ]不存在",
	));
}
if(is_file($Template_Info))		include($Template_Info);
if(is_file($Template_Common))	include($Template_Common);
if(is_file($Template_Config))	include($Template_Config);
if(is_file($Template_Func))		include($Template_Func);
if($mod != "Welcome") $S=include($Template_CommonPhp);
if(is_file($Template_Php) && $S) $S=include($Template_Php);
defined('PageName') or define('PageName', '');
define("Title", ($WebConfig["Info"]["Title"] ?? '').PageName);
if(!isset($RInfo)){
	include($Template_Print);
}else{
	include($Template_Error);
}
function C($Color){
	global $Template_Color;
	if(isset($Template_Color[$Color])) return $Template_Color[$Color]; else return $Color;
}
//Template
function T($T = "_Common/Header"){
	global $TemplateDir;
	$Template_Inclode=$TemplateDir.$T.".php";
	if(!is_file($Template_Inclode)){
		SysInfo(array(
			"Title"=>"XlchView错误",
			"Code"=>"5000",
			"Info"=>"引用模板文件[ $Template_Inclode ]缺失",
			"Text"=>"1.模板文件损坏或安装不完整，请尝试重新安装。<br>2.该模板存在bug。",
		));
	}else{
		return $Template_Inclode;
	}
}
//QQHead
function QH($Q=false,$S="100"){
	if(!$Q){
		global $UserInfo;
		$Q=$UserInfo["QQ"];
	}
	return "http://q1.qlogo.cn/g?b=qq&nk=$Q&s=$S";
}

