<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','控制台 - 首页');
$sql=[
	'User'=>'select count(1) from xlch_user',
	'Image'=>'select count(1) from xlch_image',
	'Image_Dir'=>'select count(1) from xlch_image_dir',
	'Comment'=>'select count(1) from xlch_comment'
];
foreach($sql as $i=>$row){
	$Count[$i]=$Mysql->get_row($row)['count(1)'];
}