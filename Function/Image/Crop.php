<?php
if(!defined("AdminPHP")) exit('<h1 style="color:red">Bad Request!</h1> <hr /> Powered By Xlch-AdminPHP');

ini_set("display_errors", "On");
if(!IsLogin()){
	exit(json_encode([
		'state'	=> 200,
		'message' => '未登录！',
		'result' => 0
	]));
}
if (!function_exists('exif_imagetype')) {
	function exif_imagetype($currFile) {
		list($width, $height, $type2, $attr) = getimagesize($currFile);
		if ($type2 !== false){
			return $type2;
		}
		return false;
	}
}
class CropAvatar {
	private $src;
	private $data;
	private $dst;
	private $type;
	private $extension;
	private $msg;
	private $randstring;

	function __construct($src, $data, $file) {
		$this -> randstring=md5(RandString(2048));
		$this -> setSrc($src);
		$this -> setData($data);
		$this -> setFile($file);
		$this -> crop($this -> src, $this -> dst, $this -> data);
	}

	private function setSrc($src) {
		if (!empty($src)) {
			$type = exif_imagetype($src);

			if ($type) {
				$this -> src = $src;
				$this -> type = $type;
				$this -> extension = image_type_to_extension($type);
				$this -> setDst();
			}
		}
	}

	private function setData($data) {
		if (!empty($data)) {
			$this -> data = json_decode(stripslashes($data));
		}
	}

	private function setFile($file) {
		$errorCode = $file['error'];

		if ($errorCode === UPLOAD_ERR_OK) {
			$type = exif_imagetype($file['tmp_name']);

			if ($type) {
				$extension = image_type_to_extension($type);
				$src = RootDir.'Upload/UserHead/' . date('YmdHis') . '_'.($this->randstring).'.original' . $extension;

				if ($type == IMAGETYPE_GIF || $type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG) {

					if (file_exists($src)) {
						unlink($src);
					}

					$result = move_uploaded_file($file['tmp_name'], $src);

					if ($result) {
						$this -> src = $src;
						$this -> type = $type;
						$this -> extension = $extension;
						$this -> setDst();
					} else {
						 $this -> msg = '无法保存图片，请检查服务器权限是否配置正确。'.$src;
					}
				} else {
					$this -> msg = '图片格式错误，你只能上传：JPG, PNG, GIF';
				}
			} else {
				$this -> msg = '你没有上传图片。';
			}
		} else {
			$this -> msg = $this -> codeToMessage($errorCode);
		}
	}

	private function setDst() {
		$this -> dst = RootDir.'Upload/UserHead/' . date('YmdHis') . '_'.$this -> randstring.'.png';
	}

	private function crop($src, $dst, $data) {
		if (!empty($src) && !empty($dst) && !empty($data)) {
			switch ($this -> type) {
				case IMAGETYPE_GIF:
					$src_img = imagecreatefromgif($src);
					break;

				case IMAGETYPE_JPEG:
					$src_img = imagecreatefromjpeg($src);
					break;

				case IMAGETYPE_PNG:
					$src_img = imagecreatefrompng($src);
					break;
			}

			if (!$src_img) {
				$this -> msg = "无法读取已经上传的图片，请重试。";
				return;
			}

			$size = getimagesize($src);
			$size_w = $size[0]; // natural width
			$size_h = $size[1]; // natural height

			$src_img_w = $size_w;
			$src_img_h = $size_h;

			$degrees = $data -> rotate;

			// Rotate the source image
			if (is_numeric($degrees) && $degrees != 0) {
				// PHP's degrees is opposite to CSS's degrees
				$new_img = imagerotate( $src_img, -$degrees, imagecolorallocatealpha($src_img, 0, 0, 0, 127) );

				imagedestroy($src_img);
				$src_img = $new_img;

				$deg = abs($degrees) % 180;
				$arc = ($deg > 90 ? (180 - $deg) : $deg) * M_PI / 180;

				$src_img_w = $size_w * cos($arc) + $size_h * sin($arc);
				$src_img_h = $size_w * sin($arc) + $size_h * cos($arc);

				// Fix rotated image miss 1px issue when degrees < 0
				$src_img_w -= 1;
				$src_img_h -= 1;
			}

			$tmp_img_w = $data -> width;
			$tmp_img_h = $data -> height;
			global $Type;
			if($Type == 'Photo'){
				$dst_img_w = 500;
				$dst_img_h = 750;
			}else{
				$dst_img_w = 500;
				$dst_img_h = 500;
			}

			$src_x = $data -> x;
			$src_y = $data -> y;

			if ($src_x <= -$tmp_img_w || $src_x > $src_img_w) {
				$src_x = $src_w = $dst_x = $dst_w = 0;
			} else if ($src_x <= 0) {
				$dst_x = -$src_x;
				$src_x = 0;
				$src_w = $dst_w = min($src_img_w, $tmp_img_w + $src_x);
			} else if ($src_x <= $src_img_w) {
				$dst_x = 0;
				$src_w = $dst_w = min($tmp_img_w, $src_img_w - $src_x);
			}

			if ($src_w <= 0 || $src_y <= -$tmp_img_h || $src_y > $src_img_h) {
				$src_y = $src_h = $dst_y = $dst_h = 0;
			} else if ($src_y <= 0) {
				$dst_y = -$src_y;
				$src_y = 0;
				$src_h = $dst_h = min($src_img_h, $tmp_img_h + $src_y);
			} else if ($src_y <= $src_img_h) {
				$dst_y = 0;
				$src_h = $dst_h = min($tmp_img_h, $src_img_h - $src_y);
			}

			// Scale to destination position and size
			$ratio = $tmp_img_w / $dst_img_w;
			$dst_x /= $ratio;
			$dst_y /= $ratio;
			$dst_w /= $ratio;
			$dst_h /= $ratio;

			$dst_img = imagecreatetruecolor($dst_img_w, $dst_img_h);

			// Add transparent background to destination image
			imagefill($dst_img, 0, 0, imagecolorallocatealpha($dst_img, 0, 0, 0, 127));
			imagesavealpha($dst_img, true);

			$result = imagecopyresampled($dst_img, $src_img, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

			if ($result) {
				if (!imagepng($dst_img, $dst)) {
					$this -> msg = "保存图片失败，请检查服务器权限是否配置正确。";
				}
			} else {
				$this -> msg = "剪切图片错误。请检查服务器配置。";
			}

			imagedestroy($src_img);
			imagedestroy($dst_img);
		}
	}

	private function codeToMessage($code) {
		$errors = array(
			UPLOAD_ERR_INI_SIZE =>'图片大小超过 upload_max_filesize 的限制，这个配置项在 php.ini 里',
			UPLOAD_ERR_FORM_SIZE =>'上传的文件超过HTML表单中指定的MAX_FILE_SIZE',
			UPLOAD_ERR_PARTIAL =>'上传的文件仅部分上传',
			UPLOAD_ERR_NO_FILE =>'没有上传文件',
			UPLOAD_ERR_NO_TMP_DIR =>'缺少一个临时文件夹',
			UPLOAD_ERR_CANT_WRITE =>'无法将文件写入磁盘',
			UPLOAD_ERR_EXTENSION =>'文件上传由扩展名停止',
		);

		if (array_key_exists($code, $errors)) {
			return $errors[$code];
		}

		return '未知上传错误。';
	}

	public function getResult() {
		return (($this -> dst or $this -> src) ? '/'.str_replace(RootDir,'',!empty($this -> data) ? $this -> dst : $this -> src) : 0);
	}

	public function getMsg() {
		return $this -> msg;
	}
}

$crop = new CropAvatar(
	isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
	isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
	isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null
);

$response = array(
	'state'	=> 200,
	'message' => $crop->getMsg(),
	'result' => $crop->getResult()
);
if($Type == 'Photo'){
	$UserInfo['UserData']['Public']['Photo']=$crop->getResult();
	$Mysql->query('update xlch_user set UserData = "'.daddslashes(json_encode($UserInfo['UserData'])).'" where ID = '.$UserInfo['ID']);
}else{
	$Mysql->query('update xlch_user set HeadUrl = "'.$crop->getResult().'" where ID = '.$UserInfo['ID']);
}


echo json_encode($response);
