<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

$I['AdminList']=ToArrayRow($Mysql->query('select * from xlch_user where `Group` = "Admin"'));
foreach($I['AdminList'] as $i=>$row){
	if(!is_array($row['UserData']))$I['AdminList'][$i]['UserData']=json_decode($row['UserData'],true);
}