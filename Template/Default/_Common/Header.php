<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="cn">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="/favicon.ico">
		<meta name="viewport" content="width=device-width, initial-scale=0.9, maximum-scale=0.9" />
		<title><?=$WebConfig['Info']['WebName']?> | <?=PageName;?></title>
		
		<script src="//lib.baomitu.com/jquery/3.3.1/jquery.min.js"></script>
		
		<!-- Vendor CSS -->
		<link href="//lib.baomitu.com/fullcalendar/3.4.0/fullcalendar.css" rel="stylesheet">
		<link href="//lib.baomitu.com/animate.css/3.5.2/animate.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/limonte-sweetalert2/6.6.4/sweetalert2.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
		<link href="/assets/css/jquery.mCustomScrollbar.min.css?v=<?=$Version_?>" rel="stylesheet">
		<link href="//lib.baomitu.com/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/lightgallery/1.3.9/css/lightgallery.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/bootstrap-validator/0.5.3/css/bootstrapValidator.min.css" rel="stylesheet">
		<link href="//lib.baomitu.com/cropper/3.0.0-rc.1/cropper.min.css" rel="stylesheet">
		<link href="/assets/css/jquery.emoji.css?v=<?=$Version_?>" rel="stylesheet">
		
		<!-- CSS -->
		<link href="/assets/css/app_1.min.css?v=<?=$Version_?>" rel="stylesheet">
		<link href="/assets/css/app_2.min.css?v=<?=$Version_?>" rel="stylesheet">
		<link href="/assets/css/loading.css?v=<?=$Version_?>" rel="stylesheet">
			
	</head>
	<body>
		<div id="loading">
			<div id="loading1">
				<div class="block"></div>
				<div class="block"></div>
				<div class="block"></div>
				<div class="block"></div>
				<div class="section-left"></div>
				<div class="section-right"></div>
			</div>
		</div>
		<section id="page">
			<header id="header" class="clearfix" data-ma-theme="<?=($WebConfig['Option']['Color'] ? $WebConfig['Option']['Color'] : 'lightblue')?>">
				<ul class="h-inner">
					<li class="hi-trigger ma-trigger" data-ma-action="sidebar-open" data-ma-target="#sidebar">
						<div class="line-wrap">
							<div class="line top"></div>
							<div class="line center"></div>
							<div class="line bottom"></div>
						</div>
					</li>
					<li class="hi-logo hidden-xs">
						<a href="<?=U('Index')?>"><?=$WebConfig['Info']['WebName']?></a>
					</li>
					<li class="pull-right">
						<ul class="hi-menu">
							<?php if($WebConfig['Music']['Player'] == 2){ ?>
							<li class="dropdown">
								<a data-toggle="dropdown" href="#">
									<span class="musicbar animate inline m-l-sm">
										<span class="bar1 a1 bg-primary lter"></span>
										<span class="bar2 a2 bg-info lt"></span>
										<span class="bar3 a3 bg-success"></span>
										<span class="bar4 a4 bg-warning dk"></span>
										<span class="bar5 a5 bg-danger dker"></span>
									</span>
								</a>
								<div class="dropdown-menu dropdown-menu-lg pull-right">
									<div class="list-group him-notification">
										<div class="lg-header">
											音乐
										</div>
										<iframe id="MusicPlayer" nowid="" frameborder="no" style="position:relative;top:-5px;height:52px;width:100%;" src="//music.163.com/outchain/player?type=<?=$WebConfig['Music']['Type']?>&id=<?=$WebConfig['Music']['Id']?>&auto=<?=$WebConfig['Music']['Auto']?>&height=32"></iframe>
									</div>
								</div>
							</li>
							<?php } ?>
							<li>
								<a title="首页" href="<?=U('Index')?>">
									<i class="him-icon fa fa-home"></i>
								</a>
							</li>
							<li>
								<a title="同学录" href="<?=U('Book')?>">
									<i class="him-icon fa fa-book"></i>
								</a>
							</li>
							<li>
								<a title="相册" href="<?=U('Image')?>">
									<i class="him-icon fa fa-image"></i>
								</a>
							</li>
						<!--<li class="dropdown">
								<a data-toggle="dropdown" href="#">
									<i class="him-icon fa fa-bell"></i>
									<i class="him-counts">9</i>
								</a>
								<div class="dropdown-menu dropdown-menu-lg pull-right">
									<div class="list-group him-notification">
										<div class="lg-header">
											提醒
											<ul class="actions">
												<li class="dropdown">
													<a href="" data-ma-action="clear-notification">
														<i class="fa fa-check-square-o"></i>
													</a>
												</li>
											</ul>
										</div>
										<div class="lg-body">
											<a class="list-group-item media" href="">
												<div class="pull-left">
													<img class="lgi-img" src="http://q1.qlogo.cn/g?b=qq&nk=408214421&s=640" alt="">
												</div>
												<div class="media-body">
													<div class="lgi-heading">绚丽彩虹 评论了你的说说：</div>
													<small class="lgi-text">不错不错.....这个很6...不错不错.....这个很6...不错不错.....这个很6...</small>
												</div>
											</a>
											<a class="list-group-item media" href="">
												<div class="pull-left">
													<img class="lgi-img" src="/assets/img/head/1.jpg" alt="">
												</div>
												<div class="media-body">
													<div class="lgi-heading">绚丽彩虹 评论了你的说说：</div>
													<small class="lgi-text">不错不错.....这个很6...不错不错.....这个很6...不错不错.....这个很6...</small>
												</div>
											</a>
											<a class="list-group-item media" href="">
												<div class="pull-left">
													<img class="lgi-img" src="/assets/img/head/1.jpg" alt="">
												</div>
												<div class="media-body">
													<div class="lgi-heading">绚丽彩虹 评论了你的说说：</div>
													<small class="lgi-text">不错不错.....这个很6...不错不错.....这个很6...不错不错.....这个很6...</small>
												</div>
											</a>
											<a class="list-group-item media" href="">
												<div class="pull-left">
													<img class="lgi-img" src="/assets/img/head/1.jpg" alt="">
												</div>
												<div class="media-body">
													<div class="lgi-heading">绚丽彩虹 评论了你的说说：</div>
													<small class="lgi-text">不错不错.....这个很6...不错不错.....这个很6...不错不错.....这个很6...</small>
												</div>
											</a>
											<a class="list-group-item media" href="">
												<div class="pull-left">
													<img class="lgi-img" src="/assets/img/head/1.jpg" alt="">
												</div>
												<div class="media-body">
													<div class="lgi-heading">绚丽彩虹 评论了你的说说：</div>
													<small class="lgi-text">不错不错.....这个很6...不错不错.....这个很6...不错不错.....这个很6...</small>
												</div>
											</a>
										</div>
										<a class="view-more" href="">查看全部</a>
									</div>
								</div>
							</li>-->
						</ul>
					</li>
				</ul>
			</header>
			<section id="main">
				<aside id="sidebar" class="sidebar c-overflow">
					<div class="s-profile">
						<a href="#" data-ma-action="profile-menu-toggle" style="background:url(<?=GetUserCardBg($UserInfo)?>) left bottom;">
							<div class="sp-pic">
								<img src="<?=UserHead($UserInfo['HeadUrl'])?>" alt="">
							</div>
							<div class="sp-info">
								<?=$UserInfo['Username']?>
								<i class="fa fa-caret-down"></i>
							</div>
						</a>
						<ul class="main-menu">
							<li>
								<a href="<?=U('Page','Index','Me')?>"><i class="fa fa-user"></i> 我的首页</a>
							</li>
							<li>
								<a href="<?=U('Page','Head','Me')?>"><i class="fa fa-edit"></i> 更换头像</a>
							</li>
							<li>
								<a href="<?=U('Login','Logout')?>"><i class="fa fa-power-off"></i> 退出登录</a>
							</li>
						</ul>
					</div>
					<?php if($mod != 'Admin'){ ?>
					<ul class="main-menu">
						<?php
						foreach($Sidebar as $i=>$row){
							foreach($row['Option'] as $row2){
								$continue=false;
								switch($row2){
									case 'Admin':
										if($UserGroup['Type'] != 'Admin') $continue = true;
									break;
								}
							}
							if($continue) continue;
							if($row['Type'] == 0)@list($tmpMod,$tmpMod2,$tmpType) = explode('/',$row['Url']);
							?>
							<li class="<?=($mod == $tmpMod ? 'active' : '')?>">
								<a href="<?=($row['Type'] == 0 ? U($tmpMod,$tmpMod2,$tmpType) : $row['Url'])?>" <?=($row['Type'] == 1 ? 'target="_blank"' : '')?>><i class="fa fa-<?=$row['Icon']?>"></i> <?=$row['Title']?></a>
							</li>
							<?php 
							unset($tmpMod,$tmpMod2,$tmpType);
						}
						?>
					</ul>
					<?php }else{ ?>
					<ul class="main-menu">
						<li>
							<a href="<?=U('Index')?>"><i class="fa fa-arrow-circle-left"></i> 返回前台</a>
						</li>
						<li class="<?=($mod2 == 'Index' ? 'active' : '')?>">
							<a href="<?=U('Admin','Index')?>"><i class="fa fa-home"></i> 控制台首页</a>
						</li>
						<li class="<?=($mod2 == 'WebConfig' ? 'active' : '')?>">
							<a href="<?=U('Admin','WebConfig')?>"><i class="fa fa-cog"></i> 站点配置</a>
						</li>
						<li class="<?=($mod2 == 'Notice' ? 'active' : '')?>">
							<a href="<?=U('Admin','Notice')?>"><i class="fa fa-edit"></i> 信息配置</a>
						</li>
						<li class="<?=($mod2 == 'User' ? 'active' : '')?>">
							<a href="<?=U('Admin','User')?>"><i class="fa fa-user"></i> 用户管理</a>
						</li>
						<li class="<?=($mod2 == 'Image' ? 'active' : '')?>">
							<a href="<?=U('Admin','Image')?>"><i class="fa fa-image"></i> 相册管理</a>
						</li>
						<li class="<?=($mod2 == 'Comment' ? 'active' : '')?>">
							<a href="<?=U('Admin','Comment')?>"><i class="fa fa-comment"></i> 留言管理</a>
						</li>
						<li class="<?=($mod2 == 'Update' ? 'active' : '')?>">
							<a href="<?=U('Admin','Update')?>"><i class="fa fa-refresh fa-spin"></i> 检测更新</a>
						</li>
						<li>
							<a target="blank" href="http://txl.xlch8.cn/?mod=help&id=10"><i class="fa fa-question"></i> 管理员使用教程</a>
						</li>
						<li>
							<a href="<?=U('Login','Logout')?>"><i class="fa fa-power-off"></i> 退出登录</a>
						</li>
					</ul>
					<?php } ?>
				</aside>
				<section id="content">