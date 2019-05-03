<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('_Common/Header')); ?>
<div class="container">
	<div class="block-header">
		<h2>批量注册</h2>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header bgm-cyan">
					<h2>批量注册账号
						<small>您能够使用这个功能方便快捷的添加全班同学的账号。</small>
					</h2>
				</div>
				<div class="card-body card-padding">
					<form role="form" method="post" action="<?=U('Admin','ListRegister','Save')?>">
						<div class="form-group fg-line">
							<label for="Name">同学姓名</label>
							<textarea name="Usernames" class="form-control" placeholder="在这里输入同学姓名，一行一个。

例如：
何慧
郑丽霞
陈玲玲
王婧" rows=20></textarea>
						</div>
						<button type="submit" class="btn btn-primary btn-block m-t-10 waves-effect">保存</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include(T('_Common/Footer')); ?>