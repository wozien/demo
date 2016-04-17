/**
 * Created by zws on 2016/4/10.
 */
var strDetail;
var time;
var header;

function queryDetail(id,t,str,user){

    var xhr;
    time=t;
    header=str;
    if(window.XMLHttpRequest){
        xhr=new XMLHttpRequest();
    }
    else{
        xhr=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange=function(){
        if(xhr.readyState==4 && xhr.status==200)
        {
            strDetail=xhr.responseText;
            showDetail();

        }
    }
    xhr.open("GET","showDetail.php?h="+str+"&k="+id+"&u="+user,true);
    xhr.send(null);
}

function showDetail(){
    if(strDetail.length>0){
        $("#box_bg").fadeIn(100);
        $("#box_lg").slideDown(200);
        $("#box_lg .header").text(header);
        $("#box_lg .context").text(strDetail);
        $("#box_lg .time").text(time);

        $("#box_lg .close").click(function () {
            $("#box_bg").fadeOut(100);
            $("#box_lg").slideUp(200);
        })
    }
    else{
        $("#box_lg").css("display","none");
        $("#box_bg").css("display","none");
        alert("删除成功");

        $li1=$("#conlist ul>li");
        for(var i= 0,len=$li1.length;i<len;i++)
        {
            if($li1.eq(i).text()===header){
                $li1.eq(i).remove();
            }
        }
        $li2=$("#hoslist>ul>li");
        for(var i= 0,len=$li2.length;i<len;i++)
        {
            if($li2.eq(i).text()===header){
                $li2.eq(i).remove();
            }
        }
    }

}