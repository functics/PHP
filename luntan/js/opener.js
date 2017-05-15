/**
 * Created by 子兴的期盼 on 2016/11/4.
 */
window.onload = function(){
    var img = document.getElementsByTagName('img');
    for(i=0;i<img.length;i++){
        img[i].onclick = function(){
            _opener(this.src);
        };
    }
};
function _opener(src){
    var faceimg = window.opener.document.getElementById('faceimg').src = src;
    window.opener.document.getElementById('face').value = src;
    // opener.document.register.face.value = src;//等价上边语句
}