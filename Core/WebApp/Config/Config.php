<?php
$config->setConfig('Auth/cache', 'authInfoCache', 'text', false);
$config->setConfig('Mysql/Mysql', 'MysqlInfo', 'json', 2);
$config->setConfig('SysConfig/AuthCode', 'AuthCode', 'text', false);
$config->setConfig('SysConfig/Config', 'WebConfig', 'json', 3, function(){
	if(!is_file(RootDir.'Install/Install.lock')){
		SysInfo(array(
			"Title"=>"安装锁未放置",
			"Code"=>"40350",
			"Info"=>"程序未安装",
			"Text"=>"您的安装锁未配置正确。<br>为了保证您的网站安全，<br>在没有放置安装锁的情况下，网站会停止运行。<br>正在为您跳转...<script>setTimeout(function(){location.href='/Install'},3000)</script>",
		));
	}else{
		SysInfo(array(
			"Title"=>"网站配置文件损坏",
			"Code"=>"40351",
			"Info"=>"程序未安装",
			"Text"=>"您的网站配置已经损坏，我们无法为您提供服务。<br>请按照提示进行操作。<br>正在为您跳转...<script>setTimeout(function(){location.href='/Install'},3000)</script>",
		));
	}
});
$config->setConfig('SysConfig/DefaultUserData', 'DefaultUserData', 'json', 1);
$config->setConfig('SysConfig/Info', 'UserInfoList', 'json', 1);
$config->setConfig('SysConfig/InfoList', 'InfoList', 'json', 1);
$config->setConfig('SysConfig/Sidebar', 'Sidebar', 'json', 1);
$config->setConfig('SysConfig/UserCardBg', 'UserCardBg', 'json', 1);
$config->setConfig('SysConfig/UserGroup', 'GroupInfo', 'json', 1);