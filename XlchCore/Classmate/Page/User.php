<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName',$UInfo['Username'].' 的个人主页 - 账户设置');
if($val == 'ChangePassword'){
	if($UserInfo['Password'] == getArgs('Password')){
		if(!preg_match('/^[a-zA-Z0-9\_\.\!\@\#\$\%\^\&\*\(\)]{6,20}$/',getArgs('NewPassword'))){
			$RInfo=[
				'T'=>'修改失败',
				'C'=>'red',
				'I'=>'密码格式错误，只能为数字字母下划线以及英文标点符号，且最短6位最长20位！'
			];
			return false;
		}
		if(getArgs('NewPassword') != getArgs('NewPasswordTwice')){
			$RInfo=[
				'T'=>'修改失败',
				'C'=>'red',
				'I'=>'确认密码错误！请输入和密码一致的内容！'
			];
			return false;
		}
		$Mysql->query('update xlch_user set Password = "'.daddslashes(getArgs('NewPassword')).'" where ID = "'.$UserInfo['ID'].'"');
		$RInfo=[
			'T'=>'修改成功！',
			'I'=>'您的新密码为：'.daddslashes(getArgs('NewPassword')).'，请牢记您的密码！<br>点击确认后将会重新登录。',
			'C'=>'green'
		];
		return false;
	}else{
		$RInfo=[
			'T'=>'修改失败',
			'I'=>'当前密码不正确！',
			'C'=>'red'
		];
		return false;
	}
}
if($val == 'ChangeQuestion'){
	if($UserInfo['Safe_Answer'] == getArgs('Safe_Answer')){ //没毛病
		if(!getArgs('Safe_Question_New') && !$UserInfo['Safe_Question']){
			$RInfo=[
				'T'=>'修改失败',
				'I'=>'密保问题不能为空！',
				'C'=>'red'
			];
			return false;
		}
		if(!getArgs('Safe_Answer_New')){
			$RInfo=[
				'T'=>'修改失败',
				'I'=>'新密保答案不能为空！',
				'C'=>'red'
			];
			return false;
		}
		$Mysql->query('update xlch_user set Safe_Answer = "'.daddslashes(htmlspecialchars(getArgs('Safe_Answer_New'))).'"'.(getArgs('Safe_Question_New') ? ',Safe_Question = "'.daddslashes(htmlspecialchars(getArgs('Safe_Question_New'))).'"' : '').' where ID = "'.$UserInfo['ID'].'"');
		$RInfo=[
			'T'=>'修改成功！',
			'I'=>'您已经成功修改密保，请您务必牢记！',
			'C'=>'green'
		];
		return false;
	}else{
		$RInfo=[
			'T'=>'修改失败',
			'I'=>'密保答案不正确！',
			'C'=>'red'
		];
		return false;
	}
}