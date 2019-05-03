<?php
//是否使用了伪静态文件
//如果没有使用的话地址会是这样www.****.com/index.php?s=**********
//如果使用的话地址会是这样www.****.com/*********
$Rewrite=true;


//URL分隔符
define('Url_Header','');
define('Url_Explode','/');
define('Url_Footer','.html');