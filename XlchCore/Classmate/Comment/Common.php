<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','留言板');
//留言列表 呵呵
$I['CommentList']=ToArrayRow($Mysql->query('select xlch_comment.*,useri.Username as Username,useri.HeadUrl as HeadUrl,(CASE xlch_comment.Type WHEN 2 THEN (select xlch_user.Username from xlch_user where xlch_comment.To = xlch_user.ID) WHEN 3 THEN (select xlch_image_dir.Name from xlch_image_dir where xlch_comment.To = xlch_image_dir.ID) ELSE "" END) as ToName from xlch_comment left join xlch_user as useri on useri.ID = xlch_comment.UserId where (if(Private = 1 && (`To` != '.$UserInfo['ID'].' && `UserId` != '.$UserInfo['ID'].'),0,1)) order by AddDate desc limit 500'));

foreach($I['CommentList'] as $i=>$row){
	if($row['Type'] != '1'){
		foreach($I['CommentList'] as $i2=>$row2){
			if($row2['Type'] == '1' && $row2['To'] == $row['ID']){
				$I['CommentList'][$i]['Comments'][]=$row2;
				$I['CommentList'][$i]['CommentUsers'][]=$row2['UserId'];
				unset($I['CommentList'][$i2]);
			}
		}
	}
}