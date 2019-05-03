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
					注册
					<small>在<?=$WebConfig['Info']['WebName']?>注册一个账号，注册后您将会拥有自己的个人主页并且可以查看其他同学的资料。</small>
				</h1>
				<div class="register-content">
					<form id="Reg" class="margin-bottom-0">
						<label class="control-label">你的大名 <span class="text-danger">*</span></label>
						<div class="row row-space-10">
							<div class="col-md-12 m-b-15">
								<input type="text" class="form-control" placeholder="请输入真实姓名" required id="Username" />
							</div>
						</div>
						<label class="control-label">账号密码 <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="password" class="form-control" placeholder="登录密码" required id="Password" />
							</div>
						</div>
						<label class="control-label">QQ号码 <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="number" class="form-control" placeholder="用于获取头像" required id="QQ" />
							</div>
						</div>
						<label class="control-label">班级密码(没有密码不允许注册) <span class="text-danger">*</span></label>
						<div class="row m-b-15">
							<div class="col-md-12">
								<input type="text" class="form-control" placeholder="请向本站管理员获取" required id="ClassPassword" />
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
						<div class="checkbox m-b-30">
							<label>
								<input type="checkbox" required />
								<i class="input-helper"></i>
								我已阅读《<a href="javascript:$('#IKnow').modal('show')">注册须知</a>》
							</label>
						</div>
						<div class="register-buttons">
							<button type="submit" required="required" id="Button" class="btn btn-primary btn-block btn-lg">注册</button>
						</div>
						<div class="m-t-20 m-b-40 p-b-40 text-inverse">
							已经有账号了？ 点击 <a href="<?=U('Account')?>">这里</a> 登录。
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
	
	<div class="modal fade" id="IKnow" tabindex="-1" role="dialog" aria-labelledby="IKnowT">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="IKnowT">注册须知</h4>
				</div>
				<div class="modal-body">
					<?php include(AppDir.'/Config/SysConfig/Info/RegMustKnow.php'); ?>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
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
	$('#Reg').submit(function(){
		$('#Button').attr('disabled','disabled');
		$.ajax({
			url:"<?=U('func','User','Register')?>",
			data:{
				Username:$('#Username').val(),
				Password:$('#Password').val(),
				ClassPassword:$('#ClassPassword').val(),
				QQ:$('#QQ').val(),
				VCode:$('#VCode').val(),
			},
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
	</script>
</body>
</html>