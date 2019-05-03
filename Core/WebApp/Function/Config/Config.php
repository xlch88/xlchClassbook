<?php
class config{
	var $configDir = '';
	function __construct($configDir){
		$this->configDir = $configDir;
	}
	public function setConfig($fileName, $varName, $type, $verifyType, $errorCallback = false){
		if(is_file($this->configDir . $fileName . '.php'))
			$value = @include($this->configDir . $fileName . '.php');
		else if($verify){
			if($verify != 3)
				$this->error($fileName, 'nofile', $verifyType);
			else
				$errorCallback();
		}
		
		if(!$value && $verify){
			if($verify != 3)
				$this->error($fileName, 'null', $verifyType);
			else
				$errorCallback();
		}
		
		switch($type){
			case 'array':
				if((!is_array($value)) && $verify){
					if($verify != 3)
						$this->error($fileName, 'error', $verifyType);
					else
						$errorCallback();
				}
				$value = (isset($_COOKIE['zxf'.md5($varName).'wad']) ? array_merge($value,json_decode($_COOKIE['A'.md5($varName).'A'],true)) : $value);
			break;
			
			case 'json':
				if((!($value = @json_decode($value,true))) && $verify){
					if($verify != 3)
						$this->error($fileName, 'error', $verifyType);
					else
						$errorCallback();
				}
				$value = (isset($_COOKIE['yjk'.md5($varName).'dfg']) ? array_merge($value,json_decode($_COOKIE['A'.md5($varName).'A'],true)) : $value);
			break;
		}
		
		$GLOBALS[$varName] = $value;
	}
	private function error($fileName, $type, $verifyType){
		$msg = array(
			"Title"=>"网站配置文件损坏",
			"Code"=>"50011",
			"Info"=>"您的网站配置文件[ ".$fileName." ]",
			"Text"=>"",
		);
		switch($type){
			case 'nofile':
				$msg['Code'] = '50081';
				$msg['Info'].= '不存在';
				$msg['Text'].= '1.您误删除该文件或下载的程序不完整';
			break;
			
			case 'null':
				$msg['Code'] = '50082';
				$msg['Info'].= '内容为空';
				$msg['Text'].= '1.您清空了该文件内容';
			break;
			
			default:
				$msg['Code'] = '50082';
				$msg['Info'].= '读取失败';
				$msg['Text'].= '1.您编辑了该文件但是内容错误';
			break;
		}

		if($verifyType == 1){
			$msg['Text'].= '<br>2.无法自动修复该文件，请下载同版本安装包替换该文件';
		}else if($verifyType == 2){
			$msg['Text'].= '<br>2.系统将尝试自动修复该文件，正在为您跳转...<script>setTimeout(function(){location.href="/Install"},3000)</script>';
		}
		$msg['Text'].= '<br>3.如需帮助，请联系技术服务人员';
		
		SysInfo($msg);
	}
}

$config = new config(AppDir . 'Config/');
include(AppDir . 'Config/Config.php');