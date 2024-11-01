<?php
/*
Part of wp-flxerPlayer v1
© Gianluca Del Gobbo, <g.delgobbo@flyer.it>, http://www.flxer.net
*/
if (!function_exists('get_option')) { echo "Please don't load this file directly."; exit; }

function wp_flxerPlayer_widget_output($arguments, $number = 1) {
	extract($arguments);
	$options = get_option('wp_flxerPlayer_widgets');
	
	$option = $options[$number];
	if(empty($option['url'])) { return; }
	if(empty($option['title'])) { $option['title'] = 'Flash Widget'; }
	
	$flashcode = '[flash '.$option['url'].' mode='.$option['mode'];
	if(!empty($option['width'])) { $flashcode .= ' w='.$option['width']; }
	if(!empty($option['height'])) { $flashcode .= ' h='.$option['height']; }
	if ($option['mode'] == 3) {
		if(!empty($option['pw'])) { $flashcode .= ' pw='.$option['pw']; }
		if(!empty($option['ph'])) { $flashcode .= ' ph='.$option['ph']; }
		if($option['force'] == 1) { $flashcode .= ' preview=force'; }
		elseif(!empty($option['preview'])) { $flashcode .= ' preview='.$option['preview']; }
		elseif (!empty($option['linktext'])) { $flashcode .= ' linktext='.$option['linktext']; }
		elseif (!empty($option['caption'])) { $flashcode .= ' caption='.$option['caption']; }
	}
	if(!empty($option['expert'])) { $flashcode .= ' '.$option['expert']; }
	$flashcode .= ']';
	
	$output =  $before_widget.$before_title. $option['title'] .$after_title;
	$output .= (($option['addtext'] == 'before') ? $option['text'] : NULL).'<div style="text-align: center;">'.wp_flxerPlayer_plugin($flashcode).'</div>'.(($option['addtext'] == 'after') ? $option['text'] : NULL);
	$output .= $after_widget;
	
	echo $output;
	return;
}
function wp_flxerPlayer_widget_control($number) {
	$options = get_option('wp_flxerPlayer_widgets');
	if (isset($_POST['wp_flxerPlayer_widget-'.$number])) {
		$options[$number]['title'] = strip_tags(stripslashes($_POST['wp_flxerPlayer_widget-title-'.$number]));
		$options[$number]['text'] = stripslashes($_POST['wp_flxerPlayer_widget-text-'.$number]);
		$options[$number]['addtext'] = $_POST['wp_flxerPlayer_widget-addtext-'.$number];
		$options[$number]['url'] = $_POST['wp_flxerPlayer_widget-url-'.$number];
		$options[$number]['mode'] = (int) $_POST['wp_flxerPlayer_widget-mode-'.$number];
		$options[$number]['width'] = (int) $_POST['wp_flxerPlayer_widget-width-'.$number];
		$options[$number]['height'] = (int) $_POST['wp_flxerPlayer_widget-height-'.$number];
		$options[$number]['preview'] = $_POST['wp_flxerPlayer_widget-preview-'.$number];
		$options[$number]['force'] = (int) (isset($_POST['wp_flxerPlayer_widget-force-'.$number]) ? 1 : 0);
		$options[$number]['pw'] = (int) $_POST['wp_flxerPlayer_widget-prevwidth-'.$number];
		$options[$number]['ph'] = (int) $_POST['wp_flxerPlayer_widget-prevheight-'.$number];
		$options[$number]['linktext'] = $_POST['wp_flxerPlayer_widget-linktext-'.$number];
		$options[$number]['caption'] = $_POST['wp_flxerPlayer_widget-caption-'.$number];
		$options[$number]['expert'] = $_POST['wp_flxerPlayer_widget-expert-'.$number];
		update_option('wp_flxerPlayer_widgets', $options);
	}
	$title = htmlspecialchars($options[$number]['title']);
	$text = htmlspecialchars($options[$number]['text']);
	$addtext = $options[$number]['addtext'];
	$url = htmlspecialchars($options[$number]['url']);
	$mode = (int) $options[$number]['mode'];
	$width = (int) $options[$number]['width'];
	$height = (int) $options[$number]['height'];
	$preview = htmlspecialchars($options[$number]['preview']);
	$force = (int) $options[$number]['force'];
	$prevwidth = (int) $options[$number]['pw'];
	$prevheight = (int) $options[$number]['ph'];
	$linktext = htmlspecialchars($options[$number]['linktext']);
	$caption = htmlspecialchars($options[$number]['caption']);
	$expert = htmlspecialchars($options[$number]['expert']);
	?>
	<script type="text/javascript">// <![CDATA[
	function toggleDisplay(itm, display) {
		if (document.getElementById(itm)) { document.getElementById(itm).style.display = display; }
	};
	function toggleActive(number) {
		var newstatus;
		if (document.getElementById('wp_flxerPlayer_widget-preview-'+number).disabled == true) { newstatus = false } else { newstatus = true }
		document.getElementById('wp_flxerPlayer_widget-preview-'+number).disabled = newstatus;
		document.getElementById('wp_flxerPlayer_widget-linktext-'+number).disabled = newstatus;
	};
	// ]]></script><style type="text/css">input:disabled { background-color: #E7E7E7; color: #777777; }</style>
	<div>
		<small style="display: block; float: right;"><?php _e('Empty fields will result in default values.', 'wp-flxerPlayer'); ?></small>
		<label for="wp_flxerPlayer_widget-title-<?php echo $number; ?>" style="width: 50px; display: block; float: left; clear: right; margin-top: 5px;">
			<strong><?php _e('Title', 'wp-flxerPlayer'); ?>:</strong>
		</label>
		<input style="width: 440px; clear: left;" type="text" id="wp_flxerPlayer_widget-title-<?php echo $number; ?>" name="wp_flxerPlayer_widget-title-<?php echo $number; ?>" value="<?php echo $title; ?>" />

		<label for="wp_flxerPlayer_widget-url-<?php echo $number; ?>" style="width: 50px; display: block; float: left; margin-top: 5px;">
			<strong><?php _e('URL', 'wp-flxerPlayer'); ?>:</strong>
		</label>
		<input style="width: 440px; clear: left;" type="text" id="wp_flxerPlayer_widget-url-<?php echo $number; ?>" name="wp_flxerPlayer_widget-url-<?php echo $number; ?>" value="<?php echo $url; ?>" />

		<label for="wp_flxerPlayer_widget-width-<?php echo $number; ?>" style="width: 50px; display: block; float: left; margin-top: 5px;">
			<strong><?php _e('Width', 'wp-flxerPlayer'); ?>:</strong>
		</label>
		<input style="width: 190px; float: left;" type="text" id="wp_flxerPlayer_widget-width-<?php echo $number; ?>" name="wp_flxerPlayer_widget-width-<?php echo $number; ?>" value="<?php echo $width; ?>" />

		<label for="wp_flxerPlayer_widget-height-<?php echo $number; ?>" style="width: 50px; display: block; float: left; margin-top: 5px;">
			<strong><?php _e('Height', 'wp-flxerPlayer'); ?>:</strong>
		</label>
		<input style="width: 190px; clear: left;" type="text" id="wp_flxerPlayer_widget-height-<?php echo $number; ?>" name="wp_flxerPlayer_widget-height-<?php echo $number; ?>" value="<?php echo $height; ?>" />

		<label for="wp_flxerPlayer_widget-mode-<?php echo $number; ?>" style="width: 50px; display: block; float: left; margin-top: 5px;">
			<strong><?php _e('Mode', 'wp-flxerPlayer'); ?>:</strong>
		</label>
		<select style="width: 195px; clear: left;" id="wp_flxerPlayer_widget-mode-<?php echo $number; ?>" name="wp_flxerPlayer_widget-mode-<?php echo $number; ?>">
			<option value="0"<?php if ($mode == 0) { echo ' selected="selected"'; } ?> onclick="javascript:toggleDisplay('fb-settings-<?php echo $number; ?>', 'none')"><?php _e('&lt;object&gt;', 'wp-flxerPlayer'); ?></option>
			<option value="1"<?php if ($mode == 1) { echo ' selected="selected"'; } ?> onclick="javascript:toggleDisplay('fb-settings-<?php echo $number; ?>', 'none')"><?php _e('SWFObject', 'wp-flxerPlayer'); ?></option>
			<option value="2"<?php if ($mode == 2) { echo ' selected="selected"'; } ?> onclick="javascript:toggleDisplay('fb-settings-<?php echo $number; ?>', 'none')"><?php _e('SWFObject (IE only)', 'wp-flxerPlayer'); ?></option>
			<option value="3"<?php if ($mode == 3) { echo ' selected="selected"'; } ?> onclick="javascript:toggleDisplay('fb-settings-<?php echo $number; ?>', 'block')"><?php _e('Flashbox', 'wp-flxerPlayer'); ?></option>
		</select>
		<br />
		<div id="fb-settings-<?php echo $number; ?>" style="display: <?php echo (($mode == 3) ? 'block' : 'none'); ?>"><br />
			<div style="display: block; clear: both">
				<strong style="display: inline; float: left;"><?php _e('Preview image', 'wp-flxerPlayer'); ?></strong>
				<div style="display: inline; float: right;">
					<input type="checkbox" id="wp_flxerPlayer_widget-force-<?php echo $number; ?>" name="wp_flxerPlayer_widget-force-<?php echo $number; ?>"<?php if ( $force == 1 ) echo ' checked="checked"'; ?> value="1" onclick="javascript:toggleActive('<?php echo $number; ?>')" />
					<label for="wp_flxerPlayer_widget-force-<?php echo $number; ?>">
						<?php _e('Force', 'wp-flxerPlayer'); ?>
					</label>
				</div>
			</div>
			<label for="wp_flxerPlayer_widget-preview-<?php echo $number; ?>" style="width: 70px; display: block; float: left; clear: right; margin-top: 5px;">
				<strong><?php _e('URL', 'wp-flxerPlayer'); ?>:</strong>
			</label>
			<input style="width: 420px; clear: left;" type="text" id="wp_flxerPlayer_widget-preview-<?php echo $number; ?>" name="wp_flxerPlayer_widget-preview-<?php echo $number; ?>" value="<?php echo $preview; ?>"<?php if ($force = 1) { echo ' disabled="disabled"'; } ?> />

			<label for="wp_flxerPlayer_widget-prevwidth-<?php echo $number; ?>" style="width: 70px; display: block; float: left; margin-top: 5px;">
				<strong><?php _e('Width', 'wp-flxerPlayer'); ?>:</strong>
			</label>
			<input style="width: 170px; float: left;" type="text" id="wp_flxerPlayer_widget-prevwidth-<?php echo $number; ?>" name="wp_flxerPlayer_widget-prevwidth-<?php echo $number; ?>" value="<?php echo $prevwidth; ?>" />

			<label for="wp_flxerPlayer_widget-prevheight-<?php echo $number; ?>" style="width: 70px; display: block; float: left; margin-top: 5px;">
				<strong><?php _e('Height', 'wp-flxerPlayer'); ?>:</strong>
			</label>
			<input style="width: 170px; clear: left;" type="text" id="wp_flxerPlayer_widget-prevheight-<?php echo $number; ?>" name="wp_flxerPlayer_widget-prevheight-<?php echo $number; ?>" value="<?php echo $prevheight; ?>" />
			
			<label for="wp_flxerPlayer_widget-linktext-<?php echo $number; ?>" style="width: 70px; display: block; float: left; margin-top: 5px;">
				<strong><?php _e('Linktext', 'wp-flxerPlayer'); ?>:</strong>
			</label>
			<input style="width: 420px; clear: left;" type="text" id="wp_flxerPlayer_widget-linktext-<?php echo $number; ?>" name="wp_flxerPlayer_widget-linktext-<?php echo $number; ?>" value="<?php echo $linktext; ?>"<?php if ($force = 1) { echo ' disabled="disabled"'; } ?> />

			<br /><br />
			<label for="wp_flxerPlayer_widget-caption-<?php echo $number; ?>" style="width: 70px; display: block; float: left; margin-top: 5px;">
				<strong><?php _e('Caption', 'wp-flxerPlayer'); ?>:</strong>
			</label>
			<input style="width: 420px; clear: left;" type="text" id="wp_flxerPlayer_widget-caption-<?php echo $number; ?>" name="wp_flxerPlayer_widget-caption-<?php echo $number; ?>" value="<?php echo $caption; ?>" />
		</div>
		
		<br />
		<div style="display: block; clear: both">
			<strong style="display: inline; float: left;"><?php _e('Text', 'wp-flxerPlayer'); ?></strong>
			<div style="display: inline; float: right;">
				&nbsp;&nbsp;<input type="radio" name="wp_flxerPlayer_widget-addtext-<?php echo $number; ?>"<?php if ($addtext == 'no' || empty($addtext)) { echo ' checked="checked"'; } ?> id="wp_flxerPlayer_widget-addtext_no-<?php echo $number; ?>" value="no" onclick="javascript:toggleDisplay('textcontent-<?php echo $number; ?>', 'none')" /> <?php _e('No', 'wp-flxerPlayer'); ?>
				&nbsp;&nbsp;<input type="radio" name="wp_flxerPlayer_widget-addtext-<?php echo $number; ?>"<?php if ($addtext == 'before') { echo ' checked="checked"'; } ?> id="wp_flxerPlayer_widget-addtext_before-<?php echo $number; ?>" value="before" onclick="javascript:toggleDisplay('textcontent-<?php echo $number; ?>', 'block')" /> <?php _e('Before flash', 'wp-flxerPlayer'); ?>
				&nbsp;&nbsp;<input type="radio" name="wp_flxerPlayer_widget-addtext-<?php echo $number; ?>"<?php if ($addtext == 'after') { echo ' checked="checked"'; } ?> id="wp_flxerPlayer_widget-addtext_after-<?php echo $number; ?>" value="after" onclick="javascript:toggleDisplay('textcontent-<?php echo $number; ?>', 'block')" /> <?php _e('After flash', 'wp-flxerPlayer'); ?>
			</div>
			<div id="textcontent-<?php echo $number; ?>" style="display: <?php echo (($addtext == 'no' || empty($addtext)) ? 'none' : 'block'); ?>"><br />
				<textarea style="width: 490px; height: 70px; clear: left;" type="text" id="wp_flxerPlayer_widget-text-<?php echo $number; ?>" name="wp_flxerPlayer_widget-text-<?php echo $number; ?>"><?php echo $text; ?></textarea>
			</div>
		</div>

		<br /><strong><?php _e('Advanced settings', 'wp-flxerPlayer'); ?></strong> <small>(<?php _e('see <a href="http://wordpress.org/extend/plugins/wp-flxerPlayer/installation/" target="_blank">usage</a>', 'wp-flxerPlayer'); ?>)</small></span>
		<input style="width: 490px; clear: left;" type="text" id="wp_flxerPlayer_widget-expert-<?php echo $number; ?>" name="wp_flxerPlayer_widget-expert-<?php echo $number; ?>" value="<?php echo $expert; ?>" />
		
		<input type="hidden" name="wp_flxerPlayer_widget-<?php echo $number; ?>" id="wp_flxerPlayer_widget-<?php echo $number; ?>" value="1" />
	</div>
	<?php
	return;
}

function wp_flxerPlayer_widget_setup() {
	$options = flxer_options();
	if (isset($_POST['wp_flxerPlayer_widget-submit'])) {
		$options['widget']['number'] = (int) $_POST['wp_flxerPlayer_widget-number'];
		update_option('wp_flxerPlayer', $options);
	}
	return;
}

function wp_flxerPlayer_widget_page() {
	$number = flxer_options('widget', 'number');
	?>
		<div class="wrap">
			<form method="post">
				<h2><?php _e('wp-flxerPlayer Widgets', 'wp-flxerPlayer'); ?></h2>
				<p style="line-height: 30px;"><?php _e('How many flash widgets would you like?', 'wp-flxerPlayer'); ?>
					<select id="wp_flxerPlayer_widget-number" name="wp_flxerPlayer_widget-number" value="<?php echo $options['number']; ?>">
						<?php for ($i = 1; $i <= 9; ++$i) echo '<option value="'.$i.'"'.($number==$i ? ' selected="selected"' : '').'>'.$i.'</option>'; ?>
					</select>
					<span class="submit"><input type="submit" name="wp_flxerPlayer_widget-submit" id="wp_flxerPlayer_widget-submit" value="<?php _e('Save', 'wp-flxerPlayer'); ?>" /></span></p>
			</form>
		</div>
	<?php
	return;
}

function wp_flxerPlayer_widget_init() {
	$number = (int) flxer_options('widget', 'number');
	for ($i = 1; $i <= (isset($_POST['wp_flxerPlayer_widget-submit']) ? $_POST['wp_flxerPlayer_widget-number'] : $number); $i++) {
		wp_register_sidebar_widget('wp_flxerPlayer_widget-'.$i, sprintf(__('wp-flxerPlayer Widget #%d', 'wp-flxerPlayer'), $i), 'wp_flxerPlayer_widget_output', array('classname' => 'wp_flxerPlayer_widgets'), $i);
		wp_register_widget_control('wp_flxerPlayer_widget-'.$i, sprintf(__('wp-flxerPlayer Widget #%d', 'wp-flxerPlayer'), $i), 'wp_flxerPlayer_widget_control', array('width' => 520, 'height' => 520), $i);
	}
	add_action('sidebar_admin_setup', 'wp_flxerPlayer_widget_setup');
	add_action('sidebar_admin_page', 'wp_flxerPlayer_widget_page');
	return;
}
?>