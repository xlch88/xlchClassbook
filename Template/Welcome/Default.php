<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?=$WebConfig['SEO']['Title']?> - Powered by 绚丽彩虹同学录</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?=$WebConfig['SEO']['Description']?>" />
		<meta name="keywords" content="<?=$WebConfig['SEO']['Keywords']?>" />
		<meta name="author" content="绚丽彩虹工作室" />
		
		<!-- WelcomeTemplateInfo
		Author	:	FlandreStudio
		Name	:	绚丽彩虹同学录
		Info	:	青绿色小清新模板。
		WelcomeTemplateInfo -->

		<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link rel="shortcut icon" href="favicon.ico">

		<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/owl-carousel/1.32/owl.carousel.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/owl-carousel/1.32/owl.theme.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/magnific-popup.js/0.9.9/magnific-popup.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/superfish/1.7.9/css/superfish.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
		<script src="//lib.baomitu.com/modernizr/2.6.2/modernizr.min.js"></script>
		<link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<!-- FOR IE9 below -->
		<!--[if lt IE 9]>
		<script src="//lib.baomitu.com/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		
		<link rel="stylesheet" href="/assets/css/welcome/easy-responsive-tabs.css">
		<link rel="stylesheet" href="/assets/css/welcome/style.css">

	</head>
	<body>

		<!-- START #fh5co-header -->
		<header id="fh5co-header-section" role="header" class="" >
			<div class="container">

				

				<!-- <div id="fh5co-menu-logo"> -->
					<!-- START #fh5co-logo -->
					<h1 id="fh5co-logo" class="pull-left"><?=$WebConfig['Info']['WebName']?></h1>
					
					<!-- START #fh5co-menu-wrap -->
					<nav id="fh5co-menu-wrap" role="navigation">
						
						
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active">
								<a href="index.html">首页</a>
							</li>
							<li><a href="<?=U('Account')?>">登录</a></li>
							<li><a href="<?=U('Account','Register')?>">注册</a></li>
							<li><a href="#fh5co-main">功能介绍</a></li>
							<li><a href="#fh5co-features">细节介绍</a></li>
							<li><a href="http://txl.Flandre-Studio.cn/">帮助</a></li>
							<li><a href="#fh5co-footer">关于</a></li>
						</ul>
					</nav>
				<!-- </div> -->

			</div>
		</header>
		
		
		<div id="fh5co-hero" style="background-image: url(images/slide_2.jpg);">
			<div class="overlay"></div>
			<a href="#fh5co-main" class="smoothscroll fh5co-arrow to-animate hero-animate-4"><i class="fa fa-angle-down"></i></a>
			<!-- End fh5co-arrow -->
			<div class="container">
				<div class="col-md-12">
					<div class="fh5co-hero-wrap">
						<div class="fh5co-hero-intro">
							<h1 class="to-animate hero-animate-1"><?=$WebConfig['Info']['WebName']?></h1>
							<h2 class="to-animate hero-animate-2">最后的最后，我们都只能被记忆所遗忘</h2>
							<p class="to-animate hero-animate-3">
							<?php if(IsLogin()){ ?>
							<a href="<?=U('Index')?>" class="btn btn-outline btn-md">开始使用</a>
							<?php }else{ ?>
							<a href="<?=U('Account')?>" class="btn btn-outline btn-md">登录到同学录</a>
								<?php if($WebConfig['Option']['Register']){ ?>
								<a href="<?=U('Account','Register')?>" class="btn btn-outline btn-md">注册一个账号</a>
								<?php } ?>
							<?php } ?>
							</p>
						</div>
					</div>
				</div>
			</div>		
		</div>

		<div id="fh5co-main">
			
			<div class="fh5co-cards">
				<div class="container-fluid">
					<div class="row animate-box">
						<div class="col-md-12 heading text-center"><h1>同学录功能</h1></div>
					</div>
					<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6 animate-box">
							<a class="fh5co-card">
								<img src="assets/img/welcome/img_large_1.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
								<div class="fh5co-card-body">
									<h2 align="center">同学录</h2>
									<p>传统纸质同学录加以现代化的互联网图片技术，让您可以充分地展示自我，也和查看别人的的同学录，功能非常全面。</p>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 animate-box">
							<a class="fh5co-card">
								<img src="assets/img/welcome/img_large_2.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
								<div class="fh5co-card-body">
									<h2 align="center">相册</h2>
									<p>自由地上传图片并让同学查看，所有照片均不压缩原图永久保存，不像QQ那样即压缩还有丢失的风险。</p>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 animate-box">
							<a class="fh5co-card">
								<img src="assets/img/welcome/img_large_3.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
								<div class="fh5co-card-body">
									<h2 align="center">留言板</h2>
									<p>不知不觉毕业了，给老同学评价一下对方的特点，是幽默滑稽，还是高冷内涵？几十个字，藏着的却是三年的时光。</p>
								</div>
							</a>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 animate-box">
							<a class="fh5co-card">
								<img src="assets/img/welcome/img_large_4.jpg" alt="Free HTML5 Bootstrap template" class="img-responsive">
								<div class="fh5co-card-body">
									<h2 align="center">班级中心</h2>
									<p>快速地浏览整个同学录网站的最新消息，不错过任何值得珍惜的珍贵回忆。</p>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>

			<div class="container">
				
				<div class="row text-center" id="fh5co-features">
					<div class="col-md-12 heading animate-box"><h2>细节</h2></div>
					<div class="col-md-4 col-sm-6 text-center fh5co-feature feature-box">
						<div class="fh5co-feature-icon">
							<i class="fa fa-mobile"></i>
						</div>
						<h3 class="heading">兼容</h3>
						<p>领先的Bootstrap架构是您无论使用电脑还是手机都能兼容</p>
					</div>
					<div class="col-md-4 col-sm-6 text-center fh5co-feature feature-box"> 
						<div class="fh5co-feature-icon">
							<i class="fa fa-lock"></i>
						</div>
						<h3 class="heading">加密</h3>
						<p>数据一律采用MD5高强度加密，让您的信息无处泄露</p>
					</div>

					<div class="clearfix visible-sm-block"></div>

					<div class="col-md-4 col-sm-6 text-center fh5co-feature feature-box"> 
						<div class="fh5co-feature-icon">
							<i class="fa fa-play-circle-o"></i>
						</div>
						<h3 class="heading">视频</h3>
						<p>视频播放采用大带宽技术投入，播放高清不卡顿</p>
					</div>

					<div class="clearfix visible-md-block visible-lg-block"></div>

					<div class="col-md-4 col-sm-6 text-center fh5co-feature feature-box">
						<div class="fh5co-feature-icon">
							<i class="fa fa-cny"></i>
						</div>
						<h3 class="heading">免费</h3>
						<p>本同学录全局免费！是的，没有任何会员制度或者充值！</p>
					</div>

					<div class="clearfix visible-sm-block"></div>

					<div class="col-md-4 col-sm-6 text-center fh5co-feature feature-box"> 
						<div class="fh5co-feature-icon">
							<i class="fa fa-dashboard"></i>
						</div>
						<h3 class="heading">主题</h3>
						<p>一个小小的同学录，也能让您舒心。您可以在后台右上角菜单更换</p>
					</div>
					<div class="col-md-4 col-sm-6 text-center fh5co-feature feature-box"> 
						<div class="fh5co-feature-icon">
							<i class="fa fa-info"></i>
						</div>
						<h3 class="heading">帮助</h3>
						<p>考虑到少数学霸不会使用新鲜事物，特意编写了数千字的帮助文档</p>
					</div>
				</div>
				<!-- END row -->
				
			</div>
			<!-- END container -->

			<div class="animate-box fh5co-product-2">
				<div class="fh5co-half img" style="background-image: url(assets/img/welcome/img_large_6.jpg);">
					
				</div>
				<div class="fh5co-half">
					<h3>时光の终结</h3>
					<p>三年之前，我们来到这所学校。素不相识的我们从此开始了五彩的故事。<br/>
					我们不得不分离，轻声地说声再见，心里存着感谢，感谢你曾给过我一份深厚的情谊。聚也不是开始，散也不是结束，同窗数载凝的无数美好瞬间，将永远铭刻在我们的记忆之中。<br/>
					朋友，再会！朋友，珍重！流水匆匆，岁月匆匆，唯有支情永存心中。</p>
				</div>
			</div>

		
		</div>
		<!-- END fhtco-main -->


		<footer role="contentinfo" id="fh5co-footer">
			<a href="#" class="fh5co-arrow fh5co-gotop footer-box"><i class="fa fa-angle-up"></i></a>
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-6 footer-box">
						<h3 class="fh5co-footer-heading">链接</h3>
						<ul class="fh5co-footer-links">
							<li><a href="#">首页</a></li>
							<li><a href="<?=U('Account')?>">登录</a></li>
							<li><a href="<?=U('Account','Register')?>">注册</a></li>
							<li><a href="#fh5co-main">功能介绍</a></li>
							<li><a href="#fh5co-features">细节介绍</a></li>
							<li><a href="http://txl.qq-admin.cn/">帮助</a></li>
						</ul>

					</div>
					<div class="col-md-4 col-sm-6 footer-box">
						<h3 class="fh5co-footer-heading">简介</h3>
						<ul class="fh5co-footer-links">
						<p><?=$WebConfig['Info']['WebName']?>是一款以简洁、高效为目的的自适应同学录，内有同学录、相册、留言板三大功能，
						当您真正使用之时，方能见证其功能强大。完备的加密技术确保用户资料不被窃取。</p>

						</ul>
					</div>
					<div class="col-md-4 col-sm-12 footer-box">
						<h3 class="fh5co-footer-heading">联系站长</h3>
						<ul class="fh5co-social-icons">
							<li><a><i class="fa fa-qq"></i></a> QQ <?=$WebConfig['AdminInfo']['QQ']?></li><br/>
							<li><a><i class="fa fa-wechat"></i></a> 微信 <?=$WebConfig['AdminInfo']['WeChat']?></li><br/>	
							<li><a><i class="fa fa-envelope-o"></i></a> E-mail <?=$WebConfig['AdminInfo']['Email']?></li><br/>
						</ul>
					</div>
					<div class="col-md-12 footer-box text-center">
						<div class="fh5co-copyright">
							<p>版权归属 &copy; 2013-<?=date('Y')?> <a href="http://Flandre-Studio.cn/" target="_blank">绚丽彩虹工作室</a>. All Rights Reserved. <br />Powered By <a href="http://txl.xlch8.cn/" target="_blank">绚丽彩虹同学录</a>.</p>
						</div>
					</div>
				</div>
				<div class="fh5co-spacer fh5co-spacer-md"></div>
			</div>
		</footer>

		<script src="//lib.baomitu.com/jquery/2.2.4/jquery.min.js"></script>
		<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="//lib.baomitu.com/owl-carousel/1.32/owl.carousel.min.js"></script>
		<script src="//lib.baomitu.com/magnific-popup.js/0.9.9/jquery.magnific-popup.min.js"></script>
		<script src="//lib.baomitu.com/superfish/1.7.9/js/superfish.min.js"></script>
		<script src="//lib.baomitu.com/waypoints/4.0.1/jquery.waypoints.min.js"></script>
		<script src="/assets/js/welcome/easyResponsiveTabs.js"></script>
		<script src="/assets/js/welcome/main.js"></script>

	</body>
</html>