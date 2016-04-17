/**
 * Created by zws on 2016/4/17.
 */
var user;
var date;
var header;

function searchList(){
    date=document.getElementById('search').value;
    var reg=/^(\d+)\/((0[1-9])|(1[0-2]))\/(([0-2][0-9])|(3[0-1]))$/;
    if(reg.test(date)===true){
        $('#hoslist .tip2').hide();
    }else{
        $('#hoslist .tip2').css('display','block');return;
    }

    var xhr;
    user=$("#lg").text();
    if(window.XMLHttpRequest)
    {
        xhr=new XMLHttpRequest();
    }
    else{
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange= function () {
        if(xhr.readyState===4 && xhr.status===200){
            header=xhr.responseText;
            showsearch();
        }
    }
    xhr.open("GET","search.php?u="+user+"&t="+date,true);
    xhr.send(null);
}

function showsearch(){
    if(header.length===0)
    {
        alert("不存在对应日期的便签");
        return;
    }
    var ary=header.split('|');
    date=ary[0];

    $("#hoslist>span").empty();
    $("#hoslist>ul").empty();
    //console.log(date+"\n"+ary);
    $("#hoslist>span:eq(0)").text(date).addClass('contit');
    $("#hoslist>span:eq(1)").html("<i class='fa fa-chevron-down' id='icon3'></i>");

    for(var i=1;i<ary.length;i++){
        $("#hoslist >ul").append("<li>"+ary[i]+"</li>");

        $('#hoslist >ul>li').eq(i-1).slideDown(200).bind('click', function () {
            queryDetail('1',date,this.innerText,user);
        });

    }


}