<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="cn" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="cn">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?=$WebConfig['Info']['WebName']?> | <?=PageName;?></title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	
	<link href="//lib.baomitu.com/jqueryui/1.12.1/jquery-ui.min.css" rel="stylesheet">
	<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="//lib.baomitu.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
	<link href="/assets/css/app_1.min.css" rel="stylesheet" />
	<link href="/assets/css/app_2.min.css" rel="stylesheet" />
	<link href="/assets/css/login/style.css" rel="stylesheet" />
	
</head>
<body class="pace-top bgm-white">
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	
	<div id="page-container" class="fade">
		<div class="login login-with-news-feed">
			<div class="news-feed">
				<div class="news-image">
					<img src="/assets/img/login/bg.jpg" data-id="login-cover-image" alt="" />
				</div>
				<div class="news-caption">
					<h4 class="caption-title"><i class="fa fa-diamond text-success"></i> 欢迎使用 <?=$WebConfig['Info']['WebName']?>~</h4>
					<p>
						<?=$WebConfig['SEO']['Description']?>
					</p>
				</div>
			</div>
			<div class="right-content">
				<div class="login-header">
					<div class="brand">
						<span class="logo"></span> 登录
						<small>
						<?php if($WebConfig['Option']['Register']){ ?>
						使用账号密码登录到同学录。
						<?php } else {?>
						用户名为[你的姓名]，默认密码为[管理员给你的六位数字]。请您登录后务必尽快修改密码！
						<?php } ?>
						</small>
					</div>
					<div class="icon">
						<i class="fa fa-sign-in"></i>
					</div>
				</div>
				<div class="login-content">
					<form id="Login" class="margin-bottom-0">
						<div class="form-group m-b-15">
							<input type="text" class="form-control input-lg" id="Username" placeholder="你的大名" required />
						</div>
						<div class="form-group m-b-15">
							<input type="password" class="form-control input-lg" id="Password" placeholder="登录密码" required />
						</div>
						<div class="login-buttons">
							<button type="submit" id="Button" class="btn btn-success btn-block btn-lg">登 录</button>
						</div>
						
						<div class="m-t-20 m-b-40 p-b-40 text-inverse">
							<?php if($WebConfig['Option']['Register']){ ?>
							没有账号？<a href="<?=U('Account','Register')?>">点击这里注册</a>。
							<?php } else {?>
							没有账号？请联系本站管理员为您注册账号。
							<?php } ?>
							</br>
							忘了密码？<a href="<?=U('Account','ResetPassword')?>">点击这里重置</a>。
						</div>
						<hr />
						<p class="text-center">
							<!-- ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
							绚丽彩虹同学录 版权 请勿修改、删除 !否则视为违反使用协议!
							■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ -->
							Powered By <a href="http://txl.xlch8.cn">绚丽彩虹同学录</a>
						</p>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<script src="//lib.baomitu.com/jquery/3.2.1/jquery.min.js"></script>
	<script src="//lib.baomitu.com/jquery-migrate/1.1.0/jquery-migrate.min.js"></script>
	<script src="//lib.baomitu.com/jqueryui/1.12.1/jquery-ui.min.js"></script>
	<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="/assets/js/waves.min.js"></script>
	<script src="/assets/js/bootstrap-growl.min.js"></script>
	<!--[if lt IE 9]>
		<script src="//lib.baomitu.com/html5shiv/r29/html5.min.js"></script>
		<script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="//lib.baomitu.com/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
	<script src="//lib.baomitu.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script src="/assets/js/login/app.js"></script>
	<script>
	$(document).ready(function() {
		App.init();
	});
	$('#Login').submit(function(){
		$('#Button').attr('disabled','disabled');
		$.ajax({
			url:"<?=U('func','User','Login')?>",
			data:{
				Username:$('#Username').val(),
				Password:$('#Password').val()
			},
			cache:false,
			dataType:'json',
			success:function(data){
				if(data.Code == 1){
					notify(data.Message,'success');
					setTimeout(function(){
						window.location.href="<?=U('Index');?>";
					},1000);
				}else{
					$('#Button').removeAttr('disabled');
					notify(data.Message,'danger');
				}
			},
			error:function(){
				$('#Button').removeAttr('disabled');
				notify('连接失败...请重试','danger');
			}
		});
		return false;
	});
	</script>
</body>
</html>