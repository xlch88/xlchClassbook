<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','控制台 - 信息编辑');
include(AppDir.'/Config/SysConfig/InfoList.php');
if(!$I['Info']=$InfoList[$Type]){
	$RInfo=[
		'T'=>'错误',
		'I'=>'该编辑项目不存在！',
		'C'=>'danger'
	];
	return false;
}else{
	$I['Info']['Text']=file_get_contents(AppDir.'Config/SysConfig/Info/'.$Type.'.php');
	$I['Info']['Text']=explode("\r\n",$I['Info']['Text']);
	unset($I['Info']['Text'][0]);
	$I['Info']['Text']=implode("\r\n",$I['Info']['Text']);
}
if($val == 'Save'){
	if(strlen(getArgs('Text')) < 10){
		$RInfo=[
			'T'=>'警告',
			'I'=>'至少得写10个字吧！',
			'C'=>'yellow'
		];
		return false;
	}
	$safe="<?php /* 请务必不要改动这一行，否则会有安全隐患！ */ if(!defined('RootDir'))exit('Access Denied'); ?>\r\n";
	file_put_contents(AppDir.'Config/SysConfig/Info/'.$Type.'.php',$safe.getArgs('Text'));
	$RInfo=[
		'T'=>'成功',
		'I'=>'修改成功！',
		'C'=>'green'
	];
	return false;
}