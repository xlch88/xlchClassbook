<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if(getArgs('oldDB') == 'true'){
	$oldDB_IP = getArgs('IP');
	$oldDB_Username = getArgs('Username');
	$oldDB_Password = getArgs('Password');
	$oldDB_Database = getArgs('Database');
	$oldDB_Port = getArgs('Port');

	$oldDB=new DB($oldDB_IP, $oldDB_Username, $oldDB_Password, $oldDB_Database, $oldDB_Port);
	
	if(!$oldDB->link){
		SysInfo(array(
			"Title"=>"XlchMysql错误",
			"Code"=>"50039",
			"Info"=>"连接数据库失败",
			"Text"=>"1.旧数据库连接失败，请检查是否填写正确。",
		));
	}
}else{
	$oldDB = $Mysql;
}

$oldType = getArgs('oldType');
$oldPrefix = getArgs('oldPrefix');
$log = [];
$userIdDist = [];
$successCount = ['user'=>0,'comment'=>0,'image'=>0];
$failedCount = ['user'=>0,'comment'=>0,'image'=>0];

if($oldType == 'ssnhV3'){
	if(!$oldPrefix) $oldPrefix = 'ssnh_';
	$log[]='<center><h1>从 似水年华V3 导入数据</h1></center><hr />';
	$log[]='<h2><font color=blue>导入用户 ... </font></h2>';
	
	$result = $oldDB->query('select * from '.$oldPrefix.'users');
	while ($row = $oldDB->fetch($result)){
		$log[]='<p>找到用户['.$row['user'].'] ... ';
		
		$NewUserGroup = ['1'=>'Default','8'=>'ViceMonitor','9'=>'Monitor'];
		
		//我有一句mmp，顺序不对。
		$Constellation = [
			1=>7,
			2=>0,
			3=>10,
			4=>4,
			5=>1,
			6=>9,
			7=>2,
			8=>5,
			9=>3,
			10=>11,
			11=>8,
			12=>6
		];
		
		$tmp = $DefaultUserData;
		$tmp['SocialAccount']['QQ']=$row['qq'];
		$tmp['MyInfo']['Birthday']=$row['sr'];
		$tmp['Public']['Sign']=$row['gxqm'];
		$tmp['ContactMe']['Email']=$row['mail'];
		$tmp['ContactMe']['Phone']=$row['phone'];
		$tmp['MyInfo']['Gender']=($row['xb'] == '2' ? 1 : 0);
		$tmp['MyInfo']['Constellation']=$Constellation[(int)$row['xz']];
		$tmp['Location']['NowLive']=$row['dz'];
		$tmp['LikeAndDislike']['MyLikeThing']=$row['ah'];
		$tmp['LikeAndDislike']['BeGoodAt']=$row['tc'];
		
		$sql='INSERT INTO `xlch_user` set
			`Username`="'.daddslashes($row['name']).'" , 
			`Password`="123456", 
			`Group`="'.$NewUserGroup[$row['active']].'", 
			`RegIP`="'.$UserInfo['RegIP'].'",
			`RegCity`="'.$UserInfo['RegCity'].'", 
			`HeadUrl`="QQ:'.daddslashes($row['qq']).'",
			`UserData`="'.daddslashes(json_encode($tmp)).'"';
		if($Mysql->query($sql)){
			$userIdDist[(int)$row['uid']] = mysqli_insert_id($Mysql->link);
			$log[]='<font color=green>导入成功√</font></p>';
			$successCount['user']++;
		}else{
			$log[]='<font color=red>导入失败×</font>'.$sql.'</p>';
			$failedCount['user']++;
		}
	}
	
	// --------------------------------------------------------------------------------
	
	$log[]='<h2><font color=blue>导入照片 ... </font></h2>';
	
	$Mysql->query("INSERT INTO `xlch_image_dir` (`Name`, `Bewrite`, `CreaterId`, `AnybodyUpload`, `AddDate`) VALUES ('导入的相册', '从 似水年华V3 导入的相册', '1', '1', now());");
	$NewImageDir=mysqli_insert_id($Mysql->link);
	
	$result = $oldDB->query('select * from '.$oldPrefix.'photo');
	while ($row = $oldDB->fetch($result)){
		$log[]='<p>找到照片['.$row['title'].'] ... ';
		
		$sql='INSERT INTO `xlch_image` set
			`DirId`="'.$NewImageDir.'" , 
			`Url`="'.daddslashes($row['src']).'", 
			`Name`="'.daddslashes($row['title']).'", 
			`UploadId`="'.($userIdDist[(int)$row['uid']] ? $userIdDist[(int)$row['uid']] : '1').'",
			`AddDate`="'.daddslashes($row['date']).'"';
		if($Mysql->query($sql)){
			$log[]='<font color=green>导入成功√</font></p>';
			$successCount['image']++;
		}else{
			$log[]='<font color=red>导入失败×</font></p>';
			$failedCount['image']++;
		}
	}
	
	// --------------------------------------------------------------------------------
	
	$log[]='<h2><font color=blue>导入留言 ... </font></h2>';
	
	$result = $oldDB->query('select * from '.$oldPrefix.'chat');
	while ($row = $oldDB->fetch($result)){
		$log[]='<p>找到留言['.$row['value'].'] ... ';
		
		$sql='INSERT INTO `xlch_comment` set
			`Text`="'.daddslashes($row['value']).'", 
			`Type`=0, 
			`UserId`="'.($userIdDist[(int)$row['uid']] ? $userIdDist[(int)$row['uid']] : '1').'",
			`AddDate`="'.daddslashes($row['date']).'"';
		if($Mysql->query($sql)){
			$log[]='<font color=green>导入成功√</font></p>';
			$successCount['comment']++;
		}else{
			$log[]='<font color=red>导入失败×</font></p>';
			$failedCount['comment']++;
		}
	}
	
	$log[]='<hr />';
	
	$oldDB->query('TRUNCATE '.$oldPrefix.'chat');
	$oldDB->query('TRUNCATE '.$oldPrefix.'photo');
	$oldDB->query('TRUNCATE '.$oldPrefix.'users');
	
	$log[]="统计：用户导入成功[{$successCount['user']}]个/失败[{$failedCount['user']}]个，照片导入成功[{$successCount['image']}]个/失败[{$failedCount['image']}]个，留言导入成功[{$successCount['comment']}]个/失败[{$failedCount['comment']}]个";
	$log[]='<p><b><font color=red>由于数据结构问题，所有导入的用户密码均为123456。</font></b></p>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang=cn xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>数据导入</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<style>
		body{
			font-family: 'Microsoft Yahei', Verdana, arial, sans-serif;
			font-size:14px;
		}
		.notice{
			padding: 10px;
			margin: 5px;
			color: #03A9F4;
			border: 1px dashed #FFADAD;
		}</style>
	</head>
	<body>
		<div class="notice">
			<p><?=implode('',$log)?></p>
		</div>
		<div align="center" style="color:#FF3300;margin:5pt;font-family:Verdana"> AdminPHP <sup style='color:gray;font-size:9pt'>By.Flandre-Studio.cn</sup><span style='color:silver'> </span>
		</div>
	</body>
</html>