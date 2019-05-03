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
	<div id="page-container" class="fade">
		<div class="register register-with-news-feed">
			<div class="news-feed">
				<div class="news-image">
					<img src="/assets/img/login/bg.jpg" alt="" />
				</div>
				<div class="news-caption">
					<h4 class="caption-title"><i class="fa fa-edit text-success"></i> 欢迎使用 <?=$WebConfig['Info']['WebName']?>~</h4>
					<p>
						<?=$WebConfig['SEO']['Description']?>
					</p>
				</div>
			</div>
			<div class="right-content">
				<h1 class="register-header">
					重置密码
					<small>如果您忘了您的账号密码，可以在这里通过密保信息重置您的密码。</small>
				</h1>
				<div class="register-content">
					<form id="ResetPassword" class="margin-bottom-0">
						<label class="control-label">你的大名 <span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-12 m-b-15">
								<input type="text" class="form-control" placeholder="请输入真实姓名" required id="Username" />
							</div>
						</div>
						<label class="control-label">密保问题 <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<p id="SafeQuestion"><font color=red>请先填写姓名！</font></p>
							</div>
						</div>
						<label class="control-label">密保答案 <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="text" class="form-control" placeholder="请输入您设置的密保答案" required id="SafeAnswer" />
							</div>
						</div>
						<label class="control-label">班级密码(没有密码不允许重置) <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="text" class="form-control" placeholder="请向本站管理员获取" required id="ClassPassword" />
							</div>
						</div>
						<label class="control-label">新密码 <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="text" class="form-control" placeholder="设置您的新密码" required id="NewPassword" />
							</div>
						</div>
						<label class="control-label">验证码<span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<div class="input-group margin-bottom-sm">
									<input class="form-control" maxlength=4 style="height:45px" type="text" id="VCode" placeholder="验证码">
									<span class="input-group-addon"><img height="30px" src="<?=U('func','VCode')?>" id="VCodeShow"></span>
								</div>
							</div>
						</div>
						<div class="register-buttons">
							<button type="submit" required="required" id="Button" class="btn btn-primary btn-block btn-lg">重置密码</button>
						</div>
						<div class="m-t-20 m-b-40 p-b-40 text-inverse">
							想起密码了？ 点击 <a href="<?=U('Account')?>">这里</a> 登录。
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
	$('#VCodeShow').click(function(){
		$(this).attr('src','<?=U('func','VCode')?>');
		$('#VCode').val('');
	});
	$('#ResetPassword').submit(function(){
		$('#Button').attr('disabled','disabled');
		$.ajax({
			url:"<?=U('func','User','ResetPassword','Set')?>",
			data:{
				Username:$('#Username').val(),
				SafeAnswer:$('#SafeAnswer').val(),
				ClassPassword:$('#ClassPassword').val(),
				NewPassword:$('#NewPassword').val(),
				VCode:$('#VCode').val(),
			},
			dataType:'json',
			success:function(data){
				if(data.Code == 1){
					notify(data.Message,'success');
					setTimeout(function(){
						window.location.href="<?=U('Account');?>";
					},1000);
				}else{
					$('#Button').removeAttr('disabled');
					notify(data.Message,'danger');
					$('#VCodeShow').click();
				}
			},
			error:function(){
				$('#Button').removeAttr('disabled');
				notify('连接失败...请重试','danger');
			}
		});
		return false;
	});
	$("#Username").blur(function(){
		$.ajax({
			url:"<?=U('func','User','ResetPassword','GetSafeQuestion')?>",
			data:{
				Username:$('#Username').val()
			},
			dataType:'json',
			success:function(data){
				if(data.Code == 1){
					notify(data.Message,'success');
					$('#SafeQuestion').html(data.Value);
				}else{
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