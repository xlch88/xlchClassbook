<?php
include("db.class.php");
if(!$MysqlInfo){
	SysInfo(array(
		"Title"=>"程序未安装",
		"Code"=>"40330",
		"Info"=>"程序未安装",
		"Text"=>"您第一次使用本程序，未配置数据库等信息。<br>正在为您跳转...<script>setTimeout(function(){location.href='/Install'},3000)</script>",
	));
}
$Mysql=new DB($MysqlInfo["Ip"], $MysqlInfo["Username"], $MysqlInfo["Password"],$MysqlInfo["Database"],$MysqlInfo["Port"]);
if(!$Mysql->link){
	SysInfo(array(
		"Title"=>"XlchMysql错误",
		"Code"=>"50030",
		"Info"=>"连接数据库失败",
		"Text"=>"1.数据库信息有误,请编辑[Core/Config/Mysql.php]<br>2.网络问题",
	));
}
define("ZT",$MysqlInfo["QZ"]);
function ToArrayRow($R){
	global $Mysql;
	$B=array();
	while ($RS = $Mysql->fetch($R)){
		$B[]=$RS;
	}
	return $B;
}