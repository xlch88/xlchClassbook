<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','控制台 - 用户管理');
$Sql='select count(*),(select Count(*) from xlch_image where UploadId = xlch_user.ID) as ImageNumber,(select Count(*) from xlch_comment where UserId = xlch_user.ID) as CommentNumber from xlch_user';

$row2=$Mysql->get_row($Sql);
$Count=$row2["count(*)"];

$PageNum=$val;
$OneNumber=30;
$PageNumber=ceil($Count/$OneNumber);
if($PageNum>$PageNumber or $PageNum<1)$PageNum=1;
$S=($OneNumber*$PageNum)-$OneNumber;

$Sql=str_replace('count(*)','*',$Sql)." LIMIT $S , $OneNumber";
$I['UserList']=ToArrayRow($Mysql->query($Sql));