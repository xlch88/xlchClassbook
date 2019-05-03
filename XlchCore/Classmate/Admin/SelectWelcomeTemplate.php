<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','控制台 - 选择引导页模板');
$I['WelcomeTemplateList'] = [];
foreach(glob(TemplateDir . 'Welcome/*.php') as $filename){
	$file = file_get_contents($filename);
	$file = explode('<!-- WelcomeTemplateInfo',$file);
	$file = explode('WelcomeTemplateInfo -->',$file[1]);
	$file = str_replace("\t",'',$file[0]);
	$file = explode("\r\n",$file);
	$file = array_values(array_filter($file));
	
	$templateId = str_replace([TemplateDir . 'Welcome/', '.php'],'',$filename);
	
	$tmpInfo = [];
	
	foreach($file as $row){
		$row = explode(':',$row);
		$tmpInfo[$row[0]]=$row[1];
	}
	$I['WelcomeTemplateList'][$templateId]=$tmpInfo;
}

if($Type == 'Save' && $tmpId = getArgs('Id')){
	if(isset($I['WelcomeTemplateList'][$tmpId])){
		$WebConfig['Info']['Welcome']['Page']=$tmpId;
	}else{
		$RInfo=[
			'T'=>'保存失败',
			'I'=>'您选择的模板不存在！',
			'C'=>'red'
		];
		return false;
	}

	file_put_contents(AppDir.'Config/SysConfig/Config.php',"<?php\r\nreturn <<<FlandreStudio_JSON\r\n".json_encode($WebConfig,JSON_PRETTY_PRINT + JSON_UNESCAPED_UNICODE)."\r\nFlandreStudio_JSON;\r\n?>");
	
	$RInfo=[
		'T'=>'保存成功！',
		'I'=>'模板更换成功！',
		'C'=>'green'
	];
	return false;
}