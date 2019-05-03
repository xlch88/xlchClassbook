<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName',$UInfo['Username'].' 的个人主页 - 设置');
if($val == 'Save'){
	if(getArgs('CardBg') > count($UserCardBg)-1 or getArgs('CardBg') < 0){
		$RInfo=[
			'T'=>'错误',
			'C'=>'red',
			'I'=>'资料卡背景ID不存在！'
		];
		return false;
	}
	if(getArgs('PageJS') > 4 or getArgs('PageJS') < 0){
		$RInfo=[
			'T'=>'错误',
			'C'=>'red',
			'I'=>'主页特效ID不存在！'
		];
		return false;
	}
	if(getArgs('Music')!='')$UInfo['UserData']['Public']['Music']=(int)getArgs('Music');
	if(getArgs('PageJS')!='')$UInfo['UserData']['Public']['PageJs']=(int)getArgs('PageJS');
	if(getArgs('CardBg')!='')$UInfo['UserData']['Public']['CardBg']=(int)getArgs('CardBg');
	
	$Mysql->query('update xlch_user set UserData = "'.daddslashes(json_encode($UInfo['UserData'])).'" where ID = '.$UserInfo['ID']);
}