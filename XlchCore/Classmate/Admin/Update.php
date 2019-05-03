<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','控制台 - 检测更新');

$VersionData=json_decode(get_curl('http://api.txl.xlch8.cn/Version.php?Type=JSON'),true);
$NewVersionData=$VersionData[0];
$IsNew=($Version_ >= $NewVersionData['VersionId'] ? false : true);

if($Type == 'Update' && $IsNew){
	$log='<p>正在下载更新包...';
	$UpdateData=get_curl('http://api.txl.xlch8.cn/Download/Update.php?Domain='.$Domain.'&AuthCode='.$AuthCode.'&Version='.$Version_);
	if($UpdateData=json_decode($UpdateData,true)){
		$log.=' <font class="c-green">√</font></p> <p>正在检查返回内容...';
		if($UpdateData['Code'] != 1){
			$log.=' <font class="c-red">×:'.$UpdateData['Message'].'</font></p>';
		}else{
			$log.='<font class="c-green">√</font><br>更新包版本:'.$UpdateData['Info']['Name'].' <small>('.$UpdateData['Info']['Id'].')</small></p> <p>安装更新包...';
			$RandString=RandString(8);
			
			file_put_contents(RootDir.'Install/'.$RandString.'.zip',base64_decode($UpdateData['File']));
			$zip = new ZipArchive;
			
			if ($zip->open(RootDir.'Install/'.$RandString.'.zip')) {
				$zip->extractTo(RootDir); 
				$zip->close(); 
				$log.='<font class="c-green">√</font></p> <p>开始更新数据...';
				if(include(RootDir.'Install/Update.php')){
					$log.=' <font class="c-green">√</font></p> <p>重写版本号...';
					file_put_contents(RootDir.'Core/AdminPHP/Config/SysConfig/Version.php',"<?php\r\n\$Version_=".$UpdateData['Info']['Id'].";\r\n\$Version='".$UpdateData['Info']['Name']."';");
					$log.=' <font class="c-green">√</font></p>';
				}else{
					$log.=' <font class="c-red">×</font></p>';
				}
				$log.='<p>处理临时文件...';
				unlink(RootDir.'Install/'.$RandString.'.zip');
				unlink(RootDir.'Install/Update.php');
				$log.=' <font class="c-green">√</font></p>';
			} else { 
				$log.=' <font class="c-red">×:解压失败，请检查您的环境！</font></p>';
			}
		}
	}else{
		$log.=' <font class="c-red">×:下载失败!请检查网络问题</font></p>';
	}
	$RInfo=[
		'I'=>$log,
		'C'=>'blue',
		'T'=>'更新程序'
	];
	return false;
}