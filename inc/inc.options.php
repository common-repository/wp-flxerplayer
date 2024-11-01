<?php
/*
Part of wp-flxerPlayer v1
© Gianluca Del Gobbo, <g.delgobbo@flyer.it>, http://www.flxer.net
*/
if (!function_exists('get_option')) { echo "Please don't load this file directly."; exit; }

$options = array( // default values
	'main' => array(
		'method' => 0,
		'slimbox' => 0,
		'defwidth' => 425,
		'defheight' => 355,
		'defclass' => 'embedflash',
		'galleryTit' => 'FLxER Gallery',
		'deleteoptionsondeactivation' => 0,
		'playerurl' => GDG_SITEPATH.'/swf/flxerPlayer4.swf?cnt=',
		'variablesurl' => GDG_SITEPATH.'/js/variables.js',
		'FLX_RunActiveContenturl' => GDG_SITEPATH.'/js/FLX_RunActiveContent.js',
		'flashManagerurl' => GDG_SITEPATH.'/js/flashManager.js',
		'slimboxurl' => GDG_SITEPATH.'/js/slimbox.js'
	),
	'messages' => array(
		'nojs' => __('Either JavaScript is not active or you are using an old version of Adobe Flash Player. <a href="http://www.adobe.com/">Please install the newest Flash Player</a>.', 'wp-flxerPlayer'),
		'openarticle' => __('Please open the article to see the flash file or player.', 'wp-flxerPlayer')
	),	
	'flashbox' => array(
		'showclose' => 1,
		'previewimage' => 1,
		'previewimagewidth' => NULL,
		'previewimageheight' => NULL,
		'previewimageurl' =>GDG_SITEPATH.'/css/images/previewimage.png',
		'loadpreviewimage' => 1, // YouTube & GameVideos
		'openarticleatsearchresults' => 1,		
		'deflinktext' => __('- Watch the video in an overlay -', 'wp-flxerPlayer')
	),
	'widget' => array(
		'number' => 1,
	),
	'flashvars' => array(
		'tw' => 128,
		'th' => 96,
		'myLoop' => 'true',
		'resizza_onoff' => 'true',
		'centra_onoff' => 'true',
		'ss_time' => 3000,
		'swfW' => 400,
		'swfH' => 300,
		'downPath' => '/_fp/fpDownload.php?file=',
		'embePath' => '/_fp/flxerPlayer4.swf?cnt=',

		// COLORI PLAYER //
		/* 'playerBackgroundColor' => '0xFFFFFF;  FONDO PIATTO (NO QUADRATINI) */
		
		// COLORI PLAYlist //
		'playlistThumbnailsOverColor' => '0x990000',
		
		// COLORI TOOLBAR //
		'toolbarBorder' => '0x000000',
		'toolbarBackground' => '0xFFFFFF',
		
		// COLORI BOTTONI //
		'btnBorder' => '0x000000',
		'btnBorderOver' => '0x990000',
		'btnBkg' => '0xFFFFFF',
		'btnBkgOver' => '0xFFFFFF',
		'btnSimb' => '0x000000',
		'btnSimbOver' => '0x990000',
		
		/// COLORI ALT ///
		'altBorder' => '0xFFFFFF',
		'altBkg' => '0x000000',
		'altTxt' => '0xFFFFFF',
		'altTxtOver' => '0x990000',
		
		
		// LABELS //
		'ssLabel' => 'slideshow',
		'mLabel' => 'menu',
		'pLabel' => 'playlist',
		'menuAlt' => 'Show menu options',
		'selAlt' => 'Show the playlist',
		'fwAlt' => 'Go forward (arrow right)',
		'rwAlt' => 'Rewind (arrow left)',
		'playpauseAlt' => 'Stop/Play (space bar)',
		'cursAlt' => 'scratch',
		'volumeAlt' => 'Set audio volume',
		'ssAlt' => 'Start slideshow',
		'embClose' => 'close window',
		'ppBigAlt' => 'Start now',
		'shotAlt' => 'Shot now',
		'saveShot' => 'Save image',
		'delShot' => 'Delete image',
		'pageDn' => 'Go to previous page',
		'pageUp' => 'Go to nexr page'
/*	'flashvars' => array(
		'source' => NULL,
		'height' => NULL,
		'width' => NULL,
		'file' => NULL,
		'image' => NULL,
		'id' => NULL,
		'backcolor' => NULL,
		'frontcolor' => NULL,
		'lightcolor' => NULL,
		'screencolor' => NULL,
		'logo' => NULL,
		'overstretch' => NULL,
		'showicons' => NULL,
		'transition' => NULL,
		'shownavigation' => NULL,
		'showstop' => NULL,
		'showdigits' => NULL,
		'showdownload' => NULL,
		'usefullscreen' => NULL,
		'autoscroll' => NULL,
		'displayheight' => NULL,
		'displaywidth' => NULL,
		'thumbsinplaylist' => NULL,
		'audio' => NULL,
		'autostart' => NULL,
		'bufferlength' => NULL,
		'captions' => NULL,
		'fallback' => NULL,
		'repeat' => NULL,
		'rotatetime' => NULL,
		'shuffle' => NULL,
		'volume' => NULL,
		'callback' => NULL,
		'enablejs' => NULL,
		'javascriptid' => NULL,
		'link' => NULL,
		'linkfromdisplay' => NULL,
		'linktarget' => NULL,
		'recommendations' => NULL,
		'streamscript' => NULL,
		'type' => NULL*/
	),
	'apd' => array(
		'basics' => 'none',
		'colors' => 'none',
		'display' => 'none',
		'controls' => 'none',
		'playlists' => 'none',
		'behaviour' => 'none',
		'communication' => 'none'
	),	
);
?>