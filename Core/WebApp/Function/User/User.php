<?php
if($_COOKIE['xlch_token']){ //如果Cookie不为空
	$Logout=false;
	$data=authcode(rc4($WebConfig["SysCode"],base64_decode($_COOKIE['xlch_token'])),"DECODE",$WebConfig["SysCode"]);//Base64->Rc4->Authcode解密
	list($TmpUsername, $TmpToken, $TmpToken2) = explode("\t", $data); //还原数据
	
	if($TmpUsername && $TmpToken && $TmpToken2){ //如果数据正确
		$sql = 'SELECT * FROM `xlch_user` WHERE `Username` = "'.daddslashes($TmpUsername).'"'; //从数据库读取用户数据
		if ($row = $Mysql->get_row($sql)) { 
			$Token=md5(md5($row['Username'].$row['Password'].$WebConfig["SysCode"])); //模拟生成Token
			if($TmpToken === $Token && $TmpToken2 === $row["Token"]){ //如果Token正确
				//判断账号是不是被封禁
				if($row['Status']==='On'){
					//麻痹的终于登录成功了！
					$UserInfo=array_merge($row,$_COOKIE);
					$UserInfo['UserData']=json_decode($UserInfo['UserData'],true);
				} else {
					//封禁状态
					$Logout=true;
					if($Status==='Ban'){
						$LogoutMsg="禁止登录：你已被封禁！！！";
					}else{
						$LogoutMsg='禁止登录：'.$row["Status"];
					}
				}
			} else {
				//密码被修改
				$Logout=true;
				$LogoutMsg='您的登录已经失效，请重新登录！';
			}
		} else {
			//未知情况，比如被删号？
			$Logout=true;
			$LogoutMsg='未知错误。可能是您的账号被删除！';
		}
	} else {
		$Logout=true;
		$LogoutMsg='数据错误。';
	}
	if($Logout===true){
		Logout();
	}
}
if($mod == 'Account' && $mod2 == 'Logout'){
	Logout();
}
function Logout(){
	setcookie("xlch_token", '',time()-3600,'/');
	unset($GLOBALS['UserInfo']);
}
function IsLogin(){
	global $UserInfo;
	if($UserInfo["ID"]<>""){
		return true;
	}else{
		return false;
	}
}
function Login($row){
	global $WebConfig;
	global $Mysql;
	$Token=md5(md5($row['Username'].$row['Password'].$WebConfig["SysCode"])); //生成会话Token
	$Token2=md5($Token.RandString(128));
	$data=authcode("$row[Username]\t$Token\t$Token2","ENCODE",$WebConfig["SysCode"]); //Authcode加密
	$data=rc4($WebConfig["SysCode"],$data); //Rc4加密
	$data=base64_encode($data); //Base64编码

	$Mysql->query("UPDATE `xlch_user` SET `Token` = '$Token2' , `LoginIP` = '".daddslashes(real_ip())."' , `LoginDate` = now() WHERE `ID` = '$row[ID]'"); //写入数据库会话Token
	setcookie("xlch_token",$data,time()+(86400*10),'/');
}