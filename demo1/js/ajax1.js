/**
 * Created by zws on 2016/4/10.
 */
var str;

function Write(){
    var context=document.getElementById('context').value;
    var header=document.getElementById('header').value;
    var user=document.getElementById('lg').innerText;
    if(user==="登录"){
        alert("请先登录");return;
    }
    if(context.length==0){
        alert("内容不能为空");return;
    }
    if(header.length==0)
    {
        alert("标题不能为空");return;
    }

    var xhr;
    if(window.XMLHttpRequest){
        xhr=new XMLHttpRequest();
    }
    else{
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200)
        {
            str=xhr.responseText;
            alert("成功插入时光册");
            Show(user);
            document.getElementById('context').value="";
            document.getElementById('header').value="";

        }
    }
    xhr.open("POST","server.php",true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send("u="+user+"&c="+context+"&h="+header);
}

function Show(u){
    var t=str.substr(0,10);
    var h=str.substr(10);

    $("#conlist > ul").append("<li>"+h+"</li>");

    $("#conlist > ul >li:last").slideDown(400).bind('click', function () {
        queryDetail('1',t,this.innerText,u);
    });
}