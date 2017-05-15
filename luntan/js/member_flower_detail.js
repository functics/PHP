/**
 * Created by 子兴的期盼 on 2016/11/21.
 */
window.onload = function(){
    var ret = document.getElementById('return');
    var del = document.getElementById('delete');
    //返回
    ret.onclick = function(){
        location.href = 'member_flower.php';
    };
    //删除
    del.onclick = function(){
        location.href = 'member_flower_detail.php?action=delete&id='+this.name;
    };
};