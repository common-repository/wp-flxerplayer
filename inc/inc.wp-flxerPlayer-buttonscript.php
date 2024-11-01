<?php
/*
Part of wp-flxerPlayer v1
© Gianluca Del Gobbo, <g.delgobbo@flyer.it>, http://www.flxer.net
*/
if (!function_exists('get_option')) { echo "Please don't load this file directly."; exit; }

function insert_gdg_script() {	
 
 	//TODO: Do with WP2.1 Script Loader
 	// Thanks for this idea to www.jovelstefan.de
	echo "\n"."
	<script type='text/javascript'>
		function gdg_buttonscript() {
		if(window.tinyMCE) {
			var template = new Array();
			template['file'] = '".GDG_SITEPATH."/inc/inc.wp-flxerPlayer-ap-button.php';
			template['width'] = 450;
			template['height'] = 255;
			args = {
				resizable : 'no',
				scrollbars : 'no',
				inline : 'yes'
			};
			tinyMCE.openWindow(template, args);
			return true;
		}
	}
	</script>"; 
	return;
}

function gdg_addbuttons() {
	global $wp_db_version;

	// Don't bother doing this stuff if the current user lacks permissions
	if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) return;
	 
	// Add only in Rich Editor mode
	if ( get_user_option('rich_editing') == 'true') {
		// add the button for wp21 in a new way
		add_filter('mce_plugins', 'gdg_button_plugin', 5);
		add_filter('mce_buttons', 'gdg_button', 5);
		add_action('tinymce_before_init','gdg_button_script');
	}
}

// used to insert button in wordpress 2.1x editor
function gdg_button($buttons) {
	array_push($buttons, 'separator', 'wp-flxerPlayer');
	return $buttons;
}

// Tell TinyMCE that there is a plugin (wp2.1)
function gdg_button_plugin($plugins) {
	array_push($plugins, '-wp-flxerPlayer');    
	return $plugins;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.1)
function gdg_button_script() {
 	$pluginURL =  GDG_SITEPATH.'js/';
	echo 'tinyMCE.loadPlugin("wp-flxerPlayer", "'.GDG_SITEPATH.'/js/tinymceplugin/");' . "\n"; 
	return;
}

add_action('init', 'gdg_addbuttons');
add_action('edit_page_form', 'insert_gdg_script');
add_action('edit_form_advanced', 'insert_gdg_script');
?>