<?php
//URL处理模块
$Url=$_GET["s"] ?? '';
unset($_GET["s"]);
//是否启用伪静态文件
define('PhpUrl',!$Rewrite);

if($Url != '' && (substr($Url,0,strlen(Url_Header)) !== Url_Header || substr($Url,-strlen(Url_Footer)) !== Url_Footer)){
	SysInfo([
		'Code'=>'40401',
		"Info"=>"您访问的页面地址有误。",
	]);
}

$Url=substr($Url,strlen(Url_Header),-strlen(Url_Footer));
$Url=array_values(explode(Url_Explode,$Url));
foreach($Url as $i=>$v){
	$Url[$i]=strFilter($Url[$i]);
	if($v == null) unset($Url[$i]);
}
$Url=array_values($Url);
if($Url && $Url[0]=="func"){
	unset($Url[0]);
	$Url=array_values(($Url));
	@list($func,$do,$Type,$val,$val2,$val3,$val4,$val5,$val6,$val7,$val8,$val9)=htmlspecialchars2($Url);
}else{
	@list($mod,$mod2,$Type,$val,$val2,$val3,$val4,$val5,$val6,$val7,$val8,$val9)=htmlspecialchars2($Url);
	if(!$mod) $mod=($IsWelcome ? "Welcome" : $DefaultMod);
}
foreach(["func","do","Type","mod","mod2","Type","val","val2","val3","val4","val5","val6","val7","val8","val9"] as $row){
	if(isset($_GET["_".$row]))$$row=$_GET["_".$row];
	if(isset($_POST["_".$row]))$$row=$_POST["_".$row];
}
function U($mod = false,$mod2 = false,$Type = false,$val = false,$get = false){
	$U = '';
	if($mod && !$mod2 && !$Type){
		$U.=$mod;
	}else{
		if($mod){
			$U.=$mod.($mod2 ? Url_Explode : "");
		}
		if($mod2){
			$U.=$mod2.($Type ? Url_Explode : "");
		}
		if($Type){
			$U.=$Type.((isset($val) && $val !== false) ? Url_Explode : "");
		}
	}
	if(isset($val) && $val !== false){
		if(!is_array($val)){
			$val=[$val];
		}
		$U.=implode(Url_Explode,$val);
	}
	return (PhpUrl===true ? "/index.php?s=" : "/").Url_Header.$U.Url_Footer.($get ? (PhpUrl===true ? "&$get" : "?$get") : "");
}
function TOURL($U,$T = "T",$M = "提示"){
	$To="<script>";
	if($U=="-"){
		$U="history.go(-1);";
	}else{
		$U="window.location.href='$U';";
	}
	if($T=="M"){
		$To.="alert('$M');$U";
	}else if($T=="IM"){
		$To.="if(confirm('$M')){".$U."}else{history.go(-1);}";
	}else{
		$To.=$U;
	}
	$To.="</script>";
	exit($To);
}