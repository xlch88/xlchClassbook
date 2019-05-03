<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>选择引导页模板</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header bgm-cyan">
					<h2>选择引导页模板
						<small>选择一个符合您班级风格的模板。</small>
					</h2>
				</div>
				<div class="card-body card-padding">
					<div class="row">
						<div class="col-md-8">
							<img src="/assets/img/welcome/view/<?=$WebConfig['Info']['Welcome']['Page']?>.jpg" class="img-responsive img-thumbnail" />
						</div>
						<div class="col-md-4">
							<h2>当前使用：<br /><b><?=$I['WelcomeTemplateList'][$WebConfig['Info']['Welcome']['Page']]['Name']?></b></h2>
							<hr />
							<p>ＩＤ：<?=$WebConfig['Info']['Welcome']['Page']?></p><br />
							<p>作者：<?=$I['WelcomeTemplateList'][$WebConfig['Info']['Welcome']['Page']]['Author']?></p><br />
							<p>介绍：<br /><?=$I['WelcomeTemplateList'][$WebConfig['Info']['Welcome']['Page']]['Info']?></p>
						</div>
					</div>
					<hr />
					<div class="row">
						<?php foreach($I['WelcomeTemplateList'] as $id=>$row){ ?>
						
						<div class="col-md-4 col-sm-6 col-xs-6">
							<a href="<?=U('Admin','SelectWelcomeTemplate','Save',null,"Id=$id")?>">
								<div class="bgm-cyan brd-2 p-15 m-b-20 c-white">
									<div class="text-center">
										<img src="/assets/img/welcome/view/<?=$id ?>.jpg" class="img-responsive img-thumbnail" />
										<h4 class="c-white"><b><?=$I['WelcomeTemplateList'][$id]['Name']?></b></h4>
									</div>
									<p>ＩＤ：<?=$id ?></p>
									<p>作者：<?=$I['WelcomeTemplateList'][$id]['Author']?></p>
									<p>介绍：<br /><?=$I['WelcomeTemplateList'][$id]['Info']?></p>
								</div>
							</a>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer')); ?>