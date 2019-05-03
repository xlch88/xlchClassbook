<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>站点配置</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header bgm-cyan">
					<h2>站点功能配置
						<small>您能够在这里修改站点名称、SEO、班级密码等信息。</small>
					</h2>
				</div>
				<div class="card-body card-padding">
						<form class="form-horizontal" target="_blank" method="post" action="<?=U('func','Tool','ImportData')?>">
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<div class="checkbox">
										<label>
											<input type="checkbox" value="true" name="oldDB">
											<i class="input-helper"></i>
											自定义MySQL服务器
										</label>
									</div>
									如果旧程序数据表就在当前的数据库，则无需选择。
									如果旧程序数据表不在当前数据库，请手动填写MySQL连接信息。
								</div>
							</div>
							<div id="MysqlInfo" style="display:none;">
								<div class="form-group">
									<label for="IP" class="col-sm-2 control-label">MySQL连接IP</label>
									<div class="col-sm-10">
										<div class="fg-line">
											<input type="text" class="form-control input-sm" name="IP" id="IP">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="Username" class="col-sm-2 control-label">MySQL用户名</label>
									<div class="col-sm-10">
										<div class="fg-line">
											<input type="text" class="form-control input-sm" name="Username" id="Username">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="Password" class="col-sm-2 control-label">MySQL密码</label>
									<div class="col-sm-10">
										<div class="fg-line">
											<input type="text" class="form-control input-sm" name="Password" id="Password">
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="Port" class="col-sm-2 control-label">MySQL端口</label>
									<div class="col-sm-10">
										<div class="fg-line">
											<input type="text" class="form-control input-sm" name="Port" id="Port">
										</div>
									</div>
								</div>
							</div>
							<script>
							$(function(){
								$('input[name="oldDB"]').change(function(){
									$('#MysqlInfo').toggle();
								})
							});
							</script>
							<hr />
							<div class="form-group">
								<label for="Option_ImageUpload" class="col-sm-2 control-label">要导入的程序</label>
								<div class="col-sm-10">
									<div class="radio">
										<label class="radio">
											<input type="radio" name="oldType" value="ssnhV3" checked>
											<i class="input-helper"></i>似水年华 V3
										</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="fg-line">
										<button class="btn btn-lg bgm-blue btn-block">保存</button>
									</div>
								</div>
							</div>
						</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer')); ?>