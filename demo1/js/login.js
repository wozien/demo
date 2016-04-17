/**
 * Created by zws on 2016/4/15.
 */
var result;
var t1,t2,t3,t4;
function selForm(k)
{
    //login
    if(k===1){
        var f=document.getElementById('fm1-info');
        t1= f.elements[0];
        t2= f.elements[1];
        if(t1.value=="")
        {
            $(".ipt-gp .tip:eq(0)").addClass('tipempty');return;
        }else{
            $(".ipt-gp .tip:eq(0)").removeClass('tipempty');
        }
        if(t2.value=="")
        {
            $(".ipt-gp .tip:eq(1)").addClass('tipempty');return;
        }else{
            $(".ipt-gp .tip:eq(1)").removeClass('tipempty');
        }
        submitFm("k=1&"+serialize(f));
    }
    //register
    else{
        var f=document.getElementById('fm2-info');
        t1= f.elements[0];
        t2= f.elements[1];
        t3= f.elements[2];
        t4= f.elements[3];
        if(t1.value=="")
        {
            $(".ipt-gp .tip:eq(2)").addClass('tipempty');return;
        }else{
            $(".ipt-gp .tip:eq(2)").removeClass('tipempty');
        }
        if(t3.value=="")
        {
            $(".ipt-gp .tip:eq(4)").addClass('tipempty');return;
        }else{
            $(".ipt-gp .tip:eq(4)").removeClass('tipempty');
        }
        if(t3.value!==t4.value) {
            $(".ipt-gp .tip:eq(5)").addClass('tipempty');return;
        }
        else{
            $(".ipt-gp .tip:eq(5)").removeClass('tipempty');
        }
        submitFm("k=2&"+serialize(f));
    }
}

//表单序列化
function serialize(form)
{
    var res=[];
    var ele, i,len;
    for(i=0,len=form.elements.length;i<len;i++)
    {
        ele=form.elements[i];
        if(ele.name.length>0){
            res.push(encodeURIComponent(ele.name)+"="+encodeURIComponent(ele.value));
        }
    }
    return res.join('&');
}
//把表单通过ajax提交到后台
function submitFm(content){
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
            result=xhr.responseText;
            dealFm();
        }
    }
    xhr.open("POST","test.php",true);
    xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xhr.send(content);
}

function dealFm()
{
    if(result==="登录成功"){
        $("#login .cls").trigger('click');
        $("#lg").text(t1.value).unbind("click");
        $("#rg").text("注销");
        $("#hoslist .histext").show();
        queryList(t1.value);
    }
    else if(result==="注册成功"){
       alert(result);
        $("#register .cls").trigger('click');
        $("#lg").text(t1.value).unbind("click");
        $("#rg").text("注销");
        $("#hoslist .histext").show();
        queryList(t1.value);
    }
    else{
        alert(result);
    }

}