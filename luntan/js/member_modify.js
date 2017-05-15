/**
 * Created by 子兴的期盼 on 2016/11/18.
 */

window.onload = function() {

    //验证码
    var code = document.getElementById("code");
    code.onclick = function () {
        this.src = 'code.php?tm=' + Math.random();
    };

    //头像修改
    var faceimg = document.getElementById('faceimg');

    faceimg.onclick = function (){
        window.open('face.php','face','width=400,height=400,top=0,left=0,scrollbars=1');
    };

    //js验证修改
    var form = document.getElementsByTagName('form')[0];
    form.onsubmit = function(){
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
        return true;
    }
};

