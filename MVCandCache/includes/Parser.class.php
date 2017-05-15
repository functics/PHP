<?php

/*
 * 模版解析类
 */
 class Parser{

     private $tplFile;

     //构造方法 ->获取模版文件内容
     public function __construct($tplFile){
         if (!$this->tplFile = file_get_contents($tplFile)){
            exit('ERROR : 模版文件读取错误!');
         }
     }

     //解析普通变量
     private function compileVar(){
         $patten = '/\{\$([\w]+)\}/';
         if (preg_match($patten, $this->tplFile)){
            $this->tplFile = preg_replace($patten,"<?php echo \$this->vars['$1']; ?>", $this->tplFile);
         }
     }

     //解析if语句
     private function compileIF(){
         $pattenStartIF = '/\{if\s+\$([\w]+)\}/';
         $pattenEndIF= '/\{\/if\}/';
         $pattenElse = '/\{else\}/';
        if (preg_match($pattenStartIF, $this->tplFile)){
            if (preg_match($pattenEndIF, $this->tplFile)){
                $this->tplFile = preg_replace($pattenStartIF, "<?php if (\$this->vars['$1']){ ?>", $this->tplFile); //转换if头
                $this->tplFile = preg_replace($pattenEndIF, '<?php } ?>', $this->tplFile);       //转换if尾
                if (preg_match($pattenElse, $this->tplFile)){
                    $this->tplFile = preg_replace($pattenElse,"<?php } else { ?>",$this->tplFile);
                }
            }else{
                exit('ERROR :　if语句没有关闭!');
            }
        }
     }

     //解析php注释 -----#注释(annotation)
     private function compileAnnotation(){
        $patten = '/\{#\}(.*)\{#\}/';
        if (preg_match($patten,$this->tplFile)){
            $this->tplFile = preg_replace($patten, '<?php /* $1 */ ?>',$this->tplFile);
        }
     }

     //解析foreach语句
     private function compileForeach(){
         $pattenStartForeach = '/\{foreach\s+\$([\w]+)\(([\w]+),([\w]+)\)\}/';
         $pattenMiddleForeach = '/\{@([\w]+)\}/';
         $pattenEndForeach = '/\{\/foreach\}/';
        if (preg_match($pattenStartForeach, $this->tplFile)){
            if (preg_match($pattenEndForeach, $this->tplFile)){
                $this->tplFile = preg_replace($pattenStartForeach, "<?php foreach(\$this->vars['$1'] as \$$2 => \$$3){ ?>", $this->tplFile);
                $this->tplFile = preg_replace($pattenEndForeach, '<?php } ?>', $this->tplFile);
                if (preg_match($pattenMiddleForeach,$this->tplFile)){
                    $this->tplFile = preg_replace($pattenMiddleForeach, "<?php echo \$$1;?>", $this->tplFile);
                }
            }else{
                exit('ERROR : foreach标签没有闭合!');
            }
        }
     }

     //解析include
     private function compileInclude(){
         $patten = '/\{include\s+file\s+=\s+\'([\w\.\_]+)\'\}/';
         if (preg_match($patten, $this->tplFile, $file)){
             if (!file_exists($file[1]) || empty($file[1])){
                exit('ERROR : 包含文件出错!');
             }
             $this->tplFile = preg_replace($patten,"<?php include '$1';?>",$this->tplFile);
         }
     }

     //解析系统变量
     private function compileSysV(){
         $patten = '/<!--\{([\w]+)\}-->/';
         if (preg_match($patten, $this->tplFile)){
             $this->tplFile = preg_replace($patten,"<?php echo \$this->config['$1']; ?>",$this->tplFile);
         }
     }

     //对外公共方法
     public function compile($parFile){
        //解析模版内容
        $this->compileVar();
        $this->compileIF();
        $this->compileAnnotation();
        $this->compileForeach();
        $this->compileInclude();
        $this->compileSysV();
        //生成编译文件
        if (!file_put_contents($parFile, $this->tplFile)){
            exit('ERROR : 编译文件生成错误!');
        }
     }
 }