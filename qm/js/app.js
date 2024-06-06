TouchSlide({ slideCell:"#banner",titCell:".hd ul", mainCell:".bd ul", effect:"left", autoPlay:true,autoPage:true, switchLoad:"_src" });
TouchSlide({ slideCell:"#leftTabBox" });
TouchSlide({ slideCell:"#leftTabBox2" });


$(function(){$(".to1").click(function(){$(".res").fadeIn(500)})
$(".close").click(function(){$(".res").fadeOut(500)})})

$(function(){$(".to3").click(function(){$(".update").fadeIn(500)})
$(".close").click(function(){$(".update").fadeOut(500)})})


$(document).ready(function(){$('.inactive').click(function(){if($(this).siblings('ul').css('display')=='none'){$(this).parent('li').siblings('li').removeClass('inactives');$(this).addClass('inactives');$(this).siblings('ul').slideDown(100).children('li');if($(this).parents('li').siblings('li').children('ul').css('display')=='block'){$(this).parents('li').siblings('li').children('ul').parent('li').children('a').removeClass('inactives');$(this).parents('li').siblings('li').children('ul').slideUp(100)}}else{$(this).removeClass('inactives');$(this).siblings('ul').slideUp(100);$(this).siblings('ul').children('li').children('ul').parent('li').children('a').addClass('inactives');$(this).siblings('ul').children('li').children('ul').slideUp(100);$(this).siblings('ul').children('li').children('a').removeClass('inactives')}})});
document.oncontextmenu=new Function("event.returnValue=false");
 
document.onselectstart=new Function("event.returnValue=false");
 
document.oncontextmenu = function(){
 
    event.returnValue = false;
 
}

var scrolltotop={
	setting:{
		startline:100, 
		scrollto:0, 
		scrollduration:400, 
		fadeduration:[500,100] 
	},
	controlHTML:'<img src="../../appskin/images/topback.png" style="width:66px;height:66px;border:0;" />',
	controlattrs:{offsetx:30,offsety:110},
	anchorkeyword:"#top",
	state:{
		isvisible:false,
		shouldvisible:false
	},scrollup:function(){
		if(!this.cssfixedsupport){
			this.$control.css({opacity:0});
		}
		var dest=isNaN(this.setting.scrollto)?this.setting.scrollto:parseInt(this.setting.scrollto);
		if(typeof dest=="string"&&jQuery("#"+dest).length==1){
			dest=jQuery("#"+dest).offset().top;
		}else{
			dest=0;
		}
		this.$body.animate({scrollTop:dest},this.setting.scrollduration);
	},keepfixed:function(){
		var $window=jQuery(window);
		var controlx=$window.scrollLeft()+$window.width()-this.$control.width()-this.controlattrs.offsetx;
		var controly=$window.scrollTop()+$window.height()-this.$control.height()-this.controlattrs.offsety;
		this.$control.css({left:controlx+"px",top:controly+"px"});
	},togglecontrol:function(){
		var scrolltop=jQuery(window).scrollTop();
		if(!this.cssfixedsupport){
			this.keepfixed();
		}
		this.state.shouldvisible=(scrolltop>=this.setting.startline)?true:false;
		if(this.state.shouldvisible&&!this.state.isvisible){
			this.$control.stop().animate({opacity:1},this.setting.fadeduration[0]);
			this.state.isvisible=true;
		}else{
			if(this.state.shouldvisible==false&&this.state.isvisible){
				this.$control.stop().animate({opacity:0},this.setting.fadeduration[1]);
				this.state.isvisible=false;
			}
		}
	},init:function(){
		jQuery(document).ready(function($){
			var mainobj=scrolltotop;
			var iebrws=document.all;
			mainobj.cssfixedsupport=!iebrws||iebrws&&document.compatMode=="CSS1Compat"&&window.XMLHttpRequest;
			mainobj.$body=(window.opera)?(document.compatMode=="CSS1Compat"?$("html"):$("body")):$("html,body");
			mainobj.$control=$('<div id="topcontrol">'+mainobj.controlHTML+"</div>").css({position:mainobj.cssfixedsupport?"fixed":"absolute",bottom:mainobj.controlattrs.offsety,right:mainobj.controlattrs.offsetx,opacity:0,cursor:"pointer"}).attr({title:"返回顶部"}).click(function(){mainobj.scrollup();return false;}).appendTo("body");if(document.all&&!window.XMLHttpRequest&&mainobj.$control.text()!=""){mainobj.$control.css({width:mainobj.$control.width()});}mainobj.togglecontrol();
			$('a[href="'+mainobj.anchorkeyword+'"]').click(function(){mainobj.scrollup();return false;});
			$(window).bind("scroll resize",function(e){mainobj.togglecontrol();});
		});
	}
};
/*scrolltotop.init();

window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];*/



