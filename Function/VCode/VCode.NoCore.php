<?php
/*
	炫酷的动态验证码

	By.绚丽彩虹 QQ787700998 / 悦咚 / Dark495
	
	仅在PHP5.6及以上版本才能显示动态效果


*/
session_start();
$_vc = new ValidateCode();
if (version_compare(PHP_VERSION, '5.6') >= 0) {
    for ($a = 0; $a < 5; $a++) {
        ob_start();
        $_vc->doimg();
        $_vc->outPut();
        $imagedata[] = ob_get_clean();
    }
    $gif = new GIFEncoder($imagedata);
    Header('Content-type:image/gif');
    echo $gif->GetAnimation();
} else {
    $_vc->doimg();
    Header('Content-type:image/png');
    $_vc->outPut();
}
$_SESSION["VCode"] = $_vc->getCode();
class ValidateCode {
    private $charset = 'QWERTYPASDFGHJKLZXCBNM23456789'; //随机因子
    private $code; //验证码
    private $codelen = 4; //验证码长度
    private $width = 200; //宽度
    private $height = 50; //高度
    private $img; //图形资源句柄
    private $font; //指定的字体
    private $fontsize = 50; //指定字体大小
    private $fontcolor; //指定字体颜色
    private $BGcolor = ""; //指定字体颜色
    //构造方法初始化
    public function __construct() {
        $this->font = dirname(__FILE__) . '/ttf/Mirvoshar.ttf'; //注意字体路径要写对，否则显示不了图片
        
    }
    //生成随机码
    public function createCode() {
        if ($this->code) {
            return;
        }
        $_len = strlen($this->charset) - 1;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->code.= $this->charset[mt_rand(0, $_len) ];
        }
    }
    //生成背景
    public function createBg() {
        $this->img = imagecreatetruecolor($this->width, $this->height);
        if (!$this->BGcolor) {
            $this->BGcolor = imagecolorallocate($this->img, mt_rand(157, 255) , mt_rand(157, 255) , mt_rand(157, 255));
        }
        imagefilledrectangle($this->img, 0, $this->height, $this->width, 0, $this->BGcolor);
    }
    //生成文字
    public function createFont() {
        $_x = $this->width / $this->codelen;
        for ($i = 0; $i < $this->codelen; $i++) {
            $this->fontcolor = imagecolorallocate($this->img, mt_rand(0, 156) , mt_rand(0, 156) , mt_rand(0, 156));
            imagettftext($this->img, $this->fontsize, mt_rand(0, 10) , $_x * $i + mt_rand(1, 5) , $this->height / 1, $this->fontcolor, $this->font, $this->code[$i]);
        }
    }
    //生成线条、雪花
    public function createLine() {
        //线条
        for ($i = 0; $i < 6; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(0, 156) , mt_rand(0, 156) , mt_rand(0, 156));
            imageline($this->img, mt_rand(0, $this->width) , mt_rand(0, $this->height) , mt_rand(0, $this->width) , mt_rand(0, $this->height) , $color);
        }
        //雪花
        for ($i = 0; $i < 100; $i++) {
            $color = imagecolorallocate($this->img, mt_rand(200, 255) , mt_rand(200, 255) , mt_rand(200, 255));
            imagestring($this->img, mt_rand(1, 5) , mt_rand(0, $this->width) , mt_rand(0, $this->height) , '*', $color);
        }
    }
    //输出
    public function outPut() {
        if (version_compare(PHP_VERSION, '5.6') >= 0) {
            imagegif($this->img);
        } else {
            imagepng($this->img);
        }
        imagedestroy($this->img);
    }
    //对外生成
    public function doimg() {
        $this->createBg();
        $this->createCode();
        $this->createLine();
        $this->createFont();
    }
    //获取验证码
    public function getCode() {
        return strtolower($this->code);
    }
}
Class GIFEncoder {
    var $GIF = "GIF89a"; /* GIF header 6 bytes    */
    var $VER = "GIFEncoder V2.06"; /* Encoder version       */
    var $BUF = Array();
    var $LOP = 0;
    var $DIS = 2;
    var $COL = - 1;
    var $IMG = - 1;
    var $ERR = Array(
        'ERR00' => "Does not supported function for only one image!",
        'ERR01' => "Source is not a GIF image!",
        'ERR02' => "Unintelligible flag ",
        'ERR03' => "Could not make animation from animated GIF source",
    );
    function GIFEncoder($GIF_src, $GIF_dly = 100, $GIF_lop = 0, $GIF_dis = 0, $GIF_red = 0, $GIF_grn = 0, $GIF_blu = 0, $GIF_mod = 'bin') {
        if (!is_array($GIF_src) && !is_array($GIF_tim)) {
            printf("%s: %s", $this->VER, $this->ERR['ERR00']);
            exit(0);
        }
        $this->LOP = ($GIF_lop > - 1) ? $GIF_lop : 0;
        $this->DIS = ($GIF_dis > - 1) ? (($GIF_dis < 3) ? $GIF_dis : 3) : 2;
        $this->COL = ($GIF_red > - 1 && $GIF_grn > - 1 && $GIF_blu > - 1) ? ($GIF_red | ($GIF_grn << 8) | ($GIF_blu << 16)) : -1;
        for ($i = 0, $src_count = count($GIF_src); $i < $src_count; $i++) {
            if (strToLower($GIF_mod) == "url") {
                $this->BUF[] = fread(fopen($GIF_src[$i], "rb") , filesize($GIF_src[$i]));
            } elseif (strToLower($GIF_mod) == "bin") {
                $this->BUF[] = $GIF_src[$i];
            } else {
                printf("%s: %s ( %s )!", $this->VER, $this->ERR['ERR02'], $GIF_mod);
                exit(0);
            }
            if (substr($this->BUF[$i], 0, 6) != "GIF87a" && substr($this->BUF[$i], 0, 6) != "GIF89a") {
                printf("%s: %d %s", $this->VER, $i, $this->ERR['ERR01']);
                exit(0);
            }
            for ($j = (13 + 3 * (2 << (ord($this->BUF[$i] {
                10
            }) & 0x07))) , $k = TRUE; $k; $j++) {
                switch ($this->BUF[$i] {
                        $j
                }) {
                    case "!":
                        if ((substr($this->BUF[$i], ($j + 3) , 8)) == "NETSCAPE") {
                            printf("%s: %s ( %s source )!", $this->VER, $this->ERR['ERR03'], ($i + 1));
                            exit(0);
                        }
                        break;

                    case ";":
                        $k = FALSE;
                        break;
                }
            }
        }
        GIFEncoder::GIFAddHeader();
        for ($i = 0, $count_buf = count($this->BUF); $i < $count_buf; $i++) {
            GIFEncoder::GIFAddFrames($i, $GIF_dly[$i]);
        }
        GIFEncoder::GIFAddFooter();
    }
    function GIFAddHeader() {
        $cmap = 0;
        if (ord($this->BUF[0] {
            10
        }) & 0x80) {
            $cmap = 3 * (2 << (ord($this->BUF[0] {
                10
            }) & 0x07));
            $this->GIF.= substr($this->BUF[0], 6, 7);
            $this->GIF.= substr($this->BUF[0], 13, $cmap);
            $this->GIF.= "!\377\13NETSCAPE2.0\3\1" . GIFEncoder::GIFWord($this->LOP) . "\0";
        }
    }
    function GIFAddFrames($i, $d) {
        $Locals_str = 13 + 3 * (2 << (ord($this->BUF[$i] {
            10
        }) & 0x07));
        $Locals_end = strlen($this->BUF[$i]) - $Locals_str - 1;
        $Locals_tmp = substr($this->BUF[$i], $Locals_str, $Locals_end);
        $Global_len = 2 << (ord($this->BUF[0] {
            10
        }) & 0x07);
        $Locals_len = 2 << (ord($this->BUF[$i] {
            10
        }) & 0x07);
        $Global_rgb = substr($this->BUF[0], 13, 3 * (2 << (ord($this->BUF[0] {
            10
        }) & 0x07)));
        $Locals_rgb = substr($this->BUF[$i], 13, 3 * (2 << (ord($this->BUF[$i] {
            10
        }) & 0x07)));
        $Locals_ext = "!\xF9\x04" . chr(($this->DIS << 2) + 0) . chr(($d >> 0) & 0xFF) . chr(($d >> 8) & 0xFF) . "\x0\x0";
        if ($this->COL > - 1 && ord($this->BUF[$i] {
            10
        }) & 0x80) {
            for ($j = 0; $j < (2 << (ord($this->BUF[$i] {
                10
            }) & 0x07)); $j++) {
                if (ord($Locals_rgb{3 * $j + 0}) == ($this->COL >> 0) & 0xFF && ord($Locals_rgb{3 * $j + 1}) == ($this->COL >> 8) & 0xFF && ord($Locals_rgb{3 * $j + 2}) == ($this->COL >> 16) & 0xFF) {
                    $Locals_ext = "!\xF9\x04" . chr(($this->DIS << 2) + 1) . chr(($d >> 0) & 0xFF) . chr(($d >> 8) & 0xFF) . chr($j) . "\x0";
                    break;
                }
            }
        }
        switch ($Locals_tmp{0}) {
            case "!":
                $Locals_img = substr($Locals_tmp, 8, 10);
                $Locals_tmp = substr($Locals_tmp, 18, strlen($Locals_tmp) - 18);
                break;

            case ",":
                $Locals_img = substr($Locals_tmp, 0, 10);
                $Locals_tmp = substr($Locals_tmp, 10, strlen($Locals_tmp) - 10);
                break;
        }
        if (ord($this->BUF[$i] {
            10
        }) & 0x80 && $this->IMG > - 1) {
            if ($Global_len == $Locals_len) {
                if (GIFEncoder::GIFBlockCompare($Global_rgb, $Locals_rgb, $Global_len)) {
                    $this->GIF.= ($Locals_ext . $Locals_img . $Locals_tmp);
                } else {
                    $byte = ord($Locals_img{9});
                    $byte|= 0x80;
                    $byte&= 0xF8;
                    $byte|= (ord($this->BUF[0] {
                        10
                    }) & 0x07);
                    $Locals_img{9} = chr($byte);
                    $this->GIF.= ($Locals_ext . $Locals_img . $Locals_rgb . $Locals_tmp);
                }
            } else {
                $byte = ord($Locals_img{9});
                $byte|= 0x80;
                $byte&= 0xF8;
                $byte|= (ord($this->BUF[$i] {
                    10
                }) & 0x07);
                $Locals_img{9} = chr($byte);
                $this->GIF.= ($Locals_ext . $Locals_img . $Locals_rgb . $Locals_tmp);
            }
        } else {
            $this->GIF.= ($Locals_ext . $Locals_img . $Locals_tmp);
        }
        $this->IMG = 1;
    }
    function GIFAddFooter() {
        $this->GIF.= ";";
    }
    function GIFBlockCompare($GlobalBlock, $LocalBlock, $Len) {
        for ($i = 0; $i < $Len; $i++) {
            if ($GlobalBlock{3 * $i + 0} != $LocalBlock{3 * $i + 0} || $GlobalBlock{3 * $i + 1} != $LocalBlock{3 * $i + 1} || $GlobalBlock{3 * $i + 2} != $LocalBlock{3 * $i + 2}) {
                return (0);
            }
        }
        return (1);
    }
    function GIFWord($int) {
        return (chr($int & 0xFF) . chr(($int >> 8) & 0xFF));
    }
    function GetAnimation() {
        return ($this->GIF);
    }
}