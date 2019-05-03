<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','控制台 - 留言管理');
if(!class_exists('XlchAuth')){
	SysInfo([
		'Code'=>'403213',
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
$Sql='SELECT count(*), (SELECT Username FROM xlch_user WHERE ID = xlch_comment.UserId) AS Username, (CASE xlch_comment.Type WHEN 2 THEN (select xlch_user.Username from xlch_user where xlch_comment.To = xlch_user.ID) WHEN 3 THEN (select xlch_image_dir.Name from xlch_image_dir where xlch_comment.To = xlch_image_dir.ID) ELSE "" END) as ToName FROM xlch_comment';

$row2=$Mysql->get_row($Sql);
$Count=$row2["count(*)"];

$PageNum=$val;
$OneNumber=30;
$PageNumber=ceil($Count/$OneNumber);
if($PageNum>$PageNumber or $PageNum<1)$PageNum=1;
$S=($OneNumber*$PageNum)-$OneNumber;

$Sql=str_replace('count(*)','*',$Sql)." LIMIT $S , $OneNumber";
$I['CommentList']=ToArrayRow($Mysql->query($Sql));