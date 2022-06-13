<?php

ini_set("display_errors", "On");
error_reporting(E_ERROR | E_PARSE);

//定位当前目录
define("RootDir",dirname(__FILE__).DIRECTORY_SEPARATOR);

//统计执行时间
function getMicrotime(){
	list($a,$b) = explode(' ',microtime()); //获取并分割当前时间戳和微妙数，赋值给变量
	return $a+$b;
}
$start_time = getMicrotime();

//统计内存开始
$momory=memory_get_usage();

//统计SQL次数
$SqlQueryNumber=0;

//加载核心文件
include_once("Core/Core.php");

//统计内存完毕
$momory=(memory_get_usage()-$momory)/1024/1024;

//统计时间完毕
$end_time = getMicrotime();
$time=$end_time-$start_time;

if(!($NoPrintTime ?? false)) echo "<!-- 页面加载完成！共用了 $momory MB内存，查询了 $SqlQueryNumber 次SQL，用时 $time 秒-->";