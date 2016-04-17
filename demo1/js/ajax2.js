/**
 * Created by zws on 2016/4/10.
 */

var strList;

function  queryList(user){
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
            strList=xhr.responseText;
            showList(user);
        }
    }
    xhr.open("GET","showList.php?u="+user,true);
    xhr.send(null);
}

function showList(u){
    var ary=strList.split('|');
    var time=ary[0];

    $("#conlist span:eq(0)").text(time).addClass('contit');
    $("#conlist span:eq(1)").html("<i class='fa fa-chevron-down' id='icon1'></i>");

    for(var i=1;i<ary.length;i++){
        $("#conlist >ul").append("<li>"+ary[i]+"</li>");

        $('#conlist >ul>li').eq(i-1).slideDown(400).bind('click', function () {
            queryDetail('1',time,this.innerText,u);
        });

    }
}