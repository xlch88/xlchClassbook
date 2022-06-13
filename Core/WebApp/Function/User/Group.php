<?php
$UserGroup=$GroupInfo[(IsLogin() ? ($UserInfo['Group'] ? $UserInfo['Group'] : 'Default') : 'Guest')];
$PermissionType=(isset($func) ? 'Function' : 'Page');
$Mod2Name=(isset($func) ? 'Do' : 'Mod2');
$TempMod=(isset($func) ? $func : $mod);
$TempMod2=(isset($func) ? $do : $mod2);

function CheckPermission(){
	global $UserGroup,$PermissionType,$TempMod,$Mod2Name,$TempMod2,$GroupInfo;
	$CheckList = [
		$UserGroup['Permission'][$PermissionType][$TempMod][$Mod2Name][$TempMod2] ?? null,
		$UserGroup['Permission'][$PermissionType][$TempMod][$Mod2Name]['All'] ?? null,
		$UserGroup['Permission'][$PermissionType][$TempMod]['Allow'] ?? null,
		$UserGroup['Permission'][$PermissionType]['All']['Allow'] ?? null,
		$UserGroup['Permission']['All']['Allow'] ?? null
	];
	if(isset($UserGroup['Include'])){
		$CheckList = array_merge($CheckList,[
			$GroupInfo[$UserGroup['Include']]['Permission'][$PermissionType][$TempMod][$Mod2Name][$TempMod2] ?? null,
			$GroupInfo[$UserGroup['Include']]['Permission'][$PermissionType][$TempMod][$Mod2Name]['All'] ?? null,
			$GroupInfo[$UserGroup['Include']]['Permission'][$PermissionType][$TempMod]['Allow'] ?? null,
			$GroupInfo[$UserGroup['Include']]['Permission'][$PermissionType]['All']['Allow'] ?? null,
			$GroupInfo[$UserGroup['Include']]['Permission']['All']['Allow'] ?? null
		]);
	}
	
	foreach($CheckList as $row){
		if($row === true){
			return true;
		}else if($row === false){
			return false;
		}
	}
	return false;
}
if(CheckPermission() !== true){
	if(IsLogin()){
		SysInfo(array(
			"Title"=>"无法进入",
			"Code"=>"40340",
			"Info"=>"抱歉，您目前暂时无法访问访问该页面：".implode('/',isset($func) ? array_filter([$func,$do]) : array_filter([$mod,$mod2])),
			"Text"=>"1.您没有足够的权限访问本页面。<br>2.您进入了未知领域，<a href='".U('Index')."'>点击这里</a>返回首页。",
		));
	}else{
		SysInfo(array(
			"Title"=>"无法进入",
			"Code"=>"40340",
			"Info"=>"抱歉，您目前暂时无法访问访问该页面：".implode('/',isset($func) ? array_filter([$func,$do]) : array_filter([$mod,$mod2])),
			"Text"=>"1.您没有登录，请<a href='".U('Account')."'>点击这里</a>进行登录。<br>2.如果您没有账号，请<a href='".U('Account','Register')."'>点击这里</a>进行注册。",
		));
	}
	
	
	
}