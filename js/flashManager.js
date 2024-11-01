function flashWriter(trgt,w,h,swfCurrPage) { //v3.0
	if (AC_FL_RunContent == 0 || DetectFlashVer == 0) {
	} else {
		var hasRightVersion = DetectFlashVer(requiredMajorVersion, requiredMinorVersion, requiredRevision);
		if(hasRightVersion) {  // if we've detected an acceptable version
			swfCurrPage+='&r='+Math.floor(Math.random()*5000000);
			document.getElementById(trgt).style.display = 'block';
			if (swfCurrPage.indexOf("/_swf/testa.swf") != -1) {
				var wmode = 'transparent';
			} else {
				var wmode = 'window';
			}
			var swfStr=AC_FL_RunContent(
				'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,45,0',
				'width',w,
				'height',h,
				'src',swfCurrPage,
				'quality','high',
				'pluginspage','http://www.macromedia.com/go/getflashplayer',
				'movie',swfCurrPage,
				'id',trgt+"swf",
				'name',trgt+"swf",
				'wmode',wmode,
				'allowFullScreen','true',
				'align', 'middle',
				'play', 'true',
				'loop', 'true',
				'scale', 'showall',
				'devicefont', 'false',
				'bgcolor', '#ffffff',
				'menu', 'true',
				'allowScriptAccess','always'
			);
			document.getElementById(trgt).innerHTML = swfStr;
		} else {  // flash is too old or we can't detect the plugin
			document.getElementById(trgt).innerHTML = "<div class=\"flashAlt\">This content requires JAVASCRIPT enabled and the Adobe Flash Player.<br \/><br \/><a href=\"http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash\">Get Adobe Flash Player<\/a><\/div>";
		}
	}
}
function setContentLoader(trgt,cnt){
	if (navigator.appName.indexOf("Microsoft") != -1) {
		var tmp = window[trgt];
	} else {
		var tmp = document[trgt];
	}
	if (tmp) {
		tmp.avviaJs(sitePath+cnt);
	} else {
		alert(trgt);
		flashWriter(trgt,710,399,"/_fp/flxerPlayer4.swf?cnt="+sitePath+cnt)
	}
}
function caricaFlashAvvio() {
	for (i=0;i<flashToLoad.length;i++){
		var path;
		//alert(flashToLoad[i][4].length);
		if (flashToLoad[i][4].length > 8) {
			path = flashToLoad[i][3]+flashToLoad[i][4];
		} else {
			path = flashToLoad[i][3];
		}
		flashWriter(flashToLoad[i][0],flashToLoad[i][1],flashToLoad[i][2],path);
		window[flashToLoad[i][0]+"swf"] = document.getElementById(flashToLoad[i][0]+"swf");
	}
}
if (window.addEventListener){
	window.addEventListener("load", caricaFlashAvvio, false);
} else if (window.attachEvent){
	window.attachEvent("onload", caricaFlashAvvio);
} else {
	window.onload=caricaFlashAvvio;
}
