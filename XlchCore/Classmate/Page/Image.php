<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName',$UInfo['Username'].' 的个人主页 - 相册');
//按照时间分组 每2分钟分组算一组
$I['ImageList']=ToArrayRow($Mysql->query('select *,(select Name from xlch_image_dir where xlch_image_dir.ID = xlch_image.DirId) as DirName from xlch_image where UploadId = "'.$UInfo['ID'].'" order by AddDate desc'));
$gid=0;
$g=[];
foreach($I['ImageList'] as $i=>$row){
	if(substr($row['Url'],0,4) !='http' && !is_file(RootDir.$row['Url']))$I['ImageList'][$i]['Url']='/assets/img/404.png';
}