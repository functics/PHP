window.onload = function(){

    var oBtn  = document.getElementById('submit');
    var oImg  = document.getElementById('org_img');
    var oText = document.getElementById('code');
    var value = oImg.alt;

    oBtn.onclick = function(){

        var ajax = new Ajax();
        ajax.post("work.php",{org_img:value},function(data){
            oText.value = data;
        });
    };

    oImg.onclick = function(){
        this.src = 'show_captcha.php?tm='+Math.random();
    }
}