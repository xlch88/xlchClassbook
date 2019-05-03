<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if($ImgInfo=$Mysql->get_row('select * from xlch_image where ID = "'.daddslashes(getArgs('ImgId')).'"')){
	if($DirInfo=$Mysql->get_row('select * from xlch_image_dir where ID = "'.$ImgInfo['DirId'].'"')){
		if($DirInfo['CreaterId'] == $UserInfo['ID']){
			$Mysql->query('DELETE FROM `xlch_image` WHERE `ID` = "'.$ImgInfo['ID'].'"');
			exit(json_encode([
				'Code'=>'1',
				'Message'=>'删除成功！'
			]));
		}else{
			exit(json_encode([
				'Code'=>'0',
				'Message'=>'你没有权限删除这张图片！'
			]));
		}
	}else{
		exit(json_encode([
			'Code'=>'0',
			'Message'=>'内部数据错误，请联系管理员。'
		]));
	}
}else{
	exit(json_encode([
		'Code'=>'0',
		'Message'=>'图片不存在！'
	]));
}