<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','班级中心');
$I['Rand']=DecodeUserData(ToArrayRow($Mysql->query('select * from xlch_user order by rand() limit 4')));
$I['ImageList']=ToArrayRow($Mysql->query('select xlch_image.*,(select Name from xlch_image_dir where xlch_image_dir.ID = xlch_image.DirId) as DirName,useri.Username as  Username,useri.HeadUrl as HeadUrl from xlch_image left join xlch_user as useri on useri.ID = xlch_image.UploadId order by AddDate desc limit 100'));
foreach($I['ImageList'] as $i=>$row){
	if(substr($row['Url'],0,4) !='http' && !is_file(RootDir.$row['Url']))$I['ImageList'][$i]['Url']='/assets/img/404.png';
}
$gid=0;
$g=[];
foreach($I['ImageList'] as $i=>$r){
	if(strtotime($g[$gid])-strtotime($r['AddDate'])>60){
		$gid++;
	}
	$I['ImageListGroup'][$gid][]=$r;
	$g[$gid]=$r['AddDate'];
}