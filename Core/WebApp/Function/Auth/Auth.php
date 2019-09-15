<?php
class XlchAuth {
	var $AuthInfo=null;
	var $authKey='xlch_shop_authcode';
	var $safeKey='xlch_txl_safe';
	function __construct($AuthInfo){
		$this->AuthInfo=$AuthInfo;
	}
	private function get_curl($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		$httpheader[] = "Accept:application/json";
		$httpheader[] = "Accept-Encoding:gzip,deflate,sdch";
		$httpheader[] = "Accept-Language:zh-CN,zh;q=0.8";
		$httpheader[] = "Connection:close";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, FALSE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'XlchAuth V1.0');
		curl_setopt($ch, CURLOPT_ENCODING, "gzip");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_NOSIGNAL,true);
		curl_setopt($ch, CURLOPT_TIMEOUT,10); 
		$ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
	}
	public function CheckAuth(){
		return;
		global $authInfoCache;
		$url='http://api.shop.xlch8.cn/func/API/AuthCheck.html?Args='.urlencode(authcode(json_encode($this->AuthInfo),'ENCODE',$this->authKey));

		$data=$this->get_curl($url);
		
		//防止授权服务器宕机
		if($return = json_decode(authcode($data,'DECODE',$this->authKey),true)){
			file_put_contents(AppDir . '/Config/Auth/cache.php', '<?php return "'.$data.'"; ?>');
		}else{
			$return = json_decode(authcode($authInfoCache,'DECODE',$this->authKey),true);
		}

		if($return){
			switch($return['Code']){
				case -1:
					SysInfo([
						'Code'=>'40301',
						'Title'=>'XlchAuth - 绚丽彩虹授权验证系统',
						'Info'=>$return['Message'],
						'Text'=>'1.您下载了该程序但是没有进行授权<br>2.您是盗版程序的受害者<br>3.<a target="_blank" href="http://shop.xlch8.cn/Item/Show/'.$this->AuthInfo['ItemId'].'.html">点击进入授权购买页面</a>'
					]);
				break;
				case -2:
					SysInfo([
						'Code'=>'40302',
						'Title'=>'XlchAuth - 绚丽彩虹授权验证系统',
						'Info'=>$return['Message'],
						'Text'=>'1.您违反了该程序的《用户使用协议》<br>2.联系作者进行解决'
					]);
				break;
				case -3:
					SysInfo([
						'Code'=>'40303',
						'Title'=>'XlchAuth - 绚丽彩虹授权验证系统',
						'Info'=>$return['Message'],
						'Text'=>'1.您违反了绚丽彩虹商城的《用户协议》<br>2.您违反了该程序的《用户使用协议》<br>3.联系 绚丽彩虹 进行解决'
					]);
				break;
				case -4:
					SysInfo([
						'Code'=>'40304',
						'Title'=>'XlchAuth - 绚丽彩虹授权验证系统',
						'Info'=>$return['Message'],
						'Text'=>'1.卖家下架/删除了该程序，您无法继续使用。<br>2.联系作者进行解决。'
					]);
				break;
				case 1:
					$_SESSION['xlch_auth']=time();
				break;
				default:
					SysInfo([
						'Code'=>'40305',
						'Title'=>'XlchAuth - 绚丽彩虹授权验证系统',
						'Info'=>$return['Message'],
						'Text'=>$return['Text']
					]);
				break;
			}
		}else{
			SysInfo([
				'Code'=>'40300',
				'Title'=>'XlchAuth - 绚丽彩虹授权验证系统',
				'Info'=>'连接授权服务器失败',
				'Text'=>'1.您的空间没有提供外网访问权限<br>2.授权服务器宕机<br>3.被防火墙拦截'
			]);
		}
	}
	public function CheckSafe(){
		return;
		$url='http://api.txl.xlch8.cn/SafeCheck.php?Args='.urlencode(authcode(json_encode($this->AuthInfo),'ENCODE',$this->safeKey));

		$return=$this->get_curl($url);
		$return=@json_decode(authcode($return,'DECODE',$this->safeKey),true);
		
		if($return){
			switch($return['Code']){
				case 1:
				SysInfo([
					'Code'=>'40310',
					'Title'=>'XlchAuth - 绚丽彩虹安全验证系统',
					'Info'=>$return['Message'],
					'Text'=>'1.您正在提交不安全的参数<br>2.你打算做一些不好的事情'
				]);
				break;
				case 0:
					$_SESSION['xlch_safe']=time();
				break;
				default:
					SysInfo([
						'Code'=>'40311',
						'Title'=>'XlchAuth - 绚丽彩虹授权验证系统',
						'Info'=>$return['Message'],
						'Text'=>$return['Text']
					]);
				break;
			}
		}
			
	}
}	
$XlchAuth=new XlchAuth([
	'ItemId'=>1,
	'AuthCode'=>$AuthCode,
	'Domain'=>$_SERVER['HTTP_HOST'],
	'IsCheckAuthcode'=>false,
	'Cookie'=>$_COOKIE
]);

if(!class_exists('XlchAuth')){
	SysInfo([
		'Code'=>'40320',
		'Title'=>'XlchAuth - 绚丽彩虹安全验证系统',
		'Info'=>'绚丽彩虹授权验证系统损坏',
		'Text'=>'1.您干了点不好的事情导致授权系统无法正常工作。'
	]);
}else{
	if(!isset($_SESSION['xlch_safe']) && IsLogin() && $GroupInfo[$UserInfo['Group']]['Type'] == 'Admin') {
		$XlchAuth->CheckSafe();
	}
	if((!isset($_SESSION['xlch_auth']) or $_SESSION['xlch_auth'] + 600 < time()) && IsLogin() && $GroupInfo[$UserInfo['Group']]['Type'] == 'Admin') {
		$XlchAuth->CheckAuth();
	}
}