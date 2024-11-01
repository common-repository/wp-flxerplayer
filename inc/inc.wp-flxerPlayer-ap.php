<?php
/*
Part of wp-flxerPlayer v1
© Gianluca Del Gobbo, <g.delgobbo@flyer.it>, http://www.flxer.net
*/
if (!function_exists('get_option')) { echo "Please don't load this file directly."; exit; }

$flxer_options = flxer_options();
if (isset($_POST['update-gdg'])) {
	foreach ($_POST as $key => $option) {
		if (isset($_POST[$key]) && $key != 'update-gdg') {
			$k = explode('_', $key);
			$flxer_options[$k[0]][$k[1]] = ($option == '') ? NULL : stripslashes($option);
		}
	}
	update_option('wp_flxerPlayer', $flxer_options);
	?><div class="updated"><p><strong><?php _e('Settings Updated.', 'wp-flxerPlayer');?></strong></p></div><?
}
?><link rel="stylesheet" type="text/css" href="<?php echo GDG_SITEPATH ?>/css/admin.css" />
<style type="text/css" media="screen">
a.bg{background: no-repeat;padding-left: 20px;border: 0 none;}
a.linkauthor{background-image: url('<?php echo get_option('siteurl'); ?>/?gdg_resource=author.png');}
a.linkwp{background-image: url('<?php echo get_option('siteurl'); ?>/?gdg_resource=wordpress.png');}
</style>

<script type="text/javascript">// <![CDATA[
	function toggleDisplay(itm) {
		var display;
		if (document.getElementById(itm).style.display == 'block') { display = 'none'; } else { display = 'block' }
		if (document.getElementById(itm)) { document.getElementById(itm).style.display = display; }
		if (document.forms['gdg_ap'].elements['apd_'+itm]) { document.forms['gdg_ap'].elements['apd_'+itm].value = display; }
	};
// ]]></script>
<script type="text/javascript" src="<?php echo GDG_SITEPATH ?>/js/colorpicker.js"></script>
<script type="text/javascript" src="../wp-includes/js/dbx.js"></script>
<script type="text/javascript">//<![CDATA[
addLoadEvent(function() {
	var manager = new dbxManager('gdg_meta');
	//create new docking boxes group
	var meta = new dbxGroup(
		'grabit', // container ID [/-_a-zA-Z0-9/]
		'vertical', // orientation ['vertical'|'horizontal']
		'10', // drag threshold ['n' pixels]
		'no', // restrict drag movement to container axis ['yes'|'no']
		'10', // animate re-ordering [frames per transition, or '0' for no effect]
		'yes', // include open/close toggle buttons ['yes'|'no']
		'open', // default state ['open'|'closed']
		'<?php _e('open') ?>', // word for "open", as in "open this box"
		'<?php _e('close') ?>', // word for "close", as in "close this box"
		'Dr&uuml;cke runter und ziehe, um die Box zu bewegen', // sentence for "move this box" by mouse
		'dr&uuml;cken, um die Box %umzuschalten%', // pattern-match sentence for "(open|close) this box" by mouse
		'benutze die Pfeiltasten, um diese Box zu bewegen', // sentence for "move this box" by keyboard
		'oder dr&uuml;cke Enter, um sie %umzuschalten%',  // pattern-match sentence-fragment for "(open|close) this box" by keyboard
		'%mytitle%  [%dbxtitle%]' // pattern-match syntax for title-attribute conflicts
	);
	var advanced = new dbxGroup(
		'advancedstuff', 'vertical', '10', 'yes', '10', 'yes', 'open',
		'<?php _e('open') ?>', '<?php _e('close') ?>', 'Dr&uuml;cke runter und ziehe, um die Box zu bewegen', 'dr&uuml;cken, um die Box %umzuschalten%', 'benutze die Pfeiltasten, um diese Box zu bewegen', 'oder dr&uuml;cke Enter, um sie %umzuschalten%',
		'%mytitle%  [%dbxtitle%]'
	);
});
//]]></script>

<div class="wrap">
	<h2>FLxER Player</h2>
	<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" name="gdg_ap" method="post">			
		<div id="poststuff">
			<div id="moremeta">		
				<div id="grabit" class="dbx-group">
					<fieldset id="gdg_links" class="dbx-box">
						<h3 class="dbx-handle"><?php _e('About this plugin', 'wp-flxerPlayer'); ?>:</h3>
						<div class="dbx-content">
							<a href="http://wordpress.org/extend/plugins/wp-flxerPlayer/" class="bg linkwp"><?php _e('Plugin site', 'wp-flxerPlayer'); ?></a>
							<br /><a href="http://www.flxer.net/" class="bg linkauthor"><?php _e('Author', 'wp-flxerPlayer'); ?></a>
							<br /><a href="http://wordpress.org/tags/wp-flxerPlayer?forum_id=10#postform" class="bg linkwp"><?php _e('Post bugs or questions', 'wp-flxerPlayer'); ?></a>
						</div>
					</fieldset>
					<fieldset id="gdg_donation" class="dbx-box">
						<h3 class="dbx-handle"><?php _e('Donate', 'wp-flxerPlayer'); ?>:</h3>
						<div class="dbx-content" style="text-align: center;">
							<form method="post" action="https://www.paypal.com/cgi-bin/webscr">
								<input type="hidden" value="_s-xclick" name="cmd" /> <input type="image" border="0" alt="PayPal - Donate to FLxER!" name="submit" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" /> <img width="1" height="1" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" alt="PayPal - Donate to FLxER!" /> <input type="hidden" value="<?php echo get_option('siteurl'); ?>/?gdg_resource=paypal.value" name="encrypted" />
							</form><br />
							<span><small><?php _e('Thanks for your support!', 'wp-flxerPlayer'); ?></small></span>
						</div>
					</fieldset>
					<fieldset id="gdg_save" class="dbx-box">
						<h3 class="dbx-handle"><?php _e('Save', 'wp-flxerPlayer'); ?>:</h3>
						<div class="dbx-content" style="text-align: center;">
							<span class="submit"><input type="submit" name="update-gdg" value="<?php _e('Save', 'wp-flxerPlayer'); ?> &raquo;" /></span>
						</div>
					</fieldset>	
				</div>
			</div>
			<div id="advancedstuff" class="dbx-group">
				<div class="dbx-b-ox-wrapper">
					<fieldset id="gdg_choose" class="dbx-box">
						<div class="dbx-h-andle-wrapper"><h3 class="dbx-handle"><?php _e('Please choose the method how to embed your flash content', 'wp-flxerPlayer'); ?></h3></div>
						<div class="dbx-c-ontent-wrapper">
							<div class="dbx-content">
								<?php _e('There are currently two options of embedding flash content supported by this Plugin:<ul>
<li>The &lt;object&gt; tag is the safest way, because it embeds your flash content in valid XHTML Strict code directly into the source code of the file.</li>
<li>SWFObject is a JavaScript class, so JavaScript has to be supported and enabled by the browser.</li>
</ul>', 'wp-flxerPlayer'); ?>
								<input class="radio" type="radio" id="method_objecttag" name="main_method" value="0"<?php if ($flxer_options['main']['method'] == 0) { echo ' checked="checked"'; }?> />
								<label for="method_objecttag"><?php _e('&lt;object&gt; tag', 'wp-flxerPlayer'); ?></label>
								<br />
								<input class="radio" type="radio" id="method_swfobject" name="main_method" value="1"<?php if ($flxer_options['main']['method'] == 1) { echo ' checked="checked"'; }?> />
								<label for="method_swfobject"><?php _e('SWFObject (JavaScript)', 'wp-flxerPlayer'); ?></label>
							</div>
						</div>
					</fieldset>
				</div>
				<div class="dbx-b-ox-wrapper">
					<fieldset id="gdg_main" class="dbx-box">
						<div class="dbx-h-andle-wrapper"><h3 class="dbx-handle"><?php _e('Main options', 'wp-flxerPlayer'); ?></h3></div>
						<div class="dbx-c-ontent-wrapper">
							<div class="dbx-content">
								<?php _e('Here you can set the default values used for embedding flash content:', 'wp-flxerPlayer'); ?>
								<br /><br /><label for="deftitle" class="blocktext"><?php _e('Default movie title:', 'wp-flxerPlayer'); ?></label>&nbsp;
								<input type="text" id="deftitle" class="textfield" name="main_deftitle" value="<?php echo $flxer_options['main']['deftitle']; ?>" /> <small><?php _e('default', 'wp-flxerPlayer'); ?>: Untitled</small><br />
								<label for="defwidth" class="blocktext"><?php _e('Default width:', 'wp-flxerPlayer'); ?></label>&nbsp;
								<input type="text" id="defwidth" class="textfield" name="main_defwidth" value="<?php echo $flxer_options['main']['defwidth']; ?>" /> <small><?php _e('default', 'wp-flxerPlayer'); ?>: 425</small><br />
								<label for="defheight" class="blocktext"><?php _e('Default height:', 'wp-flxerPlayer'); ?></label>&nbsp;
								<input type="text" id="defheight" class="textfield" name="main_defheight" value="<?php echo $flxer_options['main']['defheight']; ?>" /> <small><?php _e('default', 'wp-flxerPlayer'); ?>: 355</small><br />
								<label for="defclass" class="blocktext"><?php _e('Default class:', 'wp-flxerPlayer'); ?></label>&nbsp;
								<input type="text" id="defclass" class="textfield" name="main_defclass" value="<?php echo $flxer_options['main']['defclass']; ?>" /> <small><?php _e('default', 'wp-flxerPlayer'); ?>: embedflash</small><br />
								<label for="galleryTit" class="blocktext"><?php _e('Default Gallery title:', 'wp-flxerPlayer'); ?></label>&nbsp;
								<input type="text" id="galleryTit" class="textfield" name="main_galleryTit" value="<?php echo $flxer_options['main']['galleryTit']; ?>" /> <small><?php _e('default', 'wp-flxerPlayer'); ?>: FLxER Gallery</small><br />
								<div style="margin-left: 25px;">
									<acronym title="<?php _e('Set to No if you want to keep all settings (e.g. for updating).', 'wp-flxerPlayer'); ?>"><?php _e('Delete settings on plugin deactivation?', 'wp-flxerPlayer'); ?></acronym>
									<br />
									<input class="radio" type="radio" id="deleteoptionsondeactivation_yes" name="main_deleteoptionsondeactivation" value="1"<?php if ($flxer_options['main']['deleteoptionsondeactivation'] == 1) { echo ' checked="checked"'; }?> />
									<label for="deleteoptionsondeactivation_yes"><?php _e('Yes', 'wp-flxerPlayer'); ?></label>
									&nbsp;&nbsp;&nbsp;&nbsp;
									<input class="radio" type="radio" id="deleteoptionsondeactivation_no" name="main_deleteoptionsondeactivation" value="0"<?php if ($flxer_options['main']['deleteoptionsondeactivation'] == 0) { echo ' checked="checked"'; }?> />
									<label for="deleteoptionsondeactivation_no"><?php _e('No', 'wp-flxerPlayer'); ?></label>
								</div>





							</div>
						</div>
					</fieldset>
				</div>
				<div class="dbx-b-ox-wrapper">
					<fieldset id="gdg_messages" class="dbx-box">
						<div class="dbx-h-andle-wrapper"><h3 class="dbx-handle"><?php _e('Messages', 'wp-flxerPlayer'); ?></h3></div>
						<div class="dbx-c-ontent-wrapper">
							<div class="dbx-content">
								<?php _e('Overwrite default messages.', 'wp-flxerPlayer'); ?>
								<br /><label for="msg_nojs" class="blocktext"><?php _e('Message if JavaScript is deactivated', 'wp-flxerPlayer'); ?>:</label>&nbsp;
								<input type="text" id="msg_nojs" class="textfield" name="messages_nojs" value="<?php echo htmlspecialchars($flxer_options['messages']['nojs']); ?>" />
								<br /><small><?php _e('default', 'wp-flxerPlayer'); ?>: <?php echo htmlspecialchars(__('Either JavaScript is not active or you are using an old version of Adobe Flash Player. <a href="http://www.adobe.com/de/">Please install the newest Flash Player</a>.', 'wp-flxerPlayer')); ?></small><br />
								<label for="msg_openarticle" class="blocktext"><?php _e('Message for feeds and search results', 'wp-flxerPlayer'); ?>:</label>&nbsp;
								<input type="text" id="msg_openarticle" class="textfield" name="messages_openarticle" value="<?php echo htmlspecialchars($flxer_options['messages']['openarticle']); ?>" />
								<br /><small><?php _e('default', 'wp-flxerPlayer'); ?>: <?php echo htmlspecialchars(__('Please open the article to see the flash file or player.', 'wp-flxerPlayer')); ?></small>
							</div>
						</div>
					</fieldset>
				</div>
			</div>
			<p class="submit"><input type="submit" name="update-gdg" value="<?php _e('Update Settings', 'wp-flxerPlayer'); ?> &raquo;" /></p>
		</div>
	</form>
</div>
