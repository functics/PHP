/**
 * Created by 子兴的期盼 on 2016/11/20.
 */
window.onload = function(){
    var form = document.getElementsByTagName('form')[0];
    form.onsubmit = function(){
        //判断内容长度
        if(this.content.value.length > 200){
            alert("不能大于200个字符");
            this.content.focus();
            return false;
        }
    }
};