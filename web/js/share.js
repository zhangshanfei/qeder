//rem布局
!function(win) {
	 
		 function resize() {
		  var domWidth = domEle.getBoundingClientRect().width;		 
		  if(domWidth>414){		  	  	  	 
		      domEle.style.fontSize = 100 + "px";
		  }else{
		  	 win.rem = domWidth / 3.75;
		     domEle.style.fontSize = win.rem + "px";
		  }
		 
		 }
		 var v, initial_scale, timeCode, dom = win.document, domEle = dom.documentElement, viewport = dom.querySelector('meta[name="viewport"]'), flexible = dom.querySelector('meta[name="flexible"]');
		 if (viewport) {
				  var o = viewport.getAttribute("content").match(/initial\-scale=(["']?)([\d\.]+)\1?/);
		  if(o){
		   initial_scale = parseFloat(o[2]);
		   v = parseInt(1 / initial_scale);
		  }
		 } else {
		  if (flexible) {
		   var o = flexible.getAttribute("content").match(/initial\-dpr=(["']?)([\d\.]+)\1?/);
		   if(o){
		    v = parseFloat(o[2]);
		    initial_scale = parseFloat((1 / v).toFixed(2))
		   }
		  }
		 }
		 if (!v && !initial_scale) {
		  var n = (win.navigator.appVersion.match(/android/gi), win.navigator.appVersion.match(/iphone/gi));
		  v = win.devicePixelRatio;
		  v = n ? v >= 3 ? 3 : v >= 2 ? 2 : 1 : 1, initial_scale = 1 / v
		 }
		 //没有viewport标签的情况下
		 if (domEle.setAttribute("data-dpr", v), !viewport) {
		  if (viewport = dom.createElement("meta"), viewport.setAttribute("name", "viewport"), viewport.setAttribute("content", "initial-scale=" + initial_scale + ", maximum-scale=" + initial_scale + ", minimum-scale=" + initial_scale + ", user-scalable=no"), domEle.firstElementChild) {
		   domEle.firstElementChild.appendChild(viewport)
		  } else {
		   var m = dom.createElement("div");
		   m.appendChild(viewport), dom.write(m.innerHTML)
		  }
		 }
		 win.dpr = v;
		 win.addEventListener("resize", function() {
		  clearTimeout(timeCode), timeCode = setTimeout(resize, 300)
		 }, false);
		 win.addEventListener("pageshow", function(b) {
		  b.persisted && (clearTimeout(timeCode), timeCode = setTimeout(resize, 300))
		 }, false);		
		 resize();
		}(window);
//rem结束

/*顶部固定滚定*/
$(function(){			
			var topHeight=$("#top_bar").height();	
		    var d_width=$(document).width();
		    var nav_bar=$("#nav_bar").height();
		    if (d_width<768) {
		    		$("#nav_bar").css({"position":"fixed", "top":0,});
		    	    $("#main").css("margin-top",nav_bar);
		    	
		    } else{
		    	$(window).scroll(function(){			
				var sro=$(document).scrollTop();
				if (sro>=topHeight) {				
					$("#nav_bar").css({"position":"fixed", "top":0,"background-color":"rgba(255,255,255,0.95)"});
				    $("#main").css("margin-top",$("#nav_bar").height());
				} else{
					$("#nav_bar").css("position","static");
					$("#main").css("margin-top",0);
				}
			})
		    }
		})
/*顶部固定滚定结束*/

/*顶部导航活动*/
function setMenu(index){
	$(".navbar-nav>li").each(function(){
	       if(index == $(this).index())
	       {
	    	$(this).find("a").css({"color":"#1076c2"});	    	
	       }
	  });    
	
	};
/*顶部导航点击按钮*/	
$(function(){
	var doc=$(document).width();
	if (doc>=768) {
		$(".dropdown a").removeAttr("data-toggle");
	} 
})
/*手机*/	
$(function(){
		$(".dropdown-menu>li").click(function(event){
			
			var doc=$(document).width();
			if (doc<768) {	
				
		      	if ($(this).hasClass("caret1")) {
		      		
		      	event.preventDefault();		//阻止默认html元素事件
			    event.stopPropagation();	//阻止事件冒泡
		         	$(".threeMenu").hide();
			      	var display = $(this).find(".threeMenu").css('display');
			     if(display=='none'){
			      		//若可以同时展开多个ol,将下面一行代码注释
			           /*$('.dropdown-menu .threeMenu').hide();*/
			      		$(this).find(".threeMenu").show();
			      	}else{
			      		$(this).find(".threeMenu").hide();
			      	}
			      
			      	
		      	}
			} 
		})
		
	$(".threeMenu li").click(function(event){
			event.stopPropagation();
		})
		
	})

/*PC端导航条左右高度*/
$(function(){
			var doc=$(document).width();
			if (doc>768) {	
				var menuHeight=$(".dropdown-menu").height();
			
				   $(".threeMenu").css("min-height",menuHeight+2);
			
					
			} 
	})
		

$(function(){
	$(".super_title li").click(function(){
		$(this).addClass("active").siblings().removeClass("active");
		var index=$(this).index();
		$(".super_nr").eq(index).addClass("nrshow").siblings(".super_nr").removeClass("nrshow");
		
	})
})

/*userCenter*/

function CenterMenu(index){
	$(".uercennt_nav li").each(function(){	   
		if (index==$(this).index()) {
			   $(this).addClass("active1");
		} 
	})
}

$(function(){
	/*PC web login,reg,lose password*/

	$("#user_Tan").click(function(){
		$(".login_bg").show();
		$("#login_modal").show();
	})
	$(".close_box").click(function(){
		$(".login_bg").hide();
		$("#login_modal, #reg_modal,#lose_password").hide();
	})
	
	$("#open_reg").click(function(){		
		$("#login_modal").hide();
		$("#reg_modal").show();
		$(".login_bg").show();
	})	
	$("#open_login").click(function(){
		$(".login_bg").show();
		$("#reg_modal").hide();
		$("#login_modal").show();
	})	
	$("#open_login1").click(function(){
		$(".login_bg").show();
		$("#lose_password").hide();
		$("#login_modal").show();
	})	
	$("#open_reg1").click(function(){		
		$("#lose_password").hide();
		$("#reg_modal").show();
		$(".login_bg").show();
	})	
	$("#Forgot_ps").click(function(){
		$("#login_modal").hide();
		$("#lose_password").show();
	})
})

/*Mobile phone login*/
$(function(){
	$("#open_reg2").click(function(){	
		$(".navbar-collapse").hide(300);
		$("#reg_modal").show();
		$(".login_bg").show();
	})
	
	$("#open_login2").click(function(){	
		$(".navbar-collapse").hide(300);
		$("#login_modal").show();
		$(".login_bg").show();
	})
	
	$(".navbar-toggle").click(function(){
		$(".navbar-collapse").slideToggle();
	});
	
})

/*search_click*/
$(function(){

	$('#search_div2 .input-group-btn').on('click', function(e){
		e.preventDefault();		
		$('#search_div2').hide();
		$('#search_div1').css("display","table");
		$("#search_input").focus();
	});
	$('#search_div1 .input-group-btn').on('click', function(e){
		e.preventDefault();		
		if($("#search_input").val()!=''){
			//alert('提交搜索内容');
			$("#search_form").submit();
		}
	});
	$("#search_input").on('blur', function(e){
		e.preventDefault();
		if(this.value==''){
			$('#search_div1').hide();
			$('#search_div2').css("display","table");
		}		
	});
})

var dialog={
	 error: function(message,title="Message"){
                layer.open({
			type: 1,
			closeBtn: 0,
                        content: '<div style="padding: 20px 40px;">'+ message+'</div>',
                        title: title,
			shadeClose: true,
                });
        },

        success : function(message,title="Message") {
                layer.open({
			    type : 1,
			    closeBtn: 0,
                            content: '<div style="padding: 20px 40px;">'+ message+'</div>',
			    title: title,
			    shadeClose: true,
                           });
          },


}
