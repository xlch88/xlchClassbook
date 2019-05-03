<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName',$UInfo['Username'].' 的个人主页 - 评论');
$I['CommentList']=ToArrayRow($Mysql->query('select xlch_comment.*,useri.Username as Username,useri.HeadUrl as HeadUrl,(CASE xlch_comment.Type WHEN 2 THEN (select xlch_user.Username from xlch_user where xlch_comment.To = xlch_user.ID) WHEN 3 THEN (select xlch_image_dir.Name from xlch_image_dir where xlch_comment.To = xlch_image_dir.ID) ELSE "" END) as ToName from xlch_comment left join xlch_user as useri on useri.ID = xlch_comment.UserId where UserId = "'.$UInfo['ID'].'" and Type !=1 and (if(Private = 1 && (`To` != '.$UserInfo['ID'].' && `UserId` != '.$UserInfo['ID'].'),0,1)) order by AddDate desc'));

foreach($I['CommentList'] as $i=>$row){
	$I['CommentList'][$i]['Comments']=ToArrayRow($Mysql->query('select xlch_comment.*,useri.Username as Username,useri.HeadUrl as HeadUrl from xlch_comment left join xlch_user as useri on useri.ID = xlch_comment.UserId where Type = 1 and `To` = "'.$row['ID'].'" order by AddDate desc'));
	foreach($I['CommentList'][$i]['Comments'] as $row2){
		$I['CommentList'][$i]['CommentUsers'][]=$row2['UserId'];
	}
}