<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

$I['Image']['Dir']=$Mysql->get_row('select * from xlch_image_dir where ID = "'.daddslashes((int)$Type).'"');
if(!$I['Image']['Dir']){
	$RInfo=[
		'T'=>'错误',
		'C'=>'red',
		'I'=>'该相册不存在或已被删除！'
	];
	return false;
}
define('PageName','相册 - '.$I['Image']['Dir']['Name']);
$I['Image']['Dir']['Pics']=ToArrayRow($Mysql->query('select  xlch_image.*,(select Name from xlch_image_dir where xlch_image_dir.ID = xlch_image.DirId) as DirName,useri.Username as  Username,useri.HeadUrl as HeadUrl from xlch_image left join xlch_user as useri on useri.ID = xlch_image.UploadId where DirId = "'.$I['Image']['Dir']['ID'].'"'));
foreach($I['Image']['Dir']['Pics'] as $i=>$row){
	if(substr($row['Url'],0,4) !='http' && !is_file(RootDir.$row['Url']))$I['Image']['Dir']['Pics'][$i]['Url']='/assets/img/404.png';
}
$I['CommentList']=ToArrayRow($Mysql->query('select xlch_comment.*,useri.Username as Username,useri.HeadUrl as HeadUrl,(select xlch_image_dir.Name from xlch_image_dir where xlch_comment.To = xlch_image_dir.ID) as ToName from xlch_comment left join xlch_user as useri on useri.ID = xlch_comment.UserId where `To` = "'.$I['Image']['Dir']['ID'].'" and Type =3 order by AddDate desc'));

foreach($I['CommentList'] as $i=>$row){
	$I['CommentList'][$i]['Comments']=ToArrayRow($Mysql->query('select xlch_comment.*,useri.Username as Username,useri.HeadUrl as HeadUrl from xlch_comment left join xlch_user as useri on useri.ID = xlch_comment.UserId where Type = 1 and `To` = "'.$row['ID'].'" order by AddDate desc'));
	foreach($I['CommentList'][$i]['Comments'] as $row2){
		$I['CommentList'][$i]['CommentUsers'][]=$row2['UserId'];
	}
}