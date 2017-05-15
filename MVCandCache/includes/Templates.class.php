<?php
	
  /**
	* 模版类
	*/
	class Templates{

	    //用数组动态接收变量
        private $vars = array();
        //保存系统变量
        private $config = array();

		//创建一个构造方法来验证文件目录是否存在
		public function __construct(){

			if ( !is_dir(TPL_DIR) || !is_dir(TPL_C_DIR) || !is_dir(CACHE)) {
				exit(' ERROR : 模版目录或编译目录或缓存目录不存在!请手工设置! ');
			}

			//保存系统变量
            $sysV = simplexml_load_file('config/sys.xml');
			$tagLib = $sysV->xpath('/root/taglib');

			foreach($tagLib as $key){
			    $this->config["$key->name"] = $key->value;
            }
            //print_r($this->config);
		}

        //assign方法用于注入变量
        public function assign($var,$value){
		    if (isset($var) && !empty($var)){
                $this->vars[$var] = $value;
            }else{
                exit("ERROR : 请设置模版变量");
            }

        }

		//display方法
        public function display($file){
            //设置模版的路径
            $tplFile = TPL_DIR.$file;
            //判断模版是否存在
            if (!file_exists($tplFile)){
                exit('ERROR : 模版文件不存在!');
            }
            //生成编译文件过程
            $parFile = TPL_C_DIR.md5($file).$file.'.php';   //编译文件的目录
            //缓存文件
            $cacheFile = CACHE.md5($file).$file.'.html';
            //当第二次运行相同文件的时候直接载入缓存文件
            //判断和缓存是否开启,编译文件和缓存文件是否存在
            if (DEBUG){
                if (file_exists($parFile) && file_exists($cacheFile)){
                    //判断模版文件是否修改过,并且判断编译文件是否修改过
                    if (filemtime($parFile) >= filemtime($tplFile) && filemtime($cacheFile) >= filemtime($parFile)){
                        //载入缓存文件
                        include $cacheFile;
                        return;
                    }
                }
            }
            //判断是否存在编译文件,没有的话生成
            if (!file_exists($parFile) || (filemtime($parFile) < filemtime($tplFile))){
                //引入模版解析类
                require ROOT_PATH.'/includes/Parser.class.php';
                $parser = new Parser($tplFile);
                $parser->compile($parFile); //编译文件
            }
            //载入编译文件,开启缓存后就不载入编译文件了
            include $parFile;
            if (DEBUG){
                //获取缓冲区的数据,并且创建缓存文件
                file_put_contents($cacheFile,ob_get_contents());
                //清除缓冲区(清除了编译文件加载的内容)
                ob_end_clean();
                //载入缓存文件
                include $cacheFile;
            }
        }
	}