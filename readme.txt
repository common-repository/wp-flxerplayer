=== wp-flxerPlayer ===
Contributors: gianlucadelgobbo
Donate link: http://www.flxer.net/software/donate.php
Tags: flash, post, video, gallery, videogallery, media, player, swf, flv, mp4, mp3, h264, swfobject, playlist, manager
Requires at least: 2.0
Tested up to: 2.5.1
Stable tag: 1

A plugin to embed the FLxER player to play swf, flv, mp4, mp3, h264, jpg, txt, gif, png content in valid XHTML code offering the possibility to manage playlists!
 
== Description == 

**wp-flxerPlayer** is a filter for WordPress to display **any flash content** in **valid XHTML 1.0 Strict**.

This development start basing the php code on the pb-embedFlash of pasber http://pascal-berkhahn.de.

With *admin panel* and **media & playlist manager**!

**See the Installation tab for more information about the usage.**

*- wp-flxerPlayer is optimized for WordPress 2.5. 

This plugin comes with currently 2 ways of displaying your flash content:

* `<object>` tag
* SWFObject (JavaScript)

**wp-flxerPlayer** primarily supports, but is not limited to...

* .swf
* .flv, .mp4, .mp3, .png, .jpg, .gif and .xml playlist
* YouTube
* Google Video
* Revver
* SevenLoad
* Vimeo
* GUBA
* ClipFish
* MetaCafe
* MyVideo
* Veoh
* ifilm
* MySpace Videos
* Brightcove
* aniBOOM
* vSocial
* GameVideos
* VideoTube
* AOL UnCut
* grouper

Unfortunately, Blip.tv, Garage TV, Break.com, dailymotion and Yahoo! do not put the videoID into the browser URL; therefore you have grab the path to the video file from the embedding-HTML-code they offer.  

If your favorite video hoster is not listed as supported by this plugin, *you still can use it* by copying the link to the video out of the embedding code. Please give me a note if a video hoster is missing or not fully supported, thanks.   

== Installation ==
= Installation =

1. Unpack the zip archive.
2. Upload the folder `wp-flxerPlayer` to *wp-content/plugins/*.
3. Activate the plugin in your admin panel.

= Update =

wp-flxerPlayerwp-flxerPlayer supports the automatic update function integrated in WordPress since version 2.5. To do it by your own, follow this:

1. Deactivate the plugin. This is important!
2. Delete the old files and folders.
3. Install the new version.

= Usage =

To embed flash files into your posts, please insert the URL into following code: `[flash URL VALUES]`. URL is the full address with heading http://. Possible VALUES are listed beneath.

**If you want to embed movies from YouTube, Google Video, etc., simply post the full address of the item's site.**  
Example: `[flash http://www.youtube.com/watch?v=SOME_CHARACTERS]` or `[flash http://video.google.com/videoplay?docid=SOME_NUMBERS]`.  
Width and height are set to the respective settings of the supported hoster automatically.  
**You don't need to cut sth. out of an address or HTML code!**

**flv/mp4 support** just use [flash URL VALUES], the flv/mp4 file is detected automatically. (You have to buy a license to use that player commercially.)  

You can also embed media (`[flash medium=ID VALUES]`) and playlists (`[flash playlist=ID VALUES]`) from the media manager.
(Attention! Each flashvar overwrites his counterpart in following order: admin panel settings < media & playlist settings < flash tag settings.)

**!!! *The following documentation of possible values is eased heavily by the admin panel popup (since v1.5)* !!!**

VALUES can be one or more of these:  

* If you want to override the default values for width and hight, use the following code: `w=WIDTH h=HEIGHT`. WIDTH and HEIGHT are in pixels as number-only without unit.  

* If you want to override the default value for the class, use the following code: `class=CLASS`. CLASS is the class to be used. If you don't specify a class, the default class "embedflash" will be taken.  

* To specify the style for the `<object>` without defining a class, use the following code: `style={STYLE}`. STYLE must be valid CSS code. Please ensure that you put it into {} brackets! 

* To manage gallerys, use the following code: `[flash FIRSTMOVIEURL title=FIRSTMOVIETITLE gallery={MOVIE1URL MOVIE1TITLE,MOVIE2URL MOVIE2TITLE,}`.

* You can also display a link to the file with a specified text: `extern={TEXT|LINK}` or `extern={TEXT}`. TEXT is the text to show as link, LINK will be the target. If no LINK is given, it defaults to URL. Please ensure that you put it into {} brackets!  
Example #1: `extern={Go to YouTube}` will output: `<a href="URL" title="Go to YouTube">Go to YouTube</a>`.  
Example #2: `extern={Visit the author's website|http://domain.com/?site=home}` will output: `<a href="http://domain.com/?site=home" title="Visit the author's website">Visit the author's website</a>`  
If you are embedding a video from a hoster supported by this plugin, you can add a "Watch it at ..." link by adding `extern=1` instead.  

* If you want to specify additional parameters to the `<object>` tag, use the following code: `o={PARAMETERS}`. PARAMETERS can be one ore mutiple valid parameters for the `<object>` tag except 'data', 'width', 'height', 'class' and 'style'. Please ensure that you put it into {} brackets!  
Example: `o={tabindex="2" name="flashmovie"}` will be outputted as: `<object ... tabindex="2" name="flashmovie" ... />`  

* If you want to specify additional `<param>` tags, use the following code: `p={NAME-1;VALUE-1|NAME-2;VALUE-2|...|NAME-N;VALUE-N}`. Both NAME and VALUE have to be specified. You can add quite infinite `<param>` tags by seperating the different couples with the "|" character. Please ensure that you put it into {} bracktes!  
Example: `p={menu;false|quality;high}` will be outputted as: `<param name="menu" value="false" /><param name="quality" value="high" />`  

* If loading preview images from YouTube and GameVideos has been disabled by default, you can still use it by adding `preview=force`. The alt attribute of the image tag is set to "preview image".
You can set the width and height by `pw=` and `ph=`.

* To easily overwrite the default mode of embedding your flash content, you can specify `mode`.
Examples: `mode=0` will use the object tag, `mode=1` refers to SWFObject.


== Screenshots ==

1. All you need is the [flash ...] tag, e.g. to add a video from YouTube...

2. ...or your own flash file or movie.

== Issues ==

No issues known yet.

== Change log ==

**1.0** (*2008-06-30*) - Initial release.