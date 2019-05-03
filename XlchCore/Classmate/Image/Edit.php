<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','相册管理');
if($Type=='Edit' or $Type=='SaveEdit' or $Type=='Delete'){
	$UploadType = ['File','Url','SmMs','Qiniu'];
	if(!($I['Image']['Dir']=$Mysql->get_row('select * from xlch_image_dir where ID = "'.daddslashes($val).'"'))){
		$RInfo=[
			'T'=>'错误',
			'C'=>'red',
			'I'=>'相册不存在！'
		];
		return false;
	}
	if($Type == 'SaveEdit' or $Type=='Delete'){
		if($I['Image']['Dir']['CreaterId'] != $UserInfo['ID'] && $UserGroup['Type'] != 'Admin'){
			$RInfo=[
				'T'=>'错误',
				'C'=>'red',
				'I'=>'你没有权限编辑这个相册！'
			];
			return false;
		}
	}
	if($Type == 'SaveEdit'){
		if(strlen(getArgs('Name')) < 5 or strlen(getArgs('Name')) > 64){
			$RInfo=[
				'T'=>'错误',
				'C'=>'red',
				'I'=>'相册名称最长64个字符，最短5个字符(汉字算2个字符)。'
			];
			return false;
		}
		if(strlen(getArgs('Bewrite')) > 256){
			$RInfo=[
				'T'=>'错误',
				'C'=>'red',
				'I'=>'相册介绍最长64个字符。'
			];
			return false;
		}
		$Mysql->query('update xlch_image_dir set Name = "'.daddslashes(htmlspecialchars(getArgs('Name'))).'" , Bewrite = "'.daddslashes(htmlspecialchars(getArgs('Bewrite'))).'" , AnybodyUpload="'.(getArgs('AnybodyUpload') == 'Yes' ? '1' : '0').'" where ID = "'.daddslashes($val).'"');
		$RInfo=[
			'T'=>'成功',
			'C'=>'green',
			'I'=>'成功修改相册。'
		];
		return false;
	}
	if($Type == 'Delete'){
		$Mysql->query('delete from xlch_image_dir where ID = "'.daddslashes($val).'"');
		$Mysql->query('delete from xlch_image where DirId = "'.daddslashes($val).'"');
		$RInfo=[
			'T'=>'成功',
			'C'=>'green',
			'I'=>'相册已经删除。'
		];
		return false;
	}
	$I['Image']['Dir']['Pics']=ToArrayRow($Mysql->query('select xlch_image.*,xlch_user.Username as Username from xlch_image left join xlch_user on xlch_user.ID =xlch_image.UploadId where DirId = "'.daddslashes($val).'"'));
}
if($Type == 'SaveCreate'){
	if(strlen(getArgs('Name')) < 5 or strlen(getArgs('Name')) > 64){
		$RInfo=[
			'T'=>'错误',
			'C'=>'red',
			'I'=>'相册名称最长64个字符，最短5个字符(汉字算2个字符)。'
		];
		return false;
	}
	if(strlen(getArgs('Bewrite')) > 256){
		$RInfo=[
			'T'=>'错误',
			'C'=>'red',
			'I'=>'相册介绍最长64个字符。'
		];
		return false;
	}
	if($WebConfig['Option']['ImageDirOnlyAdmin'] && $UserGroup['Type'] != 'Admin'){
		$RInfo=[
			'T'=>'错误',
			'C'=>'red',
			'I'=>'只有管理员才能创建相册！'
		];
		return false;
	}
	if($WebConfig['FuckRobot']['Image']['Open'] && $UserGroup['Type'] != 'Admin'){
		$row = $Mysql->get_row('select count(1) as count from xlch_image_dir where `CreaterId` = '.$UserInfo['ID'].' and `AddDate` > date_sub(now(), interval 1 day)');
		if($row['count'] >= $WebConfig['FuckRobot']['Image']['Dir']){
			$RInfo=[
				'T'=>'错误',
				'C'=>'red',
				'I'=>'您一天内创建相册超过了 '.$WebConfig['FuckRobot']['Image']['Dir'].' 个，歇歇吧！'
			];
			return false;
		}
	}
	
	$Mysql->query('INSERT INTO `xlch_image_dir` set AddDate = "'.date($DatetimeFormat).'", CreaterId =	"'.daddslashes($UserInfo['ID']).'", Name = "'.daddslashes(htmlspecialchars(getArgs('Name'))).'" , Bewrite = "'.daddslashes(htmlspecialchars(getArgs('Bewrite') ? getArgs('Bewrite') : '暂无介绍...')).'" , AnybodyUpload='.(getArgs('AnybodyUpload') == 'Yes' ? '1' : '0'));
	$RInfo=[
		'T'=>'成功',
		'C'=>'green',
		'I'=>'成功创建相册！',
		'U'=>U('Image')
	];
	return false;
}