$(function(){

		$('#signIn').click(function(){
			$('#box_bg').show();
			$('#box_lg').fadeIn(200);
			$(".main-panel ul>li").eq(1).trigger('click');
			return false;
		})	
		$('#signUp').click(function(){
			$('#box_bg').show();
			$('#box_lg').fadeIn(200);
			$(".main-panel ul>li").eq(0).trigger('click');
			return false;
		})	
		$('#login-close').click(function(){
			$('#box_lg').fadeOut(200);
			$('#box_bg').hide();
		})

		// 登录注册切换logo
		$(".main-panel ul>li").click(function () {
	        $(this).addClass('tab-act').siblings('li').removeClass('tab-act');
	        var id=$(this).index();
	        if(id==0){
	            $(".tab-side").animate({"marginLeft":"18px"},200);
	            $(".sign-up").show();
	            $(".sign-in").hide();
	        }else{
	            $(".tab-side").animate({"marginLeft":"94px"},200);
	            $(".sign-in").show();
	            $(".sign-up").hide();
	        }

	    })

	    //验证码刷新
	    $(".sign-vfy img").click(function () {

	        $(this).attr("src","../verify/get_num.php?"+Math.random());
	    });

	    //社交工具登录
	    $('.label>span').click(function () {
	        $(".sign-icon").fadeToggle(200);
	    })

	    //注册用户
	    $("#btn-sign-up").click(function () {
	        if($("#signUpName").val()&&$("#signUpSno").val()&&$("#signUpPassword").val()){
	            $.post("../verify/chk_num.php",{code:$('#verify').val()},function(data){
	                if(data==1){
	                    $.post("server/login.php?k=1",$("#sign-up-form").serialize(), function (rps) {

	                        if(rps==="exist user") {
	                            alert("该用户已经存在");
	                        }
	                        else{
	                            location.pathname="Dhk/index.php";
	                        }

	                    });
	                }
	                else{
	                    alert('验证码错误');
	                }
	            })
	        }
	        else{
	            alert("请输入完整的注册信息！");
	        }
	    });

	    //用户登录
	    $("#btn-sign-in").click(function () {
	        if($("#loginInName").val()&&$("#loginInPassword").val()){
	            $.post("server/login.php?k=2",$("#sign-in-form").serialize(), function (rps) {

	                if(rps==="no user"){
	                    alert("不存在该用户");
	                }else if(rps==="no"){
	                    alert("密码错误");
	                }
	                else{
	                    location.pathname="Dhk/index.php";
	                }
	            })
	        }
	        else{
	            alert("请输入完整的登录信息！");
	        }
	    })

})