/**
 * Created by 子兴的期盼 on 2016/11/22.
 */
window.onload = function(){
    var all = document.getElementById("all");
    var form =document.getElementsByTagName("form")[0];
    all.onclick = function(){
        //form.elements获取表单内的所有表单
        for (var i=0; i<form.elements.length; i++){
            if (form.elements[i] != 'check_all'){
                form.elements[i].checked = form.check_all.checked;
            }
        }
    };
    form.onsubmit = function(){
        if (confirm('确定要删除?')) {
            return true;
        }
        return false;
    };
};