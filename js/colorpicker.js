//---------------------------------------------------------
// Color Picker Script from Flooble.com
// For more information, visit 
//http://www.flooble.com/scripts/colorpicker.php
// Copyright 2003 Animus Pactum Consulting inc.
// You may use and distribute this code freely, as long as
// you keep this copyright notice and the link to flooble.com
// if you chose to remove them, you must link to the page
// listed above from every web page where you use the color
// picker code.
//---------------------------------------------------------


var perline = 9;
var divSet = false;
var curId;
var colorLevels = Array('0','3','6','9','C','F');
var colorArray = Array();
var ie = false;
var nocolor = 'none';


if (document.all) { ie = true; nocolor = ''; }


function addColor(r, g, b) {
	var red = colorLevels[r];
	var green = colorLevels[g];
	var blue = colorLevels[b];
	addColorValue(red, green, blue);
}


function addColorValue(r, g, b) {
	colorArray[colorArray.length] = r + r + g + g + b + b;
}


function setColor(color) {
	var link = document.getElementById(curId);
	var field = document.getElementById(curId);
	var prev = document.getElementById(curId+'pick');
	var picker = document.getElementById('colorpicker');
	field.value = '0x'+color;
	prev.style.backgroundColor = '#'+color;
	if (color == '') {color = nocolor; }
	picker.style.display = 'none';
	eval(document.getElementById(curId).title);
}


function setDiv() {
	if (!document.createElement) { return; }
	var elemDiv = document.createElement('div');
	if (typeof(elemDiv.innerHTML) != 'string') { return; }
	genColors();
	elemDiv.id = 'colorpicker';
	elemDiv.innerHTML = getColorTable();
	document.body.appendChild(elemDiv);
	divSet = true;
}


function pickColor(id) {
	if (!divSet) { setDiv(); }
	var picker = document.getElementById('colorpicker');
	if (id == curId && picker.style.display == 'block') {
		picker.style.display = 'none';
		return;
	}
	curId = id;
	var thelink = document.getElementById(id);
	picker.style.top = getAbsoluteOffsetTop(thelink)+"px";
	picker.style.left = getAbsoluteOffsetLeft(thelink)+"px";
	picker.style.display = 'block';
}


function genColors() {
	addColorValue('0','0','0');
	addColorValue('3','3','3');
	addColorValue('6','6','6');
	addColorValue('8','8','8');
	addColorValue('9','9','9');
	addColorValue('A','A','A');
	addColorValue('C','C','C');
	addColorValue('E','E','E');
	addColorValue('F','F','F');
	for (a = 1; a < colorLevels.length; a++)
		addColor(0,0,a);
	for (a = 1; a < colorLevels.length - 1; a++)
		addColor(a,a,5);
	for (a = 1; a < colorLevels.length; a++)
		addColor(0,a,0);
	for (a = 1; a < colorLevels.length - 1; a++)
		addColor(a,5,a);
	for (a = 1; a < colorLevels.length; a++)
		addColor(a,0,0);
	for (a = 1; a < colorLevels.length - 1; a++)
		addColor(5,a,a);
	for (a = 1; a < colorLevels.length; a++)
		addColor(a,a,0);
	for (a = 1; a < colorLevels.length - 1; a++)
		addColor(5,5,a);
	for (a = 1; a < colorLevels.length; a++)
		addColor(0,a,a);
	for (a = 1; a < colorLevels.length - 1; a++)
		addColor(a,5,5);
	for (a = 1; a < colorLevels.length; a++)
		addColor(a,0,a);			
	for (a = 1; a < colorLevels.length - 1; a++)
		addColor(5,a,5);
  	return colorArray;
}


function getColorTable() {
	 var colors = colorArray;
 	 var tableCode = '';
	 tableCode += '<table>';
	 for (i = 0; i < colors.length; i++) {
		 if (i % perline == 0) { tableCode += '<tr>'; }
		 tableCode += '<td><a style="color:#' + colors[i] + 
			'; background:#' + colors[i] + 
			';" href="javascript:setColor(\'' + colors[i] + 
			'\');">&nbsp;</a></td>';
		 if (i % perline == perline - 1) { tableCode += '</tr>'; }
	 }
	 if (i % perline != 0) { tableCode += '</tr>'; }
	 tableCode += '</table>';
 	 return tableCode;
}


function getAbsoluteOffsetTop(obj) {
	var top = obj.offsetTop;
	var parent = obj.offsetParent;
	while (parent != document.body) {
		top += parent.offsetTop;
		parent = parent.offsetParent;
	}
	return top;
}


function getAbsoluteOffsetLeft(obj) {
	var left = obj.offsetLeft;
	var parent = obj.offsetParent;
	while (parent != document.body) {
		left += parent.offsetLeft;
		parent = parent.offsetParent;
	}
	return left;
}