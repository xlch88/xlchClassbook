<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');
?>
<?php include(T('Page/Header'));?>
<div class="pmb-block">
	<div class="pmbb-header">
		<h2><i class="fa fa-book m-r-10"></i> 修改密码</h2>
	</div>
	<form action="<?=U('Page','User',$Type,'ChangePassword')?>" method="post" id="ChangePassword" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">当前密码</label>
			<div class="col-sm-10">
				<div class="fg-line">
					<input type="text" class="form-control input-sm" id="Password" required name="Password" placeholder="您账户现在的密码">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">新密码</label>
			<div class="col-sm-10">
				<div class="fg-line">
					<input type="password" class="form-control input-sm" id="NewPassword" required name="NewPassword" placeholder="要修改的新密码">
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">确认新密码</label>
			<div class="col-sm-10">
				<div class="fg-line">
					<input type="password" class="form-control input-sm" id="NewPasswordTwice" required name="NewPasswordTwice" placeholder="再输一遍新密码">
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-danger btn-lg btn-block waves-effect">确认修改</button>
			</div>
		</div>
	</form>
	<div class="pmbb-header">
		<h2><i class="fa fa-book m-r-10"></i> 修改密保</h2>
	</div>
	<form action="<?=U('Page','User',$Type,'ChangeQuestion')?>" method="post" id="ChangeQuestion" class="form-horizontal">
		<div class="form-group">
			<label class="col-sm-2 control-label">密保问题</label>
			<div class="col-sm-10">
				<div class="fg-line">
					<?=($UserInfo['Safe_Question'] ? $UserInfo['Safe_Question'] : '未设置')?>
				</div>
			</div>
		</div>
		<?php if($UserInfo['Safe_Question']){ ?>
		<div class="form-group">
			<label class="col-sm-2 control-label">密保答案</label>
			<div class="col-sm-10">
				<div class="fg-line">
					<input type="text" class="form-control input-sm" id="Safe_Answer" name="Safe_Answer" placeholder="您现在的密保答案" required>
				</div>
			</div>
		</div>
		<?php } ?>
		<div class="form-group">
			<label class="col-sm-2 control-label">新密保问题</label>
			<div class="col-sm-10">
				<div class="fg-line">
					<input type="text" class="form-control input-sm" id="Safe_Question_New" name="Safe_Question_New" placeholder="<?=($UserInfo['Safe_Question'] ? '不填写不进行修改' : '必填')?>" <?=($UserInfo['Safe_Question'] ? '' : 'required')?>>
					密保问题说明：请输入您的同学不知道的信息（比如母亲姓名，小学班主任姓名），以免被您的同学猜到而恶意重置您的密码！
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">新密保答案</label>
			<div class="col-sm-10">
				<div class="fg-line">
					<input type="text" class="form-control input-sm" id="Safe_Answer_New" name="Safe_Answer_New" placeholder="必填" required>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-primary btn-lg btn-block waves-effect">确认修改</button>
			</div>
		</div>
	</form>
	
</div>
<?php include(T('Page/Footer'));?>