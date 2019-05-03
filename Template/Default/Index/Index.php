<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header'));?>
<div class="container">
	<div class="block-header">
		<h2>
			班级中心
			<small>您可以在这里快速获取班级最新动态！</small>
		</h2>
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header bgm-cyan">
					<h2>公告栏</h2>
				</div>
				<div class="card-body card-padding">
					<?php include(AppDir.'/Config/SysConfig/Info/Notice.php'); ?>
				</div>
			</div>
			<div class="card">
				<div class="card-header bgm-green">
					<h2>功能一览</h2>
				</div>
				<div class="card-body card-padding row">
					<div class="col-md-3 col-sm-6 col-xs-6">
						<a href="<?=U('Page','Index','Me')?>">
							<div class="bgm-pink brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-user fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">我的主页</h2>
							</div>
						</a>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<a href="<?=U('Book')?>">
							<div class="bgm-blue brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-book fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">同学录</h2>
							</div>
						</a>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<a href="<?=U('Image')?>">
							<div class="bgm-orange brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-image fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">班级相册</h2>
							</div>
						</a>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<a href="<?=U('Comment')?>">
							<div class="bgm-purple brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-comment fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">留言板</h2>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header bgm-red">
					<h2>随机推荐</h2>
				</div>
				<div class="card-body card-padding row">
					<div class="contacts clearfix row">
						<?php foreach($I['Rand'] as $Info){ ?>
						<div class="col-md-2 col-xs-4">
							<div class="c-item">
								<a href="" class="ci-avatar">
									<img src="<?=UserHead($Info['HeadUrl'])?>" alt="">
								</a>
								<div class="c-info">
									<strong><?=$Info['Username']?></strong>
									<small><?=$Info['UserData']['Public']['Sign']?></small>
								</div>
								<div class="c-footer">
									<a href="<?=U('Page','Index',$Info['ID'])?>"><button class="waves-effect"><i class="fa fa-home"></i> 访问主页
									</button></a>
								</div>
							</div>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<?php $Info=$UserInfo; include(T('_Common/UserCard'));?>
		</div>
		<div class="col-md-12">
			<?php include(T('_Common/Image')); ?>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer'));?>