<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>信息配置</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header bgm-cyan">
					<h2>站点信息配置
						<small>您能够在这里修改首页公告、注册须知等信息。</small>
					</h2>
				</div>
			</div>
			<?php foreach($InfoList as $i=>$row){ ?>
			<div class="card">
				<div class="card-header bgm-green m-b-20">
					<h2><?=$row['Name']?>
						<small><?=$row['Bewrite']?></small>
					</h2>
					<a href="<?=U('Admin','NoticeEdit',$i)?>" class="btn bgm-blue btn-float waves-effect"><i class="fa fa-edit"></i></a>
				</div>
				<div class="card-body card-padding">
					<?php include(AppDir.'/Config/SysConfig/Info/'.$i.'.php');?>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer')); ?>