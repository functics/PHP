<?php
	//开启session
	session_start();
	/**
	  * 验证码类的开始
	  */
	class captcha{
	    //参数
		public $img;
		public $abcd;
		public $color_fill;
		public $color_black;
		//构造函数,写出基本输出
	    public function __construct(){
            header('Content-Type: image/png');
			//创建随机码
			for ($i=0; $i < 4; $i++) {
				$this->abcd .= mt_rand(0,9);
			}
			$_SESSION['code'] = $this->abcd;
			//设置句柄
			$this->img = imagecreatetruecolor(60, 36);
			//填充色设置
			$this->color_fill = imagecolorallocate($this->img, 212, 214, 204);  //#D4D6CC
			$this->color_black = imagecolorallocate($this->img, 0, 0, 0);   //黑色
			//填充
			imagefill($this->img, 0, 0, $this->color_fill);
		}
		//数字
		public function character(){
			for ($i=0; $i < strlen($_SESSION['code']); $i++) { 
				imagestring($this->img, 5, ($i*60)/4+2, 10, $_SESSION['code'][$i], $this->color_black);
			}			
		}

		//输出图片
		public function show(){
			$this->character();
			imagepng($this->img);
			imagepng($this->img,'image/is_png.png');    //png输出流
			imagedestroy($this->img);
		}
 
	}
