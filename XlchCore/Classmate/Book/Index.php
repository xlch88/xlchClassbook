<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

$I['UserList']=ToArrayRow($Mysql->query('select * from xlch_user'));
foreach($I['UserList'] as $i=>$row){
	$I['UserList'][$i]['UserData']=json_decode($row['UserData'],true);
}