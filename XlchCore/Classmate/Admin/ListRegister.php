<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Reuest!</h1> <hr /> Powered By Xlch-AdminPHP');

define('PageName','批量导入用户');
if($Type == 'Save'){
	$Usernames = str_replace("\r","\n",getArgs('Usernames'));
	$Usernames = explode("\n",$Usernames);
	$Usernames = array_values(array_filter($Usernames));
	
	$showMsg = '';
	
	foreach($Usernames as $row){
		$Username = daddslashes($row);
		if(!preg_match('/^[\x7f-\xff·]{2,40}$/',$Username)){
			$showMsg.='<p>用户[<font color=blue>'.$Username.'</font>]：<font color=red>姓名只能是中文。(名字中带点请使用·)</font></p>';
		}else if($Mysql->get_row('select ID from xlch_user where Username = "'.$Username.'"')){
			$showMsg.='<p>用户[<font color=blue>'.$Username.'</font>]：<font color=red>用户已经注册过了。</font></p>';
		}else{
			$Password = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
			$sql='INSERT INTO `xlch_user` set
				`Username`="'.$Username.'" , 
				`Password`="'.$Password.'", 
				`RegIP`="'.daddslashes(real_ip()).'", 
				`RegCity`="手动注册", 
				`HeadUrl`="/Upload/Default/Head.png", 
				`RegDate`="'.date($DatetimeFormat).'", 
				`UserData`="'.daddslashes(json_encode($DefaultUserData)).'"';
			$Mysql->query($sql);
			
			$Users[] = [
				'Username'=>$Username,
				'Password'=>$Password
			];
		}
	}
	
	$showMsg.=($showMsg ? '<hr>' : '').'<p>统计：成功['.count($Users).']个，失败['.(count($Usernames)-count($Users)).']个。</p>';
	
	$showMsg.='<hr>
<table border="1" style="line-height: 36px;font-size: 25px;">
    <thead>
		<tr>
			<th>用户名</th>
			<th>密码</th>
		</tr>
	</thead>
    <tbody>';
	foreach($Users as $row){
		$showMsg.='
		<tr>
			<td>'.$row['Username'].'</td>
			<td>'.$row['Password'].'</td>
		</tr>';
	}
	$showMsg.='
	</tbody>
</table>';
	
	$showMsg.='<p>温馨提示：您可以复制表格到word打印。</p>';
	
	$RInfo=[
		'T'=>'批量操作结果',
		'I'=>$showMsg,
		'C'=>'green'
	];
	return false;
}