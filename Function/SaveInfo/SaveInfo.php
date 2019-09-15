<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

if(!IsLogin()){
	exit(json_encode([
		'Code'=>'-9',
		'Message'=>'未登录！'
	]));
}
if(!$UserInfoList[$Type]){
	exit(json_encode([
		'Code'=>'-8',
		'Message'=>'信息组ID不存在！'
	]));
}
$Info=json_decode(getArgs('Json'),true);
foreach($UserInfoList[$Type]['Key'] as $Key){
	$Value=$Info[$UserInfoList[$Type]['GroupId'].'_'.$Key['Id']];
	if(isset($Value) && $Value!=''){
		if(!in_array($Key['Type'],['Radio','Select','Check'])){
			if($Key['Preg'] != '' && !in_array($Key['Preg'],['base64','between','callback','choice','color','creditCard','cusip','cvv','date','different','digits','ean','emailAddress','file','greaterThan','grid','hex','hexColor','iban','id','identical','imei','imo','integer','ip','isbn','isin','ismn','issn','lessThan','mac','meid','notEmpty','numeric','phone','regexp','remote','rtn','sedol','siren','siret','step','stringCase','stringLength','uri','uuid','vat','vin','zipCode'])){
				if(!preg_match($Key['Preg'].'i',$Value)){
					exit(json_encode([
						'Code'=>'-3',
						'Message'=>$Key['Name'].'格式有误！'
					]));
				}
			}
			if($Key['MinLength']){
				if(mb_strlen($Value,'UTF-8') < $Key['MinLength']){
					exit(json_encode([
						'Code'=>'-4',
						'Message'=>$Key['Name'].'长度错误。'
					]));
				}
			}
			if($Key['MaxLength']){
				if(mb_strlen($Value,'UTF-8') > $Key['MaxLength']){
					exit(json_encode([
						'Code'=>'-4',
						'Message'=>$Key['Name'].'长度错误。'
					]));
				}
			}
		}else{
			if($Key['Type'] == 'Radio' or $Key['Type'] == 'Select'){
				if(!isset($Key['Option'][$Value])){
					exit(json_encode([
						'Code'=>'-4',
						'Message'=>$Key['Name'].'选择错误。'
					]));
				}
			}else if($Key['Type'] == 'Check'){
				foreach($Value as $i=>$b){
					if(!isset($Key['Option'][$b])){
						exit(json_encode([
							'Code'=>'-4',
							'Message'=>$Key['Name'].'选择错误。'
						]));
					}
					$Value[$i]=htmlspecialchars($b);
				}
			}
		}
		$UserInfo['UserData'][$UserInfoList[$Type]['GroupId']][$Key['Id']]=(is_array($Value) ? $Value : htmlspecialchars($Value));
	}
}
$Mysql->query('update xlch_user set UserData = "'.daddslashes(json_encode($UserInfo['UserData'])).'" where ID = "'.$UserInfo['ID'].'"');
exit(json_encode([
	'Code'=>'1',
	'Message'=>'保存成功！'
]));