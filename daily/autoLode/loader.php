<?php

class  Loader{

	protected $dirs = array();
	protected $basePath = '';


	/**
	 *构造函数
	 */
	public function __construct($basePath, $dirs = array()) {
		$this->setBasePath($basePath);
		if (!empty($dirs)) {
			$this->setDirs($dirs);
		}
		spl_autoload_register(array($this, 'load'));

		// print_r($dirs);
		// var_dump($this);
		// var_dump(array($this, 'load'));
	}

	/**
	 *属性赋值
	 */
	public function setBasePath($basePath){
		$this->basePath = $basePath;    
	}

	public function setDirs($dirs){
		if (!is_array($dirs)){      
			$dirs = array($dirs);
		}
		$this->dirs = array_merge($this->dirs, $dirs);
	}



	 /** ------------------ 内部实现 ------------------ **/

	 /**
	  *自动加载类(这里，之所以在未找到类时没有抛出异常是为了开发人员自动加载或者其他扩展类库有机会进行处理)
	  */
	 public function load($className) {
	 	if (class_exists($className, FALSE) || interface_exists($className, FALSE)) {
	 		//如果类或者接口不存在的话就直接返回
	 		return;
	 	}
	 	foreach ($this->dirs as $dir) {
	 		if ($this->loadClass($this->basePath . DIRECTORY_SEPARATOR . $dir, $className)) {
	 			return;
	 		}
	 	}
	 }

	 protected function loadClass($path, $className) {
	 	$className = strtolower($className);
	 	$toRequireFile = $path . DIRECTORY_SEPARATOR . $className . '.class.php';
	 	// echo $toRequireFile;
	 	if (file_exists($toRequireFile)) {
	 		require_once $toRequireFile;
	 		return true;
	 	}

	 	return false;
	 }

}