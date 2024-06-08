var detector = navigator.userAgent,
    isAndroid = /Android (\d+\.\d+)/.test(detector),
    version = parseFloat(RegExp.$1),
    phoneScale = parseInt(window.screen.width)/640;
if(isAndroid){
    if(version>2.3){
        document.write('<meta name="viewport" content="width=640, minimum-scale = '+ phoneScale +', maximum-scale = '+ phoneScale +', target-densitydpi=device-dpi">');
    }else{
        document.write('<meta name="viewport" content="width=640, target-densitydpi=device-dpi">');
    }
}else{
    //document.write('<meta name="viewport" content="width=device-width, user-scalable=no, target-densitydpi=device-dpi">');
	document.write('<meta name="viewport" content="width=device-width, initial-scale='+phoneScale+', viewport-fit=cover,user-scalable=no">');
}
