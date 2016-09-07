/**
 * Created by zws on 2016/5/30.
 */

$(function(){

    var Avgall=0;  //所有点评均分和
    var numc=0;   //点评数量
    var numf=0;   //关注数量
    var flg;

    $.get("server/getdetail.php",{Cno:s,type:1},function(data){

        showdetail(data);

    },"json");

    function showdetail(data){

        var course=data;
        numc=course['Cnoc'];
        numf=course['Cnof'];
        $('title').text("课程查询--"+course['Cname']);

        $(".cou-tit").prepend(course['Cname']);
        $(".cno").text(course['Cno']);
        $(".part").text(course['Cpart']);
        $(".time").text(course['Ctime']);
        $(".collage").text(course['Ccollage']);
        $(".teacher").text(course['Cteacher']);
        $(".des").text(course['Cders']);
        $(".cou-img img").attr("src","img/courseImg/"+course['Cimg']);
        $(".guanzhu").append(" ("+course['Cnof']+") ");
        $(".dianpin").append(" ("+course['Cnoc']+") ");

        $(".write").attr("href","write.php?Cname="+course['Cname']+"&Cteacher="+course['Cteacher']+"&Cno="+course['Cno']);

    }

    $.get("server/getdetail.php",{Cno:s,type:2}, function (data) {
        showcomments(data);
    },"json");

    function showcomments(data){

        var len=data.length;

        if(data==0){
            $(".comment").append("<span>该课程还没用相关点评</span>");
        }

        for(var i=0;i<len;i++)
        {
            var com=data[i];

            $(".comment").append('<div class="com-item"><div class="com-left"><img width="100px" height="100px" class="com-img"></div><div class="com-right"></div></div> ');
            $div=$('.com-item').eq(i);
            $div.find('img').attr("src","img/accountImg/"+com['cimg']);
            $div.find('.com-left').append("<p class='com-user'>"+com['cuser']+"</p>").append("<img class='com-icon'>");
            $div.find(".com-right").append("<p class='com-level'></p>").append("<p class='com-content'>"+com['content']+"</p>");
            $div.find(".com-right").append("<span class='com-time'>"+(i+1)+"楼 "+com['cdate']+"</span>")

            var avg=(com['sco']);
            Avgall+=avg;
            var icon=getIcon(avg);

            $div.find(".com-icon").attr("src","img/start/"+icon+".jpg");

            if(com['level']==1){
                $div.find(".com-level").text("简单");
            }
            else if(com['level']==2){
                $div.find(".com-level").text("中等");
            }
            else{
                $div.find(".com-level").text("困难");
            }
            $div.find(".com-level").addClass("level-"+com['level']);
        }

        if(numc>0){
            Avgall/=numc;
            Avgall=Avgall.toFixed(1);  //保留一位小数
            $(".fenshu").text(Avgall);

        }

    }

    function getIcon(a){
        if(a==2){
            return "start1";
        }
        else if(a>2 && a<4){
            return "start1-h";
        }
        else if(a==4){
            return "start2";
        }
        else if(a>4 && a<6){
            return "start2-h";
        }
        else if(a==6){
            return "start3";
        }
        else if(a>6 && a<8){
            return "start3-h";
        }
        else if(a==8){
            return "start4";
        }
        else if(a>8 && a<10){
            return "start4-h";
        }
        else {
            return "start5";
        }
    }


    //检测是否用户是否关注了课程
    $.get("server/getdetail.php",{Cno:s,type:5}, function (data) {

        showfocus(data);
    });
    function showfocus(data){

        flg=data;

        if(flg==1){
            $(".guanzhu").empty().text("已关注 ("+numf+")");
            $(".cou-tit a:first").css("color","#9f9d9e");
        }
        else{
            $(".guanzhu").empty().text("加关注 ("+numf+")");
            $(".cou-tit a:first").css("color","#60bce3");
        }
    }

    //点击关注按钮
    $(".cou-tit a:first").click(function () {

        if(flg==0){
            numf++;
            $(".guanzhu").empty().text("已关注 ("+numf+")");
            flg=1;
            $(".cou-tit a:first").css("color","#9f9d9e");
            $.get("server/getdetail.php",{Cno:s,type:3});

        }
        else{
            numf--;
            $(".guanzhu").empty().text("加关注 ("+numf+")");
            flg=0;
            $(".cou-tit a:first").css("color","#60bce3");
            $.get("server/getdetail.php",{Cno:s,type:4});

        }

    })

})