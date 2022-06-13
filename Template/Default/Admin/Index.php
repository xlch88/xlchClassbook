<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header'));?>
<div class="container container-alt">
	<div class="block-header">
		<h2>管理员控制台</h2>
	</div>
	<div class="mini-charts">
		<div class="row">
			<div class="col-sm-6 col-md-3">
				<div class="mini-charts-item bgm-lightgreen">
					<div class="clearfix">
						<div class="chart stats-bar"><i class="fa fa-fw c-white fa-4x fa-user"></i></div>
						<div class="count">
							<small>用户数量</small>
							<h2><?=$Count['User'];?></h2>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="mini-charts-item bgm-purple">
					<div class="clearfix">
						<div class="chart stats-bar"><i class="fa fa-fw c-white fa-4x fa-image"></i></div>
						<div class="count">
							<small>图片数量</small>
							<h2><?=$Count['Image'];?></h2>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="mini-charts-item bgm-orange">
					<div class="clearfix">
						<div class="chart stats-bar"><i class="fa fa-fw c-white fa-4x fa-folder"></i></div>
						<div class="count">
							<small>图片目录数量</small>
							<h2><?=$Count['Image_Dir'];?></h2>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3">
				<div class="mini-charts-item bgm-bluegray">
					<div class="clearfix">
						<div class="chart stats-bar"><i class="fa fa-fw c-white fa-4x fa-comments"></i></div>
						<div class="count">
							<small>留言数量</small>
							<h2><?=$Count['Comment'];?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header bgm-green m-b-20">
					<h2>数据管理<small>管理您的站点数据。</small></h2>
				</div>
				<div class="card-body card-padding row">
					<div class="col-md-4 col-sm-6 col-xs-6">
						<a href="<?=U('Admin','User')?>">
							<div class="bgm-blue brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-user fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">用户管理</h2>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6">
						<a href="<?=U('Admin','Image')?>">
							<div class="bgm-pink brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-image fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">相册管理</h2>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12">
						<a href="<?=U('Admin','Comment')?>">
							<div class="bgm-orange brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-comments fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">留言管理</h2>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header bgm-blue m-b-20">
					<h2>站点管理<small>配置您的站点信息。</small></h2>
				</div>
				<div class="card-body card-padding row">
					<div class="col-md-4 col-sm-6 col-xs-6">
						<a href="<?=U('Admin','WebConfig')?>">
							<div class="bgm-cyan brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-cog fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">站点配置</h2>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6">
						<a href="<?=U('Admin','Notice')?>">
							<div class="bgm-deeppurple brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-edit fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">信息配置</h2>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6">
						<a href="<?=U('Admin','Update')?>">
							<div class="bgm-red brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-refresh fa-spin fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">程序升级</h2>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6">
						<a href="<?=U('Admin','Import')?>">
							<div class="bgm-orange brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-recycle fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">导入数据</h2>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6">
						<a href="<?=U('Admin','ListRegister')?>">
							<div class="bgm-blue brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-group fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">批量导入账号</h2>
							</div>
						</a>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-6">
						<a href="<?=U('Admin','SelectWelcomeTemplate')?>">
							<div class="bgm-pink brd-2 p-15 text-center m-b-20">
								<div class="c-white m-b-10"><i class="fa fa-home fa-5x"></i></div>
								<h2 class="m-0 c-white f-300">引导页模板</h2>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-header bgm-red m-b-20">
					<h2>绚丽彩虹公告<small>查看关于绚丽彩虹工作室的最新消息。</small></h2>
				</div>
				<div class="card-body card-padding row">
					<h1>_(:з)∠)_ 行了，网站挂了，暂时懒得修了...<br/><br/></h1>
					<p>相关说明：<b><a href="https://github.com/xlch88/xlchClassbook/blob/master/README.md" target="_blank">https://github.com/xlch88/xlchClassbook/blob/master/README.md</a></b><br/><br/></p>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer'));?>