<?php
/*
Part of wp-flxerPlayer v1
© Gianluca Del Gobbo, <g.delgobbo@flyer.it>, http://www.flxer.net
*/
if (!function_exists('get_option')) { echo "Please don't load this file directly."; exit; }

define('GDG_REGEXP', '%\[flash ([\w$-.+!*\'()@:?=&/;#\%]+)\]%i');
define('GDG_REGEXP2', '%\[flash ([\w$-.+!*\'()@:?=&/;#\%]+)[[:space:]](.*?)\]%i');
$flxer_options = flxer_options();
$gdg_jwmp_extensions = array (1 => 'flv', 'mp3', 'png', 'jpg', 'gif', 'xml', 'swf');
$gdg_hosters = array // let's build a multidimensional array containing information about video host platforms
( //  Note: the pattern will be completed with the pb_buildpattern function (to prevent general user mistypings)
	array
	( // YouTube
		'youtube\.com/watch\?v=([\w-]+)', // part of the regular expression pattern
		'http://www.youtube.com/v/###ID###', // video href
		425, // width
		355, // height
		'YouTube', // name of the hoster for extern=1: "Watch it at..."; used for preview image, too
		'http://i.ytimg.com/vi/###ID###/0.jpg' // preview image for Flashbox
	), array ( /* Google Video */ 'video\.google\..+?/videoplay\?docid=([-]?[0-9]+)', 'http://video.google.com/googleplayer.swf?docId=###ID###', 400, 326, 'Google Video', ''
	), array ( /* Revver */ 'one\.revver\.com/watch/([0-9]+)', 'http://flash.revver.com/player/1.0/player.swf?mediaId=###ID###&amp;affiliateId=0&amp;allowFullScreen=true', 480, 392, 'Revver', ''
	), array ( /* Revver */ 'revver\.com/video/([0-9]+)', 'http://flash.revver.com/player/1.0/player.swf?mediaId=###ID###&amp;width=480&amp;height=392', 480, 392, 'Revver', ''
	), array ( /* SevenLoad (en, de) */ 'sevenload\.com/videos/(\w+)', 'http://de.sevenload.com/pl/###ID###/425x350/swf', 425, 350, 'SevenLoad', ''
	), array ( /* Vimeo */ 'vimeo\.com/(?:clip:)?([0-9]+)', 'http://www.vimeo.com/moogaloop.swf?clip_id=###ID###&amp;server=www.vimeo.com&amp;fullscreen=1&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0', 400, 302, 'Vimeo', ''
	), array ( /* GUBA */ 'guba\.com/watch/([0-9]+)', 'http://www.guba.com/f/root.swf?video_url=http://free.guba.com/uploaditem/###ID###/flash.flv&amp;isEmbeddedPlayer=true', 375, 360, 'GUBA', ''
	), array ( /* ClipFish */ 'clipfish\.de/player\.php\?videoid=([a-zA-z0-9=]+)', 'http://www.clipfish.de/videoplayer.swf?as=0&amp;videoid=###ID###&amp;r=1', 464, 380, 'ClipFish', ''
	), array ( /* MetaCafe */ 'metacafe\.com/watch/([0-9]+/.+?)', 'http://www.metacafe.com/fplayer/###ID###.swf', 400, 345, 'MetaCafe', ''
	), array ( /* MyVideo */ 'myvideo\.de/watch/([0-9]+)', 'http://www.myvideo.de/movie/###ID###', 470, 406, 'MyVideo', ''
	), array ( /* Veoh */ 'veoh.com/videos/(\w+)', 'http://www.veoh.com/videodetails2.swf?permalinkId=###ID###&amp;id=anonymous&amp;player=videodetailsembedded&amp;videoAutoPlay=0', 540, 438, 'Veoh', ''
	), array ( /* ifilm */ 'ifilm.com/video/([0-9]+)', 'http://www.ifilm.com/efp?flvbaseclip=###ID###', 448, 365, 'ifilm', ''
	), array ( /* MySpace Videos */ 'vids\.myspace\.com/index\.cfm\?.+?videoid=([0-9]+)', 'http://lads.myspace.com/videos/vplayer.swf?m=###ID###&amp;type=video', 430, 346, 'MySpace Videos', ''
	), array ( /* Brightcove */ 'brightcove\.tv/title\.jsp\?title=([0-9]+)', 'http://www.brightcove.tv/playerswf?initVideoId=###ID###&amp;servicesURL=http://www.brightcove.tv&amp;viewerSecureGatewayURL=https://www.brightcove.tv&amp;cdnURL=http://admin.brightcove.com&amp;autoStart=false', 486, 412, 'Brightcove', ''
	), array ( /* aniBOOM */ 'aniboom\.com/Player\.aspx\?v=([0-9]+)', 'http://api.aniboom.com/embedded.swf?videoar=###ID###', 448, 372, 'aniBOOM', ''
	), array ( /* vSocial */ 'vsocial\.com/video/\?d=([0-9]+)', 'http://static.vsocial.com/flash/ups.swf?d=###ID###&amp;a=0', 400, 410, 'vSocial', ''
	), array ( /* GameVideos */ 'gamevideos\.com/video/id/([0-9]+)', 'http://www.gamevideos.com:80/swf/gamevideos11.swf?embedded=1&amp;fullscreen=1&amp;autoplay=0&amp;src=http://www.gamevideos.com:80/video/videoListXML%3Fid%3D###ID###%26adPlay%3Dfalse', 405, 420, 'GameVideos', 'http://download.gamevideos.com/###ID###/thumbnail.jpg'
	//), array ( /* VideoTube */ 'videotube\.de/watch/([0-9]+)', 'http://www.videotube.de/ci/flash/videotube_player_4.swf?videoId=###ID###&amp;host=www.videotube.de', 480, 400, 'VideoTube', ''
	), array ( /* AOL UnCut */ 'uncutvideo\.aol\.com/videos/(?:.+/)?(\w+)', 'http://uncutvideo.aol.com/v0.750/en-US/uc_videoplayer.swf?&amp;aID=1###ID###&amp;site=http://uncutvideo.aol.com/', 415, 347, 'AOL UnCut', ''
	), array ( /* grouper */ 'grouper\.com/video/MediaDetails\.aspx\?id=([0-9]+)', 'http://grouper.com/mtg/mtgPlayer.swf?v=1.7&amp;ap=0&amp;mu=0&amp;rf=-1&amp;vfver=8&amp;extid=-1&amp;extsite=-1&amp;id=###ID###', 400, 325, 'grouper', ''
	// some problems... - Grab the video-source from the html code the hosters offer (extern=1 not working) - using fallback to apply at least width & height
	), array ( /* BLIP.tv - videoID/Name not in URL */ 'blip\.tv/file/get/(\w+)\.flv', 'http://blip.tv/file/get/###ID###.flv', 320, 240, '', ''
	), array ( /* Yahoo! (com, de) - itemID instead of videoID in URL */ 'us\.i1\.yimg\.com/cosmos\.bcst\.yahoo\.com/player/media/swf/FLVVideoSolo\.swf\?vid=([0-9]+)', 'http://us.i1.yimg.com/cosmos.bcst.yahoo.com/player/media/swf/FLVVideoSolo.swf?vid=###ID###', 425, 350, '', ''
	), array ( /* Garage TV - videoID is encrypted in URL */ 'garagetv\.be/v/(.+)/v\.aspx', 'http://www.garagetv.be/v/###ID###/v.aspx', 430, 398, '', ''
	), array ( /* Break.com - videoID not in URL/Permalink */ 'embed\.break\.com/(\w+)', 'http://embed.break.com/###ID###', 425, 350, '', ''
	), array ( /*  dailymotion - videoID is encrypted in URL */ 'dailymotion\.com/swf/(\w+)', 'http://www.dailymotion.com/swf/###ID###', 400, 310, '', ''
	)
);


if(isset($_GET['gdg_resource']) && !empty($_GET['gdg_resource'])) {
	# base64 encoding performed http://www.greywyvern.com/code/php/binary2base64
	$gdg_resources = array(
		'paypal.value' =>
			'-----BEGIN PKCS7-----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-----END PKCS7-----',
		'wordpress.png' =>
			'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAFfKj/FAAAAB3RJTUUH1wYQEiwG00adjQAAAAlwSFlzAAALEgAACxIB0t1+/AAAAARnQU1BAA'.
			'Cxjwv8YQUAAABOUExURZwMDN7n93ut1kKExjFjnHul1tbn75S93jFrnP///1qUxnOl1sbe71KMxjFrpWOUzjl7tYy13q3G5+fv95y93muczu/3'.
			'9zl7vff3//f//9Se9dEAAAABdFJOUwBA5thmAAAAs0lEQVR42iWPUZLDIAxDRZFNTMCllJD0/hddktWPRp6x5QcQmyIA1qG1GuBUIArwjSRITk'.
			'iylXNxHjtweqfRFHJ86MIBrBuW0nIIo96+H/SSAb5Zm14KnZTm7cQVc1XSMTjr7IdAVPm+G5GS6YZHaUv6M132RBF1PopTXiuPYplcmxzWk2C7'.
			'2CfZTNaU09GCM3TWw9porieUwZt9yP6tHm5K5L2Uun6xsuf/WoTXwo7yQPwBXo8H/8TEoKYAAAAASUVO'.
			'RK5CYII=',
		'author.png' => 'iVBORw0KGgoAAAANSUhEUgAAABQAAAAUCAMAAAC6V+0/AAAAA3NCSVQICAjb4U/gAAAAV1BMVEUAAAD39/fV1dWkpKR8fHxFRUUiIiLFxcXm5uaTk5NmZmb///+0tLQUFBSFhYUqKirv7+/e3t5SUlLMzMwzMzOtra2ZmZmNjY26urpKSkpsbGwVFRU5OTlN919eAAAACXBIWXMAAAsSAAALEgHS3X78AAAAHHRFWHRTb2Z0d2FyZQBBZG9iZSBGaXJld29ya3MgQ1MzmNZGAwAAABh0RVh0Q3JlYXRpb24gVGltZQAyOS0wNi0yMDA4Ae2H3gAAAMNJREFUGJVd0O2ugzAIBmBe7FocZw7sdGZn93+dQ7sPY3+0yRP6QiDdH3H3Ikpq5hN/EEAtgQKnazNYXAuvqKD8rlxxat8tX2sFnDl+Y0agQsQSFXMuo5hEPq1R0JkY0SdjS9nQMVOKivpuSFu+1S6lP1vSDlVd9ZEVukN+jqrn7LpDY5tGHv7p0n2Rb0kLFYBPwxdF+jTdIRE7/1B7inncMNJp8IawpbbB+idR9xupLQkq93rEWBL7AaMlKo6osan1eQEylhBMH47LdwAAAABJRU5ErkJggg=='
			/*'iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAgY0hSTQAAeiYAAICEAAD6AA'.
			'AAgOgAAHUwAADqYAAAOpgAABdwnLpRPAAAABh0RVh0U29mdHdhcmUAUGFpbnQuTkVUIHYzLjIyt5EXfQAAAilJREFUOE+dkttqU2EQhSfZXoTc'.
			'+wg+Rx7DIgGxlDaIYhEj2lYbij3g8UJsA96IB9CkHsCi0pqYpNqcbM1BQzBYKaZppbGNjdXUm+WaxJ00YhH8YbFnz17zMfPPtuRr+yCyLP9ztr'.
			'FXJFezI/FdcGtRMLrQkMazVUGceVPq+VMvqgbk7Q87Xn0TDM8LzBMpDeLOktTzOzWn7wSbueebBKS2bAh9FQwlW4DQ8iDG84KxNw1pfL/IDlgc'.
			'pdQfpp5WrJBk1YaZDYEn0QJoJ+/W/aj+LNWl8YMPTlxMWTG/KYhRWvOwTMBcxYbHZcFAvB3QnGdHECx6cDVrRW5LECDg7goB4XUbJlcEp6L/Bi'.
			'jrXsGJRxwn+EVwo0jAzJoNtz8J3C/bAek1H8azDkxQ6bKv2Uem7MeljODJZ4H3IwE3lwycywl6QoLKdqlpPL/gwECKo1Eam0c9rrDg8nvB6ZQF'.
			'cn3RwJm0oCtAQK0FGHvtwEluRqVxE0BPV1Bwll30xgnwFgz08efpITWx6m8a46s+jCQcGEk6oLF51KPePq73SJSAa3kD/QQc5yVOZJx/u/y2nH'.
			'rUqzWuCAFXcgbcXOEQid0BKyYLnl0h+k096tWazgABF7IGDs9yViaGeWEuGrzpTsRKfmxwXpXGmtNv6lGv1hycJmA0ZaCbG1D1cpXumOBoRHBo'.
			'WrB/qiGNNXeCrR+jp+7nPRx4RkB/zE6Tpa6O30/zfben6euY2oNfh7u45PDiyLMAAAAASUVORK5CYII%3D'*/
	); // $resources = array
	if(array_key_exists($_GET['gdg_resource'],$gdg_resources)) {
		$content = base64_decode($gdg_resources[ $_GET['gdg_resource'] ]);
		$lastMod = filemtime(__FILE__);
		$client = ( isset($_SERVER['HTTP_IF_MODIFIED_SINCE']) ? $_SERVER['HTTP_IF_MODIFIED_SINCE'] : false );
		// Checking if the client is validating his cache and if it is current.
		if (isset($client) && (strtotime($client) == $lastMod)) {
			// Client's cache IS current, so we just respond '304 Not Modified'.
			header('Last-Modified: '.gmdate('D, d M Y H:i:s', $lastMod).' GMT', true, 304);
			exit;
		} else {
			// Image not cached or cache outdated, we respond '200 OK' and output the image.
			header('Last-Modified: '.gmdate('D, d M Y H:i:s', $lastMod).' GMT', true, 200);
			header('Content-Length: '.strlen($content));
			header('Content-Type: image/' . substr(strrchr($_GET['resource'], '.'), 1) );
			echo $content;
			exit;
		}	
	}
}
?>
