<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','控制台 - 站点配置');
if($Type == 'Save'){
	// 站点信息 ---
	/* 站点名称 */			if(isset($_POST['Info_WebName']))$WebConfig['Info']['WebName']=htmlspecialchars($_POST['Info_WebName']);
	/* SEO_站点标题 */		if(isset($_POST['SEO_Title']))$WebConfig['SEO']['Title']=htmlspecialchars($_POST['SEO_Title']);
	/* SEO_站点描述 */		if(isset($_POST['SEO_Description']))$WebConfig['SEO']['Description']=htmlspecialchars($_POST['SEO_Description']);
	/* SEO_站点关键字 */	if(isset($_POST['SEO_Keywords']))$WebConfig['SEO']['Keywords']=htmlspecialchars($_POST['SEO_Keywords']);
	
	// 功能设置 ---
	/* 启用注册功能 */		$WebConfig['Option']['Register']=($_POST['Option_Register'] == 'Checked' ? true : false);
	/* 班级密码 */			if(isset($_POST['Option_RegisterPassword']))$WebConfig['Option']['RegisterPassword']=htmlspecialchars($_POST['Option_RegisterPassword']);
	/* 管理员能创建相册 */	$WebConfig['Option']['ImageDirOnlyAdmin']=($_POST['Option_ImageDirOnlyAdmin'] == 'Checked' ? true : false);
	/* 标题栏配色 */		if(isset($_POST['Option_Color']))$WebConfig['Option']['Color']=htmlspecialchars($_POST['Option_Color']);
	/* 上传照片到 */		$WebConfig['Option']['ImageUpload']=(in_array($_POST['Option_ImageUpload'],['0','1','2','3']) ? (int)$_POST['Option_ImageUpload'] : 0);
	
	// 站点信息 ---
	/* accessKey */			if(isset($_POST['Option_Qiniu_accessKey']))$WebConfig['Option']['Qiniu']['accessKey']=htmlspecialchars($_POST['Option_Qiniu_accessKey']);
	/* secretKey */			if(isset($_POST['Option_Qiniu_secretKey']))$WebConfig['Option']['Qiniu']['secretKey']=htmlspecialchars($_POST['Option_Qiniu_secretKey']);
	/* bucket */			if(isset($_POST['Option_Qiniu_bucket']))$WebConfig['Option']['Qiniu']['bucket']=htmlspecialchars($_POST['Option_Qiniu_bucket']);
	/* domain */			if(isset($_POST['Option_Qiniu_domain']))$WebConfig['Option']['Qiniu']['domain']=htmlspecialchars($_POST['Option_Qiniu_domain']);
	
	// 联系信息 ---
	/* 管理员QQ */			if(isset($_POST['AdminInfo_QQ']))$WebConfig['AdminInfo']['QQ']=htmlspecialchars($_POST['AdminInfo_QQ']);
	/* 管理员微信 */		if(isset($_POST['AdminInfo_WeChat']))$WebConfig['AdminInfo']['WeChat']=htmlspecialchars($_POST['AdminInfo_WeChat']);
	/* 管理员邮箱 */		if(isset($_POST['AdminInfo_Email']))$WebConfig['AdminInfo']['Email']=htmlspecialchars($_POST['AdminInfo_Email']);
	/* 站点名称 */			if(isset($_POST['Group_QQ']))$WebConfig['Group']['QQ']=htmlspecialchars($_POST['Group_QQ']);
	/* 站点名称 */			if(isset($_POST['Group_QQUrl']))$WebConfig['Group']['QQUrl']=htmlspecialchars($_POST['Group_QQUrl']);
	
	// 音乐设置 ---
	/* 音乐播放器 */		$WebConfig['Music']['Player']=(in_array($_POST['Music_Player'],['0','1','2']) ? (int)$_POST['Music_Player'] : 0);
	/* 绚丽彩虹播放器Key */	if(isset($_POST['Music_BadApplePlayer_Key']))$WebConfig['Music']['BadApplePlayer']['Key']=htmlspecialchars($_POST['Music_BadApplePlayer_Key']);
	/* 网易ID类型 */		if(isset($_POST['Music_Type']))$WebConfig['Music']['Type']=htmlspecialchars($_POST['Music_Type']);
	/* 网易ID值 */			if(isset($_POST['Music_Id']))$WebConfig['Music']['Id']=htmlspecialchars($_POST['Music_Id']);
	/* 自动播放 */			$WebConfig['Music']['Auto']=($_POST['Music_Auto'] == 'Checked' ? true : false);
	
	
	// 防灌水 ---
	/* 开启留言频率限制 */	$WebConfig['FuckRobot']['Comment']['Open']=($_POST['FuckRobot_Comment_Open'] == 'Checked' ? true : false);
	/* 1小时内留言数 */		if(isset($_POST['FuckRobot_Comment_Send']))$WebConfig['FuckRobot']['Comment']['Send']=htmlspecialchars($_POST['FuckRobot_Comment_Send']);
	/* 1小时内回复数 */		if(isset($_POST['FuckRobot_Comment_Reply']))$WebConfig['FuckRobot']['Comment']['Reply']=htmlspecialchars($_POST['FuckRobot_Comment_Reply']);
	/* 开启图片频率限制 */	$WebConfig['FuckRobot']['Image']['Open']=($_POST['FuckRobot_Image_Open'] == 'Checked' ? true : false);
	/* 1天最多相册数 */		if(isset($_POST['FuckRobot_Image_Dir']))$WebConfig['FuckRobot']['Image']['Dir']=htmlspecialchars($_POST['FuckRobot_Image_Dir']);
	/* 1小时最多照片数 */	if(isset($_POST['FuckRobot_Image_Pic']))$WebConfig['FuckRobot']['Image']['Pic']=htmlspecialchars($_POST['FuckRobot_Image_Pic']);
	/* 照片最大上传大小 */	if(isset($_POST['FuckRobot_Image_Size']))$WebConfig['FuckRobot']['Image']['Size']=htmlspecialchars($_POST['FuckRobot_Image_Size']);
	
	file_put_contents(AppDir.'Config/SysConfig/Config.php',"<?php\r\nreturn <<<FlandreStudio_JSON\r\n".json_encode($WebConfig,JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE)."\r\nFlandreStudio_JSON;\r\n?>");
	
	$RInfo=[
		'T'=>'保存成功！',
		'I'=>'您的站点信息已经保存成功！',
		'C'=>'green'
	];
	return false;
}