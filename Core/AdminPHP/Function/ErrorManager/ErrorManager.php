<?php
function ErrorManager($Error){
	header('HTTP/1.1 500 Error');
	$trace=$Error->getTrace();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang=cn xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>AdminPHP - PHP错误</title>
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<style>

		body{
			font-family: 'Microsoft Yahei', Verdana, arial, sans-serif;
			font-size:14px;
		}
		a{text-decoration:none;color:#174B73;}
		a:hover{ text-decoration:none;color:#FF6600;}
		h2{
			border-bottom:1px solid #DDD;
			padding:8px 0;
			font-size:25px;
		}
		.title{
			margin:4px 0;
			color:#F60;
			font-weight:bold;
		}
		.message,#trace{
			padding:1em;
			border:solid 1px #000;
			margin:10px 0;
			background:#FFD;
			line-height:150%;
		}
		.message{
			background:#FFD;
			color:#2E2E2E;
				border:1px solid #E0E0E0;
		}
		#trace{
			background:#E7F7FF;
			border:1px solid #E0E0E0;
			color: #03A9F4;
		}
		.notice{
			padding: 10px;
			margin: 5px;
			color: #03A9F4;
			border: 1px dashed #FFADAD;
		}
		.red{
			color:red;
			font-weight:bold;
		}
		strong{
			    font-size: 20px;
		}
		table{
			text-align: left;
		}
		th{
			padding: 2px 20px 0 0;
			white-space:nowrap;
		}
		</style>
	</head>
	<body>
		<div class="notice">
			<h2>非常抱歉_(:з」∠)_，由于我们的一些失误造成您无法正常浏览该页面！ </h2>
			<div>您可以选择 【<a href="javascript:location.reload()">刷新</a>】 【<a href="javascript:history.back()">返回</a>】 或者 【<a href="">回到首页</a>】</div>
			<p><strong>页面网址:</strong>　<?=get_current_url()?></p>
			<p><strong>错误位置:</strong>　<span class="red"><?=htmlspecialchars(str_replace(RootDir,'',$Error->getFile()));?></span>　行数: <span class="red"><?=$Error->getLine();?></span></p>
			<p class="title">【错误信息】</p>
			<p class="message"><?=$Error->getMessage();?></p>
			<p class="title">【错误跟踪】</p>
			<div id="trace">
				<table>
				<?php
				foreach($trace as $row){
					$arg=(string)str_replace(RootDir,'',implode("','",$row['args']));
					$arg=htmlspecialchars($arg ? "'".$arg."'" : '%s');
				?>
				<tr>
					<th>文件：<span class="red"><?=htmlspecialchars(str_replace(RootDir,'',$row['file']));?></span></th>
					<th>行数：<span class="red"><?=$row['line']?></span></th>
					<th>函数：<?=$row['function']?>(<?=$arg?>)</th>
				</tr>
				<?php } ?>
				</table>
			</div>
		</div>
		<div align="center" style="color:#FF3300;margin:5pt;font-family:Verdana"> AdminPHP <sup style='color:gray;font-size:9pt'>By.Flandre-Studio.cn</sup><span style='color:silver'> </span>
		</div>
	</body>
</html>
<?php
}
function get_current_url(){ 
	$current_url='http://'; 
	if(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']=='on'){ 
		$current_url='https://'; 
	} 
	if($_SERVER['SERVER_PORT']!='80'){ 
		$current_url.=$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']; 
	}else{ 
		$current_url.=$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; 
	} 
	return $current_url; 
}
set_exception_handler('ErrorManager');