<?php
/*
Part of wp-flxerPlayer v1
© Gianluca Del Gobbo, <g.delgobbo@flyer.it>, http://www.flxer.net
*/
if (!function_exists('get_option')) {
	echo "Please don't load this file directly."; exit;
}

function flxer_options($sub = FALSE, $deep = FALSE) {
	require(GDG_PATH.'/inc/inc.options.php');
	$flxer_options = get_option('wp_flxerPlayer');
	if (!empty($flxer_options) && is_array($flxer_options)) {
		foreach ($flxer_options as $k => $o) {
			foreach ($flxer_options[$k] as $key => $option) {
				if (!is_null($option)) {
					$options[$k][$key] = $option;
				}
			}
		}
	}
	return (($sub) ? (($deep) ? $options[$sub][$deep] : $options[$sub]) : $options);
} // flxer_options

function wp_flxerPlayer_js_head() {
	if (flxer_options('main','method') == 1) {
		$add= '
		<!-- FLxER Player javascript -->
		<script type="text/javascript" src="'.flxer_options('main','variablesurl').'"></script>
		<script type="text/javascript" src="'.flxer_options('main','FLX_RunActiveContenturl').'"></script>
		<script type="text/javascript" src="'.flxer_options('main','flashManagerurl').'"></script>
		<!-- END FLxER Player javascript -->
		';
	}
	echo $add;
}
function wp_flxerPlayer_plugin($content) {
	$content = preg_replace_callback(GDG_REGEXP2, 'wp_flxerPlayer_plugin_callback', $content);
	$content = preg_replace_callback(GDG_REGEXP, 'wp_flxerPlayer_plugin_callback', $content);
	return ($content);
} // wp_flxerPlayer_plugin

function wp_flxerPlayer_addAP() {
	if (function_exists('add_options_page')) {
		add_options_page('FLxER Player setup', 'FLxER Player', 9, basename(GDG_PATH), 'wp_flxerPlayer_AP');
	}
	return;
} // wp_flxerPlayer_addAP

function wp_flxerPlayer_AP() {
	require(GDG_PATH.'/inc/inc.wp-flxerPlayer-ap.php');
	return;
} // wp_flxerPlayer_ap

function wp_flxerPlayer_activate() {
	require(GDG_PATH.'/inc/inc.options.php');
	add_option('wp_flxerPlayer', $options, '', 'yes');
	return;
} // wp_flxerPlayer_activate

function wp_flxerPlayer_deactivate() {
	if (intval(flxer_options('main', 'deleteoptionsondeactivation')) === 1) {
		delete_option('wp_flxerPlayer');
		delete_option('wp_flxerPlayer_widgets');
	}
	return;
} // wp_flxerPlayer_deactivate

function wp_flxerPlayer_js($mode) {
	$add = '';
	if (defined('GDG_LOADED_SWFOBJECT') == FALSE && $mode > 0) {
		$add.= '<script type="text/javascript" src="'.flxer_options('main','variablesurl').'"></script>';
		$add.= '<script type="text/javascript" src="'.flxer_options('main','FLX_RunActiveContenturl').'"></script>';
		$add.= '<script type="text/javascript" src="'.flxer_options('main','flashManagerurl').'"></script>';
		define('GDG_LOADED_SWFOBJECT', TRUE);
	}
	return $add;
} // wp_flxerPlayer_js

function gdg_buildpattern($pattern, $source = NULL) {
	if ($source == 'url') { return ('%^(?:http://)?(?:.+\.)?'.$pattern.'[/?&]*.*%i'); }
	else { return ('%(?:^|[[:space:]])'.$pattern.'(?:[[:space:]]|$)%i'); }
} // gdg_buildpattern


if (!function_exists('htmlspecialchars_decode')) {
    function htmlspecialchars_decode($string, $quote_style = ENT_COMPAT) {
        return strtr($string, array_flip(get_html_translation_table(HTML_SPECIALCHARS, $quote_style)));
    }
}

function flxer_mode($mode) {
	if ($mode == 1) {
		$r['mode'] = 1;
		$r['target'] = '<span id="###SWFID###" class="###CLASS###">
		<script type="text/javascript">
				var tmp = new Array();
				tmp.push("###SWFID###");
				tmp.push(###WIDTH###);
				tmp.push(###HEIGHT###);
				tmp.push("###PLAYERURL###");
				tmp.push("###CNTURL###");
				flashToLoad.push(tmp);
		</script>
		###MSG###
		</span>###GALLERY###';
	} else {
		$r['mode'] = 0;
		$r['target'] = '<object type="application/x-shockwave-flash" data="###PLAYERURL######CNTURL###" width="###WIDTH###" height="###HEIGHT###"###ATTRIBUTES### class="###CLASS###"###STYLE###><param name="allowScriptAccess" value="always" /><param name="movie" value="###PLAYERURL###" />###PARAM######FLASHVARS######MSG###</object>###EXTERN### ###GALLERY###';
		//$r['target'] = '<object type="application/x-shockwave-flash" data="###PLAYERURL######CNTURL###" width="###WIDTH###" height="###HEIGHT###"###ATTRIBUTES### class="###CLASS###"###STYLE###><param name="movie" value="###PLAYERURL###" />###PARAM######FLASHVARS######MSG###</object>###EXTERN###';
	}
	return ($r);
} // flxer_mode

function galleryDrawer($s,$swfid,$class,$p) {
	$gal = split("#",$s);
	//$str = "\n<div class=\"".$class."Cnt\">\n	<div class=\"".$class."Tit\">".$p."</div>\n	<ul class=\"".$class."List\">\n";
	$str = "\n<div class=\"".$class."Cnt\">\n		<ul class=\"".$class."List\">\n";
	$cat = array();
	foreach($gal as $item) {
		$galItem = split(";",$item);
		$file = $galItem[0];
		$tit = $galItem[1];
		if ($galItem[2]) {
			$cat[$galItem[2]].= "		<li><a href=\"#\" onclick=\"setContentLoader('".$swfid."swf','".$file.",".$tit."');return false;\">".$tit."</a></li>\n";
		} else {
			$str.= "		<li><a href=\"#\" onclick=\"setContentLoader('".$swfid."swf','".$file.",".$tit."');return false;\">".$tit."</a></li>\n";
		}
	}
	if (count($cat)>0) {
		foreach($cat as $nome=>$item){
			$str.= "\n<li><span>".$nome."</span><ul>\n".$item."</ul></li>\n";
		}
	}
	$str.= "	</ul>\n</div><hr class=\"".$class."Hr\" />\n";
	return ($str);
} // flxer_mode




function wp_flxerPlayer_plugin_callback($match) { global $gdg_jwmp_extensions; global $flxer_options;
	$match[1] = str_replace('&#215;', '&#120;', $match[1]); // replaces the multiplication character "x" with the alphabetical "x" again because WordPress did the same vice-versa before.
	$getmode = flxer_mode(((preg_match(gdg_buildpattern('mode=(\d)'),$match[2],$hit)) ? $hit[1] : $flxer_options['main']['method']));
	$mode = $getmode['mode'];
	$output = $getmode['target'];
	
	$output = str_replace('###MSG###', '<small>('.(
		(is_search() || is_feed()) // search results don't offer HTML, so no <object>, too; some feed reader  don't support <oject> and <a>...
			? (($flxer_options['messages']['openarticle'])
				? $flxer_options['messages']['openarticle']
				: __('Please open the article to see the flash file or player.', 'wp-flxerPlayer')
			) : (($flxer_options['messages']['nojs']) // adding message about missing JavaScript and/or an old Flash Player
				? $flxer_options['messages']['nojs']
				: __('Either JavaScript is not active or you are using an old version of Adobe Flash Player. <a href="http://www.adobe.com/de/">Please install the newest Flash Player</a>.', 'wp-flxerPlayer')
			)
		).')</small>', $output);
	
	$fileinfo = pathinfo(array_shift(explode('?', basename($match[1]))));
	$extension = array_search(strtolower($fileinfo['extension']), $gdg_jwmp_extensions);

// Main Config
	if ($extension) {
		if (preg_match(gdg_buildpattern('f={(.+?)}'),$match[2],$hit) && $hit[1] != ' ') {
			$flashvars = explode('&amp;',$hit[1]);
			$options = $flxer_options['flashvars'];
			foreach($flashvars as $f) {
				$e = explode('=',$f);
				$options[$e[0]] = $e[1];
			} unset($flashvars);
			foreach ($options as $key => $option) {
				if ($option) {
					if ($mode == 1) { $flashvars .= 'flashvars.'.$key.' = "'.$option.'";'; }
					else { $flashvars .= '&amp;'.$key.'='.$option; }
				}
			}
		}
		$output = str_replace('###PLAYERURL###', $flxer_options['main']['playerurl'], $output);
		$output = str_replace('###CNTURL###', get_option('siteurl').$match[1], $output);
		$output = str_replace('###FLASHVARS###', (empty($flashvars) ? '' : (($mode == 1) ? $flashvars : '<param name="flashvars" value="'.substr($flashvars, 5).'" />')), $output);
	} else { // not a flv file - what may it be?
		$i = 0; global $gdg_hosters;
		while (isset($gdg_hosters[$i][0])) // search for YouTube, Google Video, etc.
		{
			if (preg_match(gdg_buildpattern($gdg_hosters[$i][0], 'url'),$match[1],$hit) && (count($gdg_hosters[$i]) >= 5)) {
				$output = str_replace('###PLAYERURL###', str_replace('###ID###', $hit[1], $gdg_hosters[$i][1]), $output);
				$output = str_replace('###CNTURL###', "", $output);
				//if ($flxer_options['flashbox']['loadpreviewimage'] || (isset($match[2]) && strpos($match[2],'preview=force') !== FALSE)) { $pp = str_replace('###ID###', $hit[1], $gdg_hosters[$i][5]); }
				if (isset($match[2]) && preg_match(gdg_buildpattern('w=(.+?)'),$match[2],$hit)) { $output = str_replace('###WIDTH###', $hit[1], $output); }
				else { $output = str_replace('###WIDTH###', $gdg_hosters[$i][2], $output); }
				if (isset($match[2]) && preg_match(gdg_buildpattern('h=(.+?)'),$match[2],$hit)) { $output = str_replace('###HEIGHT###', $hit[1], $output); }
				else { $output = str_replace('###HEIGHT###', $gdg_hosters[$i][3], $output); }
				if (isset($match[2]) && preg_match(gdg_buildpattern('title=(.+?)'),$match[2],$hit)) { $output = str_replace($match[1], $match[1].",".$hit[1], $output); }
				else { $output = str_replace($match[1], $match[1].",".$gdg_hosters[$i][3], $output); }
				$break = TRUE; break 1; // stop searching if we found sth.
			}
			$i++; // we don't want an infinite loop ;)
		}
		if (!isset($break)) // seems to be a normal swf or an unknown video hoster
		{
			if (strpos($match[1], "id=")>-1 && strpos($match[1], "flxer.net")>-1) {
				$tmp = split("id=",$match[1]);
				$output = str_replace('###PLAYERURL###', "http://www.flxer.net/_fp/flxerPlayer4.swf?cnt=http://www.flxer.net/_fp/fpGallery.php?id=p".$tmp[1], $output);
				$output = str_replace('###CNTURL###', "", $output);
			} else {
				$output = str_replace('###PLAYERURL###', $match[1], $output);
			}
		}
	}
// Unique ID for SWFObject
	if ($mode == 1) {
		$swfid = md5(mt_rand().$match[1]);
		$output = str_replace('###SWFID###', $swfid, $output);
	}
// process values
	if(isset($match[2])) {
	//Class
		if (preg_match(gdg_buildpattern('class=(.+?)'),$match[2],$hit)) {
			$class = $hit[1];
		} else {
			$class = $flxer_options['main']['defclass'];
		}
		$output = str_replace('###CLASS###', $class, $output);
		if (!isset($break)) {
			if (preg_match(gdg_buildpattern('gallery={(.+?)}'),$match[2],$hit) && $hit[1] != ' ') {
				$output = str_replace('###GALLERY###', galleryDrawer($hit[1],$swfid, $class, $flxer_options['main']['galleryTit']), $output);
			} else {
				$output = str_replace('###GALLERY###', '', $output);
			}
		
			if (preg_match(gdg_buildpattern('w=(.+?)'),$match[2],$hit)) { $output = str_replace('###WIDTH###', $hit[1], $output); }
			else { $output = str_replace('###WIDTH###', $flxer_options['main']['defwidth'], $output); }
		
			if (preg_match(gdg_buildpattern('h=(.+?)'),$match[2],$hit)) { $output = str_replace('###HEIGHT###', $hit[1], $output); }
			else { $output = str_replace("###HEIGHT###", $flxer_options['main']['defheight'], $output); }

			if (preg_match(gdg_buildpattern('title=(.+?)'),$match[2],$hit)) { $output = str_replace($match[1], $match[1].",".$hit[1], $output); }
			else { $output = str_replace($match[1], $match[1].",".$flxer_options['main']['deftitle'], $output); }
		}
	// Style
		if (preg_match(gdg_buildpattern('style={(.+?)}'),$match[2],$hit) && $hit[1] != ' ') { $output = str_replace('###STYLE###', ' style="'.$hit[1].'"', $output); }
		else { $output = str_replace('###STYLE###', '', $output); }
	// Extern
		if (preg_match(gdg_buildpattern('extern={(.+?)}'),$match[2],$hit) && $hit[1] != ' ' && !is_search()) {
			$eExp = explode('|',$hit[1]);
			if ($eExp[0] == $hit[1] && !isset($eExp[1])) {
				$output = str_replace('###EXTERN###', '<br /><a href="'.$match[1].'" title="'.$hit[1].'">'.$hit[1].'</a>', $output);
			} else {
				$output = str_replace('###EXTERN###', '<br /><a href="'.$eExp[1].'" title="'.$eExp[0].'">'.$eExp[0].'</a>', $output);
			}
		} elseif (preg_match(gdg_buildpattern('extern=1'),$match[2]) && isset($break) && $gdg_hosters[$i][4] && !is_search()) { 
			$output = str_replace('###EXTERN###', '<br /><a href="'.$match[1].'" title="'.__('Watch it at', 'wp-flxerPlayer').' '.$gdg_hosters[$i][4].'">'.__('Watch it at', 'wp-flxerPlayer').' '.$gdg_hosters[$i][4].'</a>', $output);
		} else { 
			$output = str_replace('###EXTERN###', '', $output);
		}
	// Attributes
		if (preg_match(gdg_buildpattern('o={(.+?)}'),$match[2],$hit)) {
			$hit[1] = str_replace('&#8221;', '"', $hit[1]); // replaces the characters &#8221; and &#8243; with the real quote character again because WordPress did the same vice-versa before.
			$hit[1] = str_replace('&#8243;', '"', $hit[1]);
			if ($mode == 1) {
				$attr = explode(' ',$hit[1]);$attributes='';
				foreach($attr as $a) {
					if (preg_match('%(.+?)="{(.+?)}"%',$a,$e)) {
						$attributes .= 'attributes.'.$e[0].' = "'.$e[1].'";';
					}
				} unset($attr);
				$output = str_replace('###ATTRIBUTES###', ' '.$attributes, $output);
			} else {
				$output = str_replace('###ATTRIBUTES###', ' '.$hit[1], $output);
			}
		} else {
			$output = str_replace('###ATTRIBUTES###', '', $output);
		}
	// Params
		if (preg_match(gdg_buildpattern('p={(.+?)}'),$match[2],$hit)) {
			if (strpos($hit[1], 'allowfullscreen') !== FALSE) { $hit[1] = 'allowfullscreen;true|'.$hit[1]; }
			if (strpos($hit[1], 'allowscriptaccess') !== FALSE) { $hit[1] = 'allowscriptaccess;always|'.$hit[1]; }
			$pList = explode('|',$hit[1]);array($pExp);array($params);$p_param='';
			foreach ($pList as $p) {
				$pExp = explode(';',$p);
				$params[$pExp[0]] = $pExp[1];
			} unset($pList, $pExp);
			foreach ($params as $k => $o) {
				if ($mode == 1) {
					$p_param .= 'params.'.$k.' = "'.$o.'";';
				} else {
					$p_param .= '<param name="'.$k.'" value="'.$o.'" />';
				}
			} unset($params);
			$output = str_replace('###PARAM###', $p_param, $output);
		} else {
			if ($extension) {
				$output = str_replace('###PARAM###', ($mode == 1) ? 'params.allowfullscreen = "true"; params.allowscriptaccess = "always";' : '<param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" />', $output);
			} else {
				$output = str_replace('###PARAM###', '', $output);
			}
		}
	// Flashvars
		if (preg_match(gdg_buildpattern('f={(.+?)}'),$match[2],$hit) && $hit[1] != ' ') {
			if ($mode == 1) {
				$flashvars = explode('&amp;',$hit[1]);
				foreach($flashvars as $f) {
					$f = explode('=',$f);
					$f_flashvars .= 'flashvars.'.$f[0].' = "'.$f[1].'";';
				}
			} else {
				$output = str_replace('###FLASHVARS###', '<param name="flashvars" value="'.$hit[1].'" />', $output);
			}
		} else {
			$output = str_replace('###FLASHVARS###', '', $output);
		}

// use default values if none specified		
	} else {
		if (!isset($break)) {
			$output = str_replace('###WIDTH###', $flxer_options['main']['defwidth'], $output);
			$output = str_replace('###HEIGHT###', $flxer_options['main']['defheight'], $output);
		}
		$output = str_replace('###CLASS###', $flxer_options['main']['defclass'], $output);
		$output = str_replace('###STYLE###', '', $output);
		$output = str_replace('###EXTERN###', '', $output);
		$output = str_replace('###ATTRIBUTES###', '', $output);
		if ($mode <= 1) {
			$output = str_replace('###PARAM###', ($mode == 1) ? 'params.allowfullscreen = "true"; params.allowscriptaccess = "always";' : '<param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" />', $output);
			$output = str_replace('###FLASHVARS###', '', $output);
		}
	}
	unset($break, $extension, $mode);
	return ($output);
} // wp_flxerPlayer
?>