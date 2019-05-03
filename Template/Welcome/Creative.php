<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- WelcomeTemplateInfo
		Author	:	FlandreStudio
		Name	:	Creative红色简约模板
		Info	:	首页随机东方Project背景图，红色简约风格。
		WelcomeTemplateInfo -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<title><?=$WebConfig['SEO']['Title']?> - Powered by 绚丽彩虹同学录</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?=$WebConfig['SEO']['Description']?>" />
		<meta name="keywords" content="<?=$WebConfig['SEO']['Keywords']?>" />
		<meta name="author" content="绚丽彩虹工作室" />
		
		<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="/assets/css/welcome/creative.min.css" rel="stylesheet">
	</head>
	<body id="page-top">
		<nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					 Menu <i class="fa fa-bars"></i>
					</button>
					<a class="navbar-brand page-scroll" href="#page-top"><?=$WebConfig['Info']['WebName']?></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a class="page-scroll" href="<?=U('Account')?>">登录</a></li>
						<li><a class="page-scroll" href="<?=U('Account','Register')?>">注册</a></li>
						<li><a class="page-scroll" href="#about">网站介绍</a></li>
						<li><a class="page-scroll" href="#services">网站功能</a></li>
						<li><a class="page-scroll" href="#contact">联系我们</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<header style="background-image: url('http://acg.bakayun.cn/randbg.php?t=dfproject&https=auto');background-color:#464646;">
			<div class="header-content">
				<div class="header-content-inner">
					<br><br><br><br>
					<h1 id="homeHeading" style="font-size:48px"><?=$WebConfig['Info']['WebName']?></h1>
					<hr>
					<p style="font-size:28px;color:#FFFFFF">一个实用的云端同学录</p>
					
					<?php if(IsLogin()){ ?>
					<a href="<?=U('Index')?>" class="btn btn-primary btn-xl page-scroll">开始使用</a>
					<?php }else{ ?>
					<a href="<?=U('Account')?>" class="btn btn-success btn-xl page-scroll">登录到同学录</a>
						<?php if($WebConfig['Option']['Register']){ ?>
						<a href="<?=U('Account','Register')?>" class="btn btn-info btn-xl page-scroll">注册一个账号</a>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</header>
		<section class="bg-primary" id="about">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 text-center">
						<h2 class="section-heading">网站介绍</h2>
						<hr class="light">
						<p class="text-faded">本站是由绚丽彩虹工作室开发的一款班级同学录网站，可以在云端储存下同学的信息，网站内含有很多实用功能，网站采用PHP+MySQL进行操作，用户密码加密储存，不定期的更新程序，保证您的信息安全</p>
					</div>
				</div>
			</div>
		</section>

		<section id="services">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<h2 class="section-heading">网站功能</h2>
						<hr class="primary">
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 text-center">
						<div class="service-box">
							<i class="fa fa-4x fa-cloud text-primary sr-icons"></i>
							<h3>云端储存</h3>
							<p class="text-muted">网站可以把同学们的信息储存在云端，可以在网站随时查看</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 text-center">
						<div class="service-box">
							<i class="fa fa-4x fa-image text-primary sr-icons"></i>
							<h3>相册功能</h3>
							<p class="text-muted">登录网站后可以在网站里面上传图片，上传后的图片同学们都可以看到</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 text-center">
						<div class="service-box">
							<i class="fa fa-4x fa-smile-o text-primary sr-icons"></i>
							<h3>留言板</h3>
							<p class="text-muted">你可以在留言板页面，把你想说的一些话，想说的事发表在留言板里面</p>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 text-center">
						<div class="service-box">
							<i class="fa fa-4x fa-codepen text-primary sr-icons"></i>
							<h3>信息保护</h3>
							<p class="text-muted">网站采用PHP+Mysql操作，用户的密码加密储存的方式来保护您的信息安全</p>
						</div>
					</div>
				</div>
			</div>
		</section>

		<aside class="bg-dark">
			<div class="container text-center">
				<div class="call-to-action">
					<center>
					 不仅是一个同学录网站，而是那段时光的美好回忆
					</center>
				</div>
			</div>
		</aside>

		<section id="contact">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2 text-center">
						<h2 class="section-heading">联系方式</h2>
						<hr class="primary">
						<p>如果你在使用本网站中遇到什么问题，请以下面的联系方式联系网站管理员</p>
					</div>
					<div class="col-lg-4 text-center">
						<i class="fa fa-qq fa-3x sr-contact"></i>
						<p><?=$WebConfig['AdminInfo']['QQ']?></p>
					</div>
					<div class="col-lg-4 text-center">
						<i class="fa fa-wechat fa-3x sr-contact"></i>
						<p><?=$WebConfig['AdminInfo']['WeChat']?></p>
					</div>
					<div class="col-lg-4 text-center">
						<i class="fa fa-envelope-o fa-3x sr-contact"></i>
						<p><?=$WebConfig['AdminInfo']['Email']?></p>
					</div>
				</div>
			</div>
		</section>
		
		
		<aside class="bg-dark">
			<div class="container text-center">
				<div class="call-to-action text-center">
					<p>版权归属 &copy; 2013-<?=date('Y')?> <a href="http://Flandre-Studio.cn/" target="_blank">绚丽彩虹工作室</a>. All Rights Reserved. <br />Powered By <a href="http://txl.xlch8.cn/" target="_blank">绚丽彩虹同学录</a>.</p>
				</div>
			</div>
		</aside>
		
		<script src="//lib.baomitu.com/jquery/2.2.4/jquery.min.js"></script>
		<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>