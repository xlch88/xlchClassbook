<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if(!IsLogin()){
	returnResult([
		'Code'=>-9,
		'Message'=>'未登录！'
	]);
}
if(!$DirInfo=$Mysql->get_row('select * from xlch_image_dir where ID = "'.daddslashes(getArgs('DirId')).'"')){
	returnResult([
		'Code'=>-6,
		'Message'=>'目录不存在！'
	]);
}
if(!$DirInfo['AnybodyUpload'] && $DirInfo['CreaterId'] != $UserInfo['ID']){
	returnResult([
		'Code'=>-2,
		'Message'=>'你没有权限上传。'
	]);
}
if($Type == 'File' || $Type == 'SmMs' || $Type == 'Sina' || $Type == 'Qiniu'){
	if ($_FILES["file"]["error"] == UPLOAD_ERR_OK){
		if (!(
			($_FILES["file"]["type"] == "image/gif") || 
			($_FILES["file"]["type"] == "image/jpeg") || 
			($_FILES["file"]["type"] == "image/pjpeg") || 
			($_FILES["file"]["type"] == "image/png") || 
			($_FILES["file"]["type"] == "image/bmp")
		)){
			returnResult([
				'Code'=>-52,
				'Message'=>'图片格式错误！'
			]);
		}else if ($WebConfig['FuckRobot']['Image']['Open'] && $UserGroup['Type'] != 'Admin' && $_FILES["file"]["size"] > ($WebConfig['FuckRobot']['Image']['Size']*1024)){
			returnResult([
				'Code'=>-51,
				'Message'=>'大小超过限制！'
			]);
		}else{
			$g=explode('.',$_FILES["file"]["name"]);
			$b=$g[count($g)-1];
			unset($g[count($g)-1]);
			$h=implode('.',$g);
			
			if($Type == 'SmMs'){
				
				$g=explode('.',$_FILES["file"]["name"]);
				$b=$g[count($g)-1];
				
				$url = "https://sm.ms/api/upload";
				$post_data = array(
					'ssl' => true,
					'smfile' => curl_file_create($_FILES["file"]["tmp_name"],$_FILES["file"]["type"],time().'.'.$b)
				);

				$output = get_curl($url,$post_data);
				
				@unlink($_FILES["file"]["tmp_name"]);
				
				if(!($data = json_decode($output,true))){
					returnResult([
						'Code'=>-3,
						'Message'=>'网络错误，上传到sm.ms失败！'.$output
					]);
				}
				
				if($data['code'] == 'success' && $data['data']['url']){
					$Mysql->query("INSERT INTO `xlch_image` set `DirId` = '".$DirInfo['ID']."', `Url`='".daddslashes($data['data']['url'])."', `Name`='".daddslashes(htmlspecialchars($h))."', `UploadId`='".$UserInfo['ID']."', `AddDate` = '".date($DatetimeFormat)."'");
					returnResult([
						'Code'=>1,
						'Message'=>'上传成功'
					]);
				}else{
					returnResult([
						'Code'=>-3,
						'Message'=>$data['msg']
					]);
				}
			}else if($Type == 'Qiniu'){
				
				include(AppDir . 'SDK/Qiniu/Config.php');
				include(AppDir . 'SDK/Qiniu/functions.php');
				include(AppDir . 'SDK/Qiniu/Auth.php');
				include(AppDir . 'SDK/Qiniu/Storage/UploadManager.php');
				include(AppDir . 'SDK/Qiniu/Storage/FormUploader.php');
				include(AppDir . 'SDK/Qiniu/Zone.php');
				include(AppDir . 'SDK/Qiniu/Http/Client.php');
				include(AppDir . 'SDK/Qiniu/Http/Request.php');
				include(AppDir . 'SDK/Qiniu/Http/Response.php');
				
				$accessKey = $WebConfig['Option']['Qiniu']['accessKey'];
				$secretKey = $WebConfig['Option']['Qiniu']['secretKey'];
				$bucket = $WebConfig['Option']['Qiniu']['bucket'];
				$domain = $WebConfig['Option']['Qiniu']['domain'];
				
				$auth = new \Qiniu\Auth($accessKey, $secretKey);
				$uploadMgr = new \Qiniu\Storage\UploadManager();
				$token = $auth->uploadToken($bucket);
				
				$filename = date('Y-m-d').'_Flandre-Studio.cn_'.((float)$usec + (float)$sec).'_'.md5(RandString(2048)).'.'.$b;
				list($ret, $err) = $uploadMgr->putFile($token, $filename, $_FILES["file"]["tmp_name"]);
				
				$url = "http://$domain/$filename";
				
				if(!$err){
					$Mysql->query("INSERT INTO `xlch_image` set `DirId` = '".$DirInfo['ID']."', `Url`='".daddslashes($url)."', `Name`='".daddslashes(htmlspecialchars($h))."', `UploadId`='".$UserInfo['ID']."', `AddDate` = '".date($DatetimeFormat)."'");
					returnResult([
						'Code'=>1,
						'Message'=>'上传成功'
					]);
				}else{
					returnResult([
						'Code'=>-3,
						'Message'=>'由于服务器原因上传失败。'
					]);
				}
			}else if($Type == 'File'){
				mkdir(RootDir.'/Upload/'.date('Y-m-d'),0777,true);
				
				list($usec, $sec) = explode(" ", microtime());
				$filename='/Upload/'.date('Y-m-d').'/Flandre-Studio.cn_'.((float)$usec + (float)$sec).'_'.md5(RandString(2048)).'.'.$b;
				
				if(move_uploaded_file($_FILES["file"]["tmp_name"],RootDir.$filename)){
					$Mysql->query("INSERT INTO `xlch_image` set `DirId` = '".$DirInfo['ID']."', `Url`='".daddslashes($filename)."', `Name`='".daddslashes(htmlspecialchars($h))."', `UploadId`='".$UserInfo['ID']."', `AddDate` = '".date($DatetimeFormat)."'");
					returnResult([
						'Code'=>1,
						'Message'=>'上传成功'
					]);
				}else{
					returnResult([
						'Code'=>-3,
						'Message'=>'由于服务器原因上传失败。'
					]);
				}
			}
		}
	}else{
		returnResult([
			'Code'=>-53,
			'Message'=>'上传错误：'.$_FILES["file"]["error"]
		]);
	}
}else if($Type == 'Url'){
	$Urls = $_POST['Urls'];
	
	if(!$Urls or !is_array($Urls)){
		returnResult([
			'Code'=>-52,
			'Message'=>'没有选择要上传的文件。'
		]);
	}
	$sql=[];
	foreach($Urls as $i => $row){
		if(substr($row,0,7) != 'http://' && substr($row,0,8) != 'https://' ){
			returnResult([
				'Code'=>-53,
				'Message'=>'Url地址错误！'.htmlspecialchars($row)
			]);
		}
		$sql[]="INSERT INTO `xlch_image` set `DirId` = '".$DirInfo['ID']."', `Url`='".daddslashes($row)."', `Name`='".daddslashes(date($DatetimeFormat))."', `UploadId`='".$UserInfo['ID']."', `AddDate` = '".date($DatetimeFormat)."'";
	}
	foreach($sql as $sql_){
		$Mysql->query($sql_);
	}
	returnResult([
		'Code'=>1,
		'Message'=>'上传成功'
	]);
}else{
	returnResult([
		'Code'=>-51,
		'Message'=>'没有选择要上传的文件。'
	]);
}
function returnResult($json){
	if($json['Code'] < 1) header('HTTP/1.1 500'); 
	exit(json_encode($json));
}