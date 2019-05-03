<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>检测更新</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h2>版本更新
						<small>您能够在这里一键更新到最新版本。</small>
					</h2>
				</div>
				<div class="card-body card-padding">
					<h2 class="c-blue">当前版本：<?=$Version ?> <small>(<?=$Version_ ?>)</small></h2>
					<h2 class="c-<?=($IsNew ? 'red' : 'blue')?>">最新版本：<?=$NewVersionData['Version'] ?> <small>(<?=$NewVersionData['VersionId'] ?>)</small></h2>
					<?php if($IsNew){ ?>
					<a href="<?=U('Admin','Update','Update')?>" class="btn btn-block bgm-green">点击更新</a>
					<?php }else{ ?>
					<a class="btn btn-block bgm-red" disabled=disabled>已是最新版</a>
					<?php } ?>
				</div>
			</div>
			<div class="card">
				<div class="card-header">
					<h2>更新记录
						<small>您能够在这里查看历史更新内容。</small>
					</h2>
				</div>
				<div class="card-body card-padding">
					<?php foreach($VersionData as $row){ ?>
					<h2>☆ <?=$row['Version'] ?> <small>(<?=$row['VersionId'] ?>)</small></h2>
					<p>更新内容：</p>
					<ul>
					<?php foreach($row['UpdateLog'] as $row2){ ?>
						<li><?=$row2?></li>
					<?php } ?>
					</ul>
					<p>更新时间：<?=$row['Time'] ?></p>
					<hr></hr>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer')); ?>