<?php
defined('ROOT_DIR') || define('ROOT_DIR', 'D://phpstudy/www/PHP');
defined('PATH') || define('PATH', ROOT_DIR.DIRECTORY_SEPARATOR.'autoLode');

require_once (PATH.'/loader.php');

$loader = new Loader(PATH, array('controller'));

$test1 = new Song();