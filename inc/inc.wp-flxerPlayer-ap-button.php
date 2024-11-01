<?php
/*
Part of wp-flxerPlayer v1
 Gianluca Del Gobbo, <g.delgobbo@flyer.it>, http://www.flxer.net
*/
$wpconfig = realpath('../../../../wp-config.php');
if (!file_exists($wpconfig)) { echo "Could not found wp-config.php. Error in path :\n\n".$wpconfig ; die; }
require_once($wpconfig);
require_once(ABSPATH.'/wp-admin/admin.php');

if(!current_user_can('edit_posts')) die;

load_textdomain('wp-flxerPlayer', get_option('siteurl').'/wp-content/plugins/wp-flxerPlayer/locales/wp-flxerPlayer-'.get_locale().'.mo');

//$flxer_options = get_option('wp_flxerPlayer');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>wp-flxerPlayer</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script type="text/javascript" src="<?php echo GDG_SITEPATH ?>/js/tinymceplugin/tinymce.js"></script>
	<script type="text/javascript" src="<?php echo GDG_SITEPATH ?>/js/colorpicker.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo GDG_SITEPATH ?>/css/admin.css" />
	<base target="_self" />
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('flashURL').focus();" style="display: none">
	<form name="wp-flxerPlayer" action="#">
		<div class="tabs">
			<ul>
				<li id="insert_tab" class="current"><span><a href="javascript:mcTabs.displayTab('insert_tab','insert_panel');" onmousedown="return false;"><?php _e('Insert', 'wp-flxerPlayer'); ?></a></span></li>
				<li id="flashbox_tab"><span><a href="javascript:mcTabs.displayTab('flashbox_tab','flashbox_panel');" onmousedown="return false;"><?php _e('Flashbox', 'wp-flxerPlayer'); ?></a></span></li>
				<li id="options_tab"><span><a href="javascript:mcTabs.displayTab('options_tab','options_panel');" onmousedown="return false;"><?php _e('JW FLV MP', 'wp-flxerPlayer'); ?></a></span></li>
			</ul>
		</div>
		<div class="panel_wrapper" style="height:180px;">
			<!-- insert panel -->
			<div id="insert_panel" class="panel current">
				<table border="0" cellpadding="4" cellspacing="0">
					<tr>
						<td nowrap="nowrap" colspan="2"><strong><?php _e('Flash content'); ?></strong></td>
						<td nowrap="nowrap" colspan="2" align="right"><strong><font color="red">beta!</font></strong></td>
					</tr>
					<tr>
						<td nowrap="nowrap"><label for="flashURL"><?php _e('URL', 'wp-flxerPlayer'); ?>:</label></td>
						<td colspan="3"><input type="text" id="flashURL" value="" style="width:100%;"/></td>
					</tr>
					<tr>
						<td nowrap="nowrap"><label for="flashWidth"><?php _e('Width', 'wp-flxerPlayer'); ?>:</label></td>
						<td><input type="text" id="flashWidth" value="" style="width:145px;" /></td>
						<td nowrap="nowrap"><label for="flashHeight"><?php _e('Height', 'wp-flxerPlayer'); ?>:</label></td>
						<td><input type="text" id="flashHeight" value="" style="width:145px;" /></td>
					</tr>
					<tr>
						<td nowrap="nowrap" colspan="4">
							<strong><?php _e('Mode'); ?></strong>
							
							<input type="radio" id="flashModeDefault" name="flashMode" value="" checked="checked" />
							<label for="flashModeDefault"><?php _e('default', 'wp-flxerPlayer'); ?></label>
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<input type="radio" id="flashModeObject" name="flashMode" value="0" />
							<label for="flashModeObject"><?php _e('&lt;object&gt;', 'wp-flxerPlayer'); ?></label>

							&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" id="flashModeFlashbox" name="flashMode" value="3" />
							<label for="flashModeFlashbox"><?php _e('Flashbox', 'wp-flxerPlayer'); ?></label>

							<br /><input type="radio" id="flashModeSWFObject" name="flashMode" value="1" />
							<label for="flashModeSWFObject"><?php _e('SWFObject', 'wp-flxerPlayer'); ?></label>

							&nbsp;&nbsp;<input type="radio" id="flashModeSWFObjectIE" name="flashMode" value="2" />
							<label for="flashModeSWFObjectIE"><?php _e('SWFObject (IE only)', 'wp-flxerPlayer'); ?></label>
						</td>
					</tr>						
				</table>
			</div>
			<!-- insert panel -->
			<!-- flashbox panel -->
			<div id="flashbox_panel" class="panel">
				<table border="0" cellpadding="4" cellspacing="0">
					<tr>
						<td nowrap="nowrap" colspan="4"><strong><?php _e('Flashbox settings'); ?></strong></td>
					</tr>					
					<tr>
						<td nowrap="nowrap"><label for="flashPreview"><?php _e('Preview image', 'wp-flxerPlayer'); ?>:</label></td>
						<td><input type="text" id="flashPreview" value="" /></td>
						<td nowrap="nowrap"><label for="flashForcePreview"><?php _e('Force preview image', 'wp-flxerPlayer'); ?>:</label></td>
						<td><input type="checkbox" id="flashForcePreview" value="1" /></td>						
					</tr>
					<tr>
						<td nowrap="nowrap"><label for="flashPreviewWidth"><?php _e('Width', 'wp-flxerPlayer'); ?>*:</label></td>
						<td><input type="text" id="flashPreviewWidth" value="" /></td>
						<td nowrap="nowrap" colspan="2">
							<label for="flashPreviewHeight"><?php _e('Height', 'wp-flxerPlayer'); ?>*:</label>
							&nbsp;<input type="text" id="flashPreviewHeight" value="" />
						</td>
					</tr>					
					<tr>			
						<td nowrap="nowrap"><label for="flashLinktext"><?php _e('Linktext', 'wp-flxerPlayer'); ?>:</label></td>
						<td colspan="3"><input type="text" id="flashLinktext" value="" /></td>
					</tr>					
					<tr>					
						<td nowrap="nowrap"><label for="flashCaption"><?php _e('Caption', 'wp-flxerPlayer'); ?>:</label></td>
						<td colspan="3"><input type="text" id="flashCaption" value="" /></td>
					</tr>
				</table>
				<div style="display: block; float: right;"><small>* <?php _e('optional, but set both of them if used', 'wp-flxerPlayer'); ?></small></div>
			</div>
			<!-- flashbox panel -->
			<!-- options panel -->
			<div id="options_panel" class="panel">
				<div class="tabs">
					<ul>
						<li id="opt1_tab" class="current"><span><a href="javascript:mcTabs.displayTab('opt1_tab','opt1_panel');" onmousedown="return false;"><?php _e('Basics', 'wp-flxerPlayer'); ?></a></span></li>
						<li id="opt2_tab"><span><a href="javascript:mcTabs.displayTab('opt2_tab','opt2_panel');" onmousedown="return false;"><?php _e('Colors', 'wp-flxerPlayer'); ?></a></span></li>
						<li id="opt3_tab"><span><a href="javascript:mcTabs.displayTab('opt3_tab','opt3_panel');" onmousedown="return false;"><?php _e('Display', 'wp-flxerPlayer'); ?></a></span></li>
						<li id="opt4_tab"><span><a href="javascript:mcTabs.displayTab('opt4_tab','opt4_panel');" onmousedown="return false;"><?php _e('Controlbar', 'wp-flxerPlayer'); ?></a></span></li>
						<li id="opt5_tab"><span><a href="javascript:mcTabs.displayTab('opt5_tab','opt5_panel');" onmousedown="return false;"><?php _e('Playlist', 'wp-flxerPlayer'); ?></a></span></li>
						<li id="opt6_tab"><span><a href="javascript:mcTabs.displayTab('opt6_tab','opt6_panel');" onmousedown="return false;"><?php _e('Playback', 'wp-flxerPlayer'); ?></a></span></li>
						<li id="opt7_tab"><span><a href="javascript:mcTabs.displayTab('opt7_tab','opt7_panel');" onmousedown="return false;"><?php _e('External', 'wp-flxerPlayer'); ?></a></span></li>
					</ul>
					<a href="http://www.jeroenwijering.com/?item=Supported_Flashvars" style="display: block; float: right;" target="_blank">Flashvars</a>
				</div>
				<div class="panel_wrapper" style="height:125px;">
					<div id="opt1_panel" class="panel current">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td nowrap="nowrap" colspan="2"><strong><?php _e('JW FLV Media Player settings', 'wp-flxerPlayer'); ?> - <?php _e('Basics', 'wp-flxerPlayer'); ?></strong></td>
							</tr>
							<tr>
								<td nowrap="nowrap" style="width:100px;"><label for="optImage">image:</label></td>
								<td><input type="text" id="optImage" value="" style="width:280px;" /></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optId">id:</label></td>
								<td><input type="text" id="optId" value="" style="width:280px;" /></td>
							</tr>
						</table>
					</div>
					<div id="opt2_panel" class="panel">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td nowrap="nowrap" colspan="2"><strong><?php _e('JW FLV Media Player settings', 'wp-flxerPlayer'); ?> - <?php _e('Colors', 'wp-flxerPlayer'); ?></strong></td>
							</tr>
							<tr>
								<td nowrap="nowrap" style="width:100px;"><label for="optBackcolor">backcolor:</label></td>
								<td>
									<input type="text" id="optBackcolor" value="" />
									<a href="javascript:pickColor('optBackcolor');" class="pick" id="optBackcolorpick" style="background-color: #FFFFFF;">&nbsp;&nbsp;&nbsp;</a>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optFrontcolor">frontcolor:</label></td>
								<td>
									<input type="text" id="optFrontcolor" value="" />
									<a href="javascript:pickColor('optFrontcolor');" class="pick" id="optFrontcolorpick" style="background-color: #000000;">&nbsp;&nbsp;&nbsp;</a>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optLightcolor">lightcolor:</label></td>
								<td>
									<input type="text" id="optLightcolor" value="" />
									<a href="javascript:pickColor('optLightcolor');" class="pick" id="optLightcolorpick" style="background-color: #000000;">&nbsp;&nbsp;&nbsp;</a>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optScreencolor">screencolor:</label></td>
								<td>
									<input type="text" id="optScreencolor" value="" />
									<a href="javascript:pickColor('optScreencolor');" class="pick" id="optScreencolorpick" style="background-color: #000000;">&nbsp;&nbsp;&nbsp;</a>
								</td>
							</tr>
						</table>
					</div>
					<div id="opt3_panel" class="panel">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td nowrap="nowrap" colspan="2"><strong><?php _e('JW FLV Media Player settings', 'wp-flxerPlayer'); ?> - <?php _e('Display appearance', 'wp-flxerPlayer'); ?></strong></td>
							</tr>
							<tr>
								<td nowrap="nowrap" style="width:100px;"><label for="optLogo">logo:</label></td>
								<td><input type="text" id="optLogo" value="" style="width:280px;" /></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optOverstretch">overstretch:</label></td>
								<td>
									<input type="checkbox" id="optOverstretch" value="1" />&nbsp;&nbsp;
									<select id="selOverstretch">
										<option value="false" selected="selected">false</option>
										<option value="true">true</option>
									</select>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optShowicons">showicons:</label></td>
								<td>
									<input type="checkbox" id="optShowicons" value="1" />&nbsp;&nbsp;
									<select id="selShowicons">
										<option value="true" selected="selected">true</option>
										<option value="false">false</option>
									</select>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optTransition"><?php _e('transition', 'wp-flxerPlayer'); ?>:</label></td>
								<td>
									<input type="checkbox" id="optTransition" value="1" />&nbsp;&nbsp;
									<select id="selTransition">
										<option value="random" selected="selected">random</option>
										<option value="fade">fade</option>
										<option value="bgfade">bgfade</option>
										<option value="blocks">blocks</option>
										<option value="bubbles">bubbles</option>
										<option value="circles">circles</option>
										<option value="flash">flash</option>
										<option value="fluids">fluids</option>
										<option value="lines">lines</option>
										<option value="slowfade">slowfade</option>
									</select>
								</td>
							</tr>
						</table>
					</div>
					<div id="opt4_panel" class="panel">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td nowrap="nowrap" colspan="4"><strong><?php _e('JW FLV Media Player settings', 'wp-flxerPlayer'); ?> - <?php _e('Controlbar appearance', 'wp-flxerPlayer'); ?></strong></td>
							</tr>
							<tr>
								<td nowrap="nowrap" style="width:100px;"><label for="optShownavigation"><?php _e('shownavigation', 'wp-flxerPlayer'); ?>:</label></td>
								<td>
									<input type="checkbox" id="optShownavigation" value="1" />&nbsp;&nbsp;
									<select id="selShownavigation">
										<option value="true" selected="selected">true</option>
										<option value="false">false</option>
									</select>
								</td>
								
								<td nowrap="nowrap"><label for="optShowdownload">&nbsp;showdownload:</label></td>
								<td>
									<input type="checkbox" id="optShowdownload" value="1" />&nbsp;&nbsp;
									<select id="selShowdownload">
										<option value="false" selected="selected">false</option>
										<option value="true">true</option>
									</select>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optShowstop">showstop:</label></td>
								<td>
									<input type="checkbox" id="optShowstop" value="1" />&nbsp;&nbsp;
									<select id="selShowstop">
										<option value="false" selected="selected">false</option>
										<option value="true">true</option>
									</select>
								</td>
								
								<td nowrap="nowrap"><label for="optUsefullscreen">&nbsp;usefullscreen:</label></td>
								<td>
									<input type="checkbox" id="optUsefullscreen" value="1" />&nbsp;&nbsp;
									<select id="selUsefullscreen">
										<option value="true" selected="selected">true</option>
										<option value="false">false</option>
									</select>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optShowdigits">showdigits:</label></td>
								<td colspan="3">
									<input type="checkbox" id="optShowdigits" value="1" />&nbsp;&nbsp;
									<select id="selShowdigits">
										<option value="true" selected="selected">true</option>
										<option value="false">false</option>
									</select>
								</td>
							</tr>
						</table>
					</div>
					<div id="opt5_panel" class="panel">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td nowrap="nowrap" colspan="2"><strong><?php _e('JW FLV Media Player settings', 'wp-flxerPlayer'); ?> - <?php _e('Playlist appearance', 'wp-flxerPlayer'); ?></strong></td>
							</tr>
							<tr>
								<td nowrap="nowrap" style="width:100px;"><label for="optAutoscroll">autoscroll:</label></td>
								<td>
									<input type="checkbox" id="optAutoscroll" value="1" />&nbsp;&nbsp;
									<select id="selAutoscroll">
										<option value="false" selected="selected">false</option>
										<option value="true">true</option>
									</select>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optDisplayheight">displayheight:</label></td>
								<td><input type="text" id="optDisplayheight" value="" /></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optDisplaywidth">displaywidth:</label></td>
								<td><input type="text" id="optDisplaywidth" value="" /></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optThumbsinplaylist">thumbsinplaylist:</label></td>
								<td>
									<input type="checkbox" id="optThumbsinplaylist" value="1" />&nbsp;&nbsp;
									<select id="selThumbsinplaylist">
										<option value="false" selected="selected">false</option>
										<option value="true">true</option>
									</select>
								</td>
							</tr>
						</table>
					</div>
					<div id="opt6_panel" class="panel">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td nowrap="nowrap" colspan="4"><strong><?php _e('JW FLV Media Player settings', 'wp-flxerPlayer'); ?> - <?php _e('Playback behaviour', 'wp-flxerPlayer'); ?></strong></td>
							</tr>
							<tr>
								<td nowrap="nowrap" style="width:80px;"><label for="optAudio">audio:</label></td>
								<td colspan="3"><input type="text" id="optAudio" value="" style="width:300px;"/></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optAutostart">autostart:</label></td>
								<td>
									<input type="checkbox" id="optAutostart" value="1" />&nbsp;&nbsp;
									<select id="selAutostart">
										<option value="false" selected="selected">false</option>
										<option value="true">true</option>
									</select>
								</td>

								<td nowrap="nowrap"><label for="optRepeat">&nbsp;repeat:</label></td>
								<td>
									<input type="checkbox" id="optRepeat" value="1" />&nbsp;&nbsp;
									<select id="selRepeat">
										<option value="false" selected="selected">false</option>
										<option value="true">true</option>
									</select>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optBufferlength">bufferlength:</label></td>
								<td><input type="text" id="optBufferlength" value="" /></td>

								<td nowrap="nowrap"><label for="optRotatetime">&nbsp;rotatetime:</label></td>
								<td><input type="text" id="optRotatetime" value="" /></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optCaptions">captions:</label></td>
								<td><input type="text" id="optCaptions" value="" /></td>
								
								<td nowrap="nowrap"><label for="optShuffle">&nbsp;shuffle:</label></td>
								<td>
									<input type="checkbox" id="optShuffle" value="1" />&nbsp;&nbsp;
									<select id="selShuffle">
										<option value="true" selected="selected">true</option>
										<option value="false">false</option>
									</select>
								</td>

							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optFallback">fallback:</label></td>
								<td><input type="text" id="optFallback" value="" /></td>

								<td nowrap="nowrap"><label for="optVolume">&nbsp;volume:</label></td>
								<td><input type="text" id="optVolume" value="" /></td>
						</table>
					</div>
					<div id="opt7_panel" class="panel">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td nowrap="nowrap" colspan="4"><strong><?php _e('JW FLV Media Player settings', 'wp-flxerPlayer'); ?> - <?php _e('External communication', 'wp-flxerPlayer'); ?></strong></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optCallback">callback:</label></td>
								<td><input type="text" id="optCallback" value="" /></td>

								<td nowrap="nowrap"><label for="optLinktarget">&nbsp;linktarget:</label></td>
								<td><input type="text" id="optLinktarget" value="" /></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optEnablejs">enablejs:</label></td>
								<td>
									<input type="checkbox" id="optEnablejs" value="1" />&nbsp;&nbsp;
									<select id="selEnablejs">
										<option value="false" selected="selected">false</option>
										<option value="true">true</option>
									</select>
								</td>

								<td nowrap="nowrap"><label for="optRecommendations">&nbsp;recommen-<br />&nbsp;dations:</label></td>
								<td><input type="text" id="optRecommendations" value="" /></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optJavascriptid">javascriptid:</label></td>
								<td><input type="text" id="optJavascriptid" value="" /></td>

								<td nowrap="nowrap"><label for="optStreamscript">&nbsp;streamscript:</label></td>
								<td><input type="text" id="optStreamscript" value="" /></td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optLink">link:</label></td>
								<td><input type="text" id="optLink" value="" /></td>

								<td nowrap="nowrap"><label for="optType">&nbsp;type:</label></td>
								<td>
									<input type="checkbox" id="optType" value="1" />&nbsp;&nbsp;
									<select id="selType">
										<option value="flv" selected="selected">flv</option>
										<option value="mp3">mp3</option>
										<option value="rtmp">rtmp</option>
										<option value="jpg">jpg</option>
										<option value="png">png</option>
										<option value="gif">gif</option>
										<option value="swf">swf</option>
									</select>
								</td>
							</tr>
							<tr>
								<td nowrap="nowrap"><label for="optLinkfromdisplay">linkfrom-<br />display:</label></td>
								<td colspan="3">
									<input type="checkbox" id="optLinkfromdisplay" value="1" />&nbsp;&nbsp;
									<select id="selLinkfromdisplay">
										<option value="false" selected="selected">false</option>
										<option value="true">true</option>
									</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<small><?php _e('Use this to overwrite the values defined in <em>Options/wp-flxerPlayer</em>', 'wp-flxerPlayer'); ?></small>
			</div>
			<!-- options panel -->
		</div>

		<div class="mceActionPanel">
			<div style="float: left">
				<input type="button" id="cancel" name="cancel" value="<?php _e('Cancel', 'wp-flxerPlayer'); ?>" onclick="tinyMCEPopup.close();" />
			</div>
			<div style="float: right">
				<input type="submit" id="insert" name="insert" value="<?php _e('Insert', 'wp-flxerPlayer'); ?>" onclick="insertFlashCode();" />
			</div>
		</div>
	</form>
</body>
</html>