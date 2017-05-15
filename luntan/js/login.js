/**
 * Created by 子兴的期盼 on 2016/11/12.
 */
//验证码
window.onload = function() {
    var code = document.getElementById("code");
    code.onclick = function(){
        this.src = 'code.php?tm='+Math.random();
    };
    //登录验证
    var form = document.getElementsByTagName("form")[0];
    form.onsubmit= function(){
        //用户名验证
        if (form.username.value.length < 2 || form.username.value.length > 20){
            alert("请检查用户名长度!");
            form.username.focus();//将光标移至表单字段
            return false;
        }
        if (/[<>\'\"\ \　]/.test(form.username.value)){
            alert("用户名不能包含非法字符!");
            form.username.focus();//将光标移至表单字段
            return false;
        }
        //密码验证
        if (form.password.value.length < 6){
            alert("密码不能小于6位");
            form.password.value = "";//清空表单
            form.password.focus();//将光标移至表单字段
            return false;
        }
        //验证码验证
        if (form.yzm.value.length != 4){
            alert("验证码长度错误!");
            form.yzm.value = "";
            form.yzm.focus();
            return false;
        }
        return ture;
    };
};