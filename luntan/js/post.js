/**
 * Created by 子兴的期盼 on 2016/11/26.
 */
window.onload = function(){
    var ubb = document.getElementById("ubb");
    var ubbspan = ubb.getElementsByTagName("span");
    var form = document.getElementsByTagName("form")[0];
    var textarea = document.getElementsByTagName("textarea")[0];
    var font = document.getElementById("font");
    var html = document.getElementsByTagName("html")[0];
    var color = document.getElementById("color");
    var q = document.getElementById("q");
    var qa = q.getElementsByTagName("a");

    qa[0].onclick = function(){
        window.open('q.php?num=9&path=tietu/1/','q','width=400,height=400,scrollbars=1');
    };
    qa[1].onclick = function(){
        window.open('q.php?num=4&path=tietu/2/','q','width=400,height=400,scrollbars=1');
    };
    qa[2].onclick = function(){
        window.open('q.php?num=5&path=tietu/3/','q','width=400,height=400,scrollbars=1');
    };

    //字体
    html.onmouseup = function(){
        font.style.display = 'none';
        color.style.display = 'none';
    };
    ubbspan[0].onclick = function(){
        font.style.display = 'block';
    };

    //粗体
    ubbspan[2].onclick = function(){
        content("[b][/b]");
    };
    //斜体
    ubbspan[3].onclick = function(){
        content("[i][/i]");
    };
    //下划线
    ubbspan[4].onclick = function(){
        content("[u][/u]");
    };
    //删除线
    ubbspan[5].onclick = function(){
        content("[s][/s]");
    };

    //颜色
    ubbspan[7].onclick = function(){
        color.style.display = 'block';
        form.t.focus();
    };
    //超链接
    ubbspan[8].onclick = function(){
        var url = prompt("请输入网址 :","http://");
        if (url){
            if (/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+$/.test(url)) {
                content("[url]" + url + "[/url]");
            }else{
                alert("网址不合法!");
            }
        }
    };
    //邮箱
    ubbspan[9].onclick = function(){
        var email = prompt("请输入邮箱 :","@");
        if (email){
            if (/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/.test(email)) {
                content("[email]" + email + "[/email]");
            }else{
                alert("邮箱不合法!");
            }
        }
    };
    //图片
    ubbspan[10].onclick = function(){
        var img = prompt("请输入图片地址 :","");
        if (img){
            content("[img]"+img+"[/img]");
        }
    };
    //Flash
    ubbspan[11].onclick = function(){
        var flash = prompt("请输入flash网址 :","http://");
        if (flash){
            if (/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)+/.test(flash)) {
                content("[flash]" + flash + "[/flash]");
            }else{
                alert("flash网址不合法!");
            }
        }
    };

    //文本框高度增大
    ubbspan[18].onclick = function(){
        textarea.rows += 2;
    };
    //文本框高度缩小
    ubbspan[19].onclick = function(){
        textarea.rows -= 2;
    };



    //写入文本框的方法
    function content(string){
        form.content.value += string;
    }
    //颜色下的文本框
    form.t.onclick = function(){
        showcolor(this.value);
    }

    //回复楼层
    var re = document.getElementsByName("re");
    for (var i=0;i<re.length;i++){
        re.onclick = function(){
            document.getElementsByTagName("form")[0].title.value = this.title;
        };
    }
};

//字体
function font(size){
    document.getElementsByTagName("form")[0].content.value += '[size='+size+'][/size]';
}

//颜色
function showcolor(value){
    document.getElementsByTagName("form")[0].content.value += '[color='+value+'][/color]';
}