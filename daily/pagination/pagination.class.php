<?php
/*
 *
 *
 */

class pagination{
      private $total;    //总记录数
      private $nums;     //每页显示的条数
      private $pages;    //总页数
      private $cPage;    //当前页
      private $url;      //当前的url

      public function __construct($total,$nums){
        $this->total = $total;
        $this->nums = $nums;
        $this->pages = $this->getPages();

        //获取当前页
        $this->cPage = !empty($_GET['page'])?$_GET['page'] : 1;
      }

      //获取页数
      private function getPages(){
        return ceil($this->total/$this->nums);
      }

      private function fristPage(){

        //如果当前页是第一页,则不显示这些
        if($this->cPage > 1) {

            $prev = $this->cPage - 1;
            return '<a href = "'.$this->url.'?page=1">首页</a> <a href = "'.$this->url.'?page='.$prev.'">上一页</a>';
        }else{
           return "";
       }
     }

      private function pagesList(){
        $list = "";
        $num = 2;//当前页左右两边的页码数量

        //当前页之前的设置
        for ($i=$num; $i >= 1 ; $i--) {
            //列表之后的
            $page = $this->cPage - $i;
            //如果在页数内页显示
            if ($page > 1) {
                $list .='&nbsp;<a href = "'.$this->url.'?page='.$page.'">'.$page.'</a>&nbsp;';
            }else{
                break;
            }
        }

        //当前页的设置

            if ($this->pages > 1) {
                $list .= $this->cPage."&nbsp";
            }

        //当前页之后的设置
            for ($i=1; $i <= $num ; $i++) {
            //列表之后的
                $page = $this->cPage + $i;
            //如果在页数内页显示
                if ($page <= $this->pages) {
                    $list .='&nbsp;<a href = "'.$this->url.'?page='.$page.'">'.$page.'</a>&nbsp;';
                }else{
                    break;
                }
            }
            return $list;
        }

        private function lastPage(){
            if($this->cPage < $this->pages) {

                $next = $this->cPage + 1;
                return '<a href = "'.$this->url.'?page='.$next.'">下一页</a> <a href = "'.$this->url.'?page='.$this->pages.'">末页</a> ';
            }else{
               return "";
           }
       }

    //从多少条开始
       private function start(){
        return ($this->cPage-1)*$this->nums+1;
       }

    //从多少条结束
       private function end(){
        return min($this->cPage * $this->nums , $this->total);
       }

    //当前显示的条数
       private function currnum(){
        return $this->end() - $this->start()+1;
       }

      //调用这个方法,就可以获取分页;
       public function pagination(){
        $arr = func_get_args();  //返回一个包含函数参数列表的数组

        $pagination = "";

        $pageArr[0] = "&nbsp;共{$this->total}条记录&nbsp;";
        $pageArr[1] = "&nbsp;本页显示".$this->currnum()."条记录&nbsp;";
        $pageArr[2] = "&nbsp;从".$this->start()."-".$this->end()."条&nbsp;";
        $pageArr[3] = "&nbsp;{$this->cPage}/{$this->pages}&nbsp;";
        $pageArr[4] = "&nbsp;".$this->fristPage()."&nbsp;";
        $pageArr[5] = "&nbsp;".$this->pagesList()."&nbsp;";
        $pageArr[6] = "&nbsp;".$this->lastPage()."&nbsp;";

        if(count($arr) < 1){
        $arr = array(0,1,2,3,4,5,6);
        }
        foreach ($arr as $n) {
            $pagination .= $pageArr[$n];
        }
        return $pagination;

    }
}

?>