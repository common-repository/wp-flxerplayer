<?php
/*
Plugin Name: FLxER Player
Plugin URI: http://wordpress.org/extend/plugins/wp-flxerPlayer/
Description: A filter for WordPress that displays any flash content in valid XHTML code offering the possibility to specify attributes and parameters individually. With admin panel ang gallery possibility.
Version: 1
Author: Gianluca Del Gobbo
Author URI: http://www.flxer.net/

**********************************************************************
Copyright (c) 2007 Pascal Berkhahn
Released under the terms of the GNU GPL: http://www.gnu.org/licenses/gpl.txt

This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
**********************************************************************

Installation: Upload the folder "wp-flxerPlayer" with it's content to "wp-content/plugins/"  and activate the plugin in your admin panel.

Usage, Issues, Change log:
Visit http://wordpress.org/extend/plugins/wp-flxerPlayer/
*/
if (!function_exists('get_option')) { echo "Please don't load this file directly."; exit; }

define('GDG_PATH', dirname(__FILE__));
define('GDG_SITEPATH', get_option('siteurl').'/wp-content/plugins/wp-flxerPlayer');
require_once(GDG_PATH.'/inc/inc.functions.php');
require_once(GDG_PATH.'/inc/inc.settings.php');
require_once(GDG_PATH.'/inc/inc.widgets.php');
include_once(GDG_PATH.'/inc/inc.wp-flxerPlayer-buttonscript.php');

load_textdomain('wp-flxerPlayer', GDG_PATH.'/locales/wp-flxerPlayer-'.get_locale().'.mo');

add_action('wp_head', 'wp_flxerPlayer_js_head');
add_filter('the_content', 'wp_flxerPlayer_plugin');
add_filter('the_excerpt', 'wp_flxerPlayer_plugin');
add_filter('comment_text', 'wp_flxerPlayer_plugin');
add_action('admin_menu', 'wp_flxerPlayer_addAP');
add_action('widgets_init', 'wp_flxerPlayer_widget_init');

register_activation_hook( __FILE__, 'wp_flxerPlayer_activate');
register_deactivation_hook( __FILE__, 'wp_flxerPlayer_deactivate');
?>