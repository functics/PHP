/**
 * Created by 子兴的期盼 on 2016/11/20.
 */
window.onload = function (){
    var message = document.getElementsByName('message');
    for (i=0;i<message.length;i++){
        message[i].onclick = function(){
            centerWindow('message.php?id='+this.title,'message',250,400);
        };
    }

    var friend = document.getElementsByName('friend');
    for (i=0;i<friend.length;i++){
        friend[i].onclick = function(){
            centerWindow('friend.php?id='+this.title,'friend',250,400);
        };
    }

    var flower = document.getElementsByName('flower');
    for (i=0;i<flower.length;i++){
        flower[i].onclick = function(){
            centerWindow('flower.php?id='+this.title,'flower',250,400);
        };
    }
};
//弹窗在中间的函数
function centerWindow(url,name,height,width){
    var left = (screen.width - width)/2;
    var top = (screen.height - height)/2;
    window.open(url,name,'height='+height+',width='+width+',top='+top+',left='+left);
}
