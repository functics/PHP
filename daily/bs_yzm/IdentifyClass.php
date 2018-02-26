<?php
	class Identify
	{
		public $ImagePath;
		public $ImageSize;

		private $dic = array(
		        '00011000001111000110011011000011110000111100001111000011011001100011110000011000' => 0,
		        '00011000001110000111100000011000000110000001100000011000000110000001100001111110' => 1,
		        '00111100011001101100001100000011000001100000110000011000001100000110000011111111' => 2,
		        '01111100110001100000001100000110000111000000011000000011000000111100011001111100' => 3,
		        '00000110000011100001111000110110011001101100011011111111000001100000011000000110' => 4,
		        '11111110110000001100000011011100111001100000001100000011110000110110011000111100' => 5,
		        '00111100011001101100001011000000110111001110011011000011110000110110011000111100' => 6,
		        '11111111000000110000001100000110000011000001100000110000011000001100000011000000' => 7,
		        '00111100011001101100001101100110001111000110011011000011110000110110011000111100' => 8,
		        '00111100011001101100001111000011011001110011101100000011010000110110011000111100' => 9
	    );


		/**
		 * 获取图片路径
		 */
		public function __construct($ImagePath){
			$this->ImagePath = $ImagePath;
		}
		/**
		 * 测试方法
		 */
		public function test(){
			return $this->getCaptcha();
		}
		/**
		 * 获取验证码
		 */
		public function getCaptcha(){
			$img = @imagecreatefrompng($this->ImagePath);
			@imagepng($img,$this->ImagePath);//从$img图像以$this->ImaggePath为文件名创建一个png图像
			$rgbAarray = array();
			$size = @getimagesize($this->ImagePath);//获取图片大小
			//print_r($size); //结果Array ( [0] => 60 [1] => 36 [2] => 3 [3] => width="60" height="36" [bits] => 8 [mime] => image/png )
			$width = $size['0'];  //获取图片宽度
			$height = $size['1']; //获取图片高度
			for ($i = 0; $i < $height; $i ++) { 
				for ($j=0; $j < $width; $j ++) { 
					$rgb = imagecolorat($img, $j, $i);
					$rgbAarray[$i][$j] = imagecolorsforindex($img, $rgb);
				}
			}
			//var_dump($rgb);//值为int(13948620) 或者int(0)
			//print_r($rgbAarray); 
			/*返回一个具有 red，green，blue 和 alpha  ([0] => Array ( [red] => 212 [green] => 214 [blue] => 204 [alpha] => 0)这是背景  ([0] => Array ( [red] => 0 [green] => 0 [blue] => 0 [alpha] => 0)这是数字       的键名的关联数组，包含了指定颜色索引的相应的值。*/
			$str = [];
			for ($i = 0; $i < $height; $i++) { 
				for ($j=0; $j < $width; $j++) { 
					 if ($i > 12 && $i < 23) {
					 	if ($j > 1 && $j < 55) {
							if ($rgbAarray[$i][$j]['red'] == 212) {
								//echo "□";
								$str[] = "0";
							}else{
								//echo "■";
								$str[] = "1";
							}
						 }
					 }
				}
//				echo "\n\r";
			}
			$temp = array_chunk($str, 53);
			$first_p = "";
			$second_p = "";
			$third_p = "";
			$fourth_p = "";
			for ($i = 0; $i < 10; $i ++) { 
				for ($j=0; $j < 53; $j ++) {
					if ($j < 8) {
						@$first_p.= $temp[$i][$j];
					}
					if ($j > 14 && $j < 23) {
						@$second_p.= $temp[$i][$j];
					}
					if ($j > 29 && $j < 38) {
						@$third_p.= $temp[$i][$j];
					}
					if ($j > 44 && $j < 53) {
						@$fourth_p.= $temp[$i][$j];
					}
				}
			}
		    @$captcha = $this->dic[$first_p] . $this->dic[$second_p] . $this->dic[$third_p] . $this->dic[$fourth_p];
        	return $captcha;
		}
	}
