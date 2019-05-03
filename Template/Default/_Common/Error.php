<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T("_Common/Header")); ?>
<div class="container container-alt">
	<div class="card">
		<div class="card-header bgm-<?php echo $RInfo["C"]; ?>">
			<h2><?php echo $RInfo["T"]; ?></h2>
		</div>
		<div class="card-body card-padding row">
			<div class="col-md-12"><h3><?php echo $RInfo["I"]; ?></h3></div>
			<div class="col-md-6 col-xs-6"><a class="btn btn-block bgm-purple" href="<?php echo U("Index"); ?>">返回首页</a></div>
			<div class="col-md-6 col-xs-6"><a class="btn btn-block bgm-green" href="<?php if($RInfo["U"]){echo $RInfo["U"];}else{echo "javascript:history.go(-1);";} ?>">返回上一页</a></div>
		</div>
	</div>
</div>
<?php include(T("_Common/Footer")); ?>