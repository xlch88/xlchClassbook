<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<!DOCTYPE html>
<html lang="en">
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
		Name	:	天高云淡
		Info	:	华丽简约的模板。
		WelcomeTemplateInfo -->
		
		<link href="//lib.baomitu.com/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="/assets/css/welcome/TGYD.css" rel="stylesheet">
		<link href="//lib.baomitu.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body id="top">
		<header id="home">
			<section class="hero" id="hero">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center inner">
							<h1 class="animated fadeInDown"><?=$WebConfig['Info']['WebName']?></h1>
							<p class="animated fadeInUp delay-05s"><?=$WebConfig['Info']['WebName']?>——一个人性化的同学录系统</p>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 col-md-offset-3 text-center">
						

							<?php if(IsLogin()){ ?>
							<a href="<?=U('Index')?>" class="learn-more-btn">开始使用</a>
							<?php }else{ ?>
							<a href="<?=U('Account')?>" class="learn-more-btn">登录到同学录</a>
								<?php if($WebConfig['Option']['Register']){ ?>
								<a href="<?=U('Account','Register')?>" class="learn-more-btn">注册一个账号</a>
								<?php } ?>
							<?php } ?>		
						</div>
					</div>
				</div>
			</section>
		</header>
		<section class="intro text-center section-padding" id="intro">
			<div class="container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 wp1">
						<h1 class="arrow">同学录网站是一个什么样的东西？</h1>
						<p>同学录，顾名思义，是记录一个班级或者一个集体同学的家庭地址，联系方式，电话号码，个性语言等等，以达到方便联系，同学之间相互了解，回忆过去的作用。新的网络时代，同学录多种多样.</p>
					</div>
				</div>
			</div>
		</section>
		<div class="copyrights">Collect from </div>
		<section class="features text-center section-padding" id="features">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="arrow">我们的优势</h1>
						<div class="features-wrapper">
							<div class="col-md-4 wp2">
								<div class="icon">
									<i class="fa fa-laptop shadow"></i>
								</div>
								<h2>一站式通用</h2>
								<p>本站采用一站式管理，以达到方便快捷的效果，不管你是电脑还是手机都可以访问本站！
								</p>
							</div>
							<div class="col-md-4 wp2 delay-05s">
								<div class="icon">
									<i class="fa fa-code shadow"></i>
								</div>
								<h2>精美的模板</h2>
								<p>本站的界面都使用了精美响应式模板的设计 让平板 手机 电脑客户端 都能在线访问我们的网站.</p>
							</div>
							<div class="col-md-4 wp2 delay-1s">
								<div class="icon">
									<i class="fa fa-heart shadow"></i>
								</div>
								<h2>隐私保护</h2>
								<p>本站采用登陆机制，数据库信息加密储存，保证您的隐私不会泄露！
								</p>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>
				</div>
			</div>
		</section> 
		
		<section class="subscribe text-center">
			<div class="container">
				<h1><span>这不只是一个同学录系统，更是一个人性化的服务！</span></h1><br>
	
			</div>
		</section>
		<section class="dark-bg text-center section-padding contact-wrap" id="contact">
			<a href="#top" class="up-btn"><i class="fa fa-chevron-up"></i></a>
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h1 class="arrow">联系管理员</h1>
					</div>
				</div>
				<div class="row contact-details">
					<div class="col-md-4">
						<div class="light-box box-hover">
							<h2><i class="fa fa-wechat"></i><span>WECHAT</span></h2>
							<p><?=$WebConfig['AdminInfo']['WeChat']?></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="light-box box-hover">
							<h2><i class="fa fa-mobile"></i><span>QQ</span></h2>
							<p><?=$WebConfig['AdminInfo']['QQ']?></p>
						</div>
					</div>
					<div class="col-md-4">
						<div class="light-box box-hover">
							<h2><i class="fa fa-paper-plane"></i><span>Email</span></h2>
							<p><?=$WebConfig['AdminInfo']['Email']?></p>
						</div>
					</div>
				</div>
				
			</div>
		</section>
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<ul class="legals">
							
						</ul>
					</div>
					<div class="col-md-6 credit">
						<p>版权归属 &copy; 2013-<?=date('Y')?> <a href="http://Flandre-Studio.cn/" target="_blank">绚丽彩虹工作室</a>. All Rights Reserved. <br />Powered By <a href="http://txl.xlch8.cn/" target="_blank">绚丽彩虹同学录</a>.</p>
					</div>
				</div>
			</div>
		</footer>
		<script src="//lib.baomitu.com/jquery/2.2.4/jquery.min.js"></script>
		<script src="//lib.baomitu.com/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="//lib.baomitu.com/waypoints/2.0.5/waypoints.min.js"></script>
		<script src="/assets/js/welcome/TGYD.js"></script>
	</body>
</html>