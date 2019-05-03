<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','相册列表');
$I['Image']['Dir']=ToArrayRow($Mysql->query('select * from xlch_image_dir'));
foreach($I['Image']['Dir'] as $i=>$f){
	$I['Image']['Dir'][$i]['Pics']=ToArrayRow($Mysql->query('select  xlch_image.*,(select Name from xlch_image_dir where xlch_image_dir.ID = xlch_image.DirId) as DirName,useri.Username as  Username,useri.HeadUrl as HeadUrl from xlch_image left join xlch_user as useri on useri.ID = xlch_image.UploadId where DirId = "'.$f['ID'].'" limit 6'));
	foreach($I['Image']['Dir'][$i]['Pics'] as $i2=>$row){
		if(substr($row['Url'],0,4) !='http' && !is_file(RootDir.$row['Url'])){
			$I['Image']['Dir'][$i]['Pics'][$i2]['Url']='/assets/img/404.png';
		}
	}
}