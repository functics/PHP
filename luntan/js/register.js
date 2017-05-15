/**
 * Created by 子兴的期盼 on 2016/11/4.
 */
window.onload = function(){
    //头像
    var faceimg = document.getElementById('faceimg');
    var code = document.getElementById('code');
    faceimg.onclick = function(){
        window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1');
    }
    code.onclick = function(){
        this.src = 'code.php?tm='+Math.random();
    };

    //表单验证
    //能用客户端验证的尽量用客户端
    var form = document.getElementsByTagName('form')[0];
    form.onsubmit = function(){
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
        //密码确认
        if (form.password.value != form.assure.value){
            alert("两次密码输入不一致!");
            form.password.value = "";//清空表单
            form.assure.value = "";//清空表单
            form.assure.focus();//将光标移至表单字段
            return false;
        }
        //密码提示
        if (form.question.value.length < 2 || form.question.value.length > 20){
            alert("密码提示不能小于2位或者大于20位!");
            form.question.focus();//将光标移至表单字段
            return false;
        }
        //密码回答
        if (form.answer.value.length < 2 || form.answer.value.length > 20){
            alert("密码提示不能小于2位或者大于20位!");
            form.answer.focus();//将光标移至表单字段
            return false;
        }
        //密码提示与密码回答不能相同
        if (form.question.value == form.answer.value){
            alert("密码提示与密码回答不能相同");
            form.answer.value = "";
            form.answer.focus();
            return false;
        }
        //邮箱验证
        if (!/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(form.email.value)){
            alert("邮箱格式错误");
            form.email.focus();
            return false;
        }
        //qq验证
        if (form.qq.value != ""){
            if (!/^[1-9]{1}[0-9]{4,9}$/.test(form.qq.value)){
                alert("qq号码格式不正确!");
                form.qq.focus();
                return false;
            }
        }
        //网址验证
        if (form.url.value !="" && form.url.value != 'http://'){
            if (!/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/.test(form.url.value)){
                alert("主页格式不正确!");
                form.url.focus();
                return false;
            }
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
