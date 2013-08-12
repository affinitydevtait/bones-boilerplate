
Development Standards Boilerplate
=================
Built around the HTML5 Boilerplate, the Affinity New Media is a rock to start from. Keep what you need, remove what you don't. It's totally up to you.
**The whole idea around this Boilerplate is to be consistent and tidy with development** and to have a framework style theme to start any new project with. So keep your code clean & tidy and place code into the correct areas of the boilerplate, see below for documentation.
 It's meant to be used as a per-project template, this means no Child Themes. Taking the Mobile-First approach is the way to go when building a responsive project. 
So our boilerplate comes ready to roll with a unique LESS/Sass setup that serves minimal resources to smaller screens and scales up depending on your viewport. 
As anyone who's ever browsed on a 3G connection will tell you, it's a difference maker.

***Starting Your Project***

Depending on how to manage your development process, an ideal process would be as follows:

- **Build Stage**
	- Create all your HTML and CSS. As The boilerplate is based on the HTML 5 Boilerplate make sure that you use all HTML 5 elemnts and standards throughout your project.
	  For a reference you could use http://html5doctor.com

	- Also the Boilerplate uses LESS / SASS, we default to LESS, so all your default LESS styling should only ever go in the _1030up.less the desktop only version of the website.

	- There are a number of LESS elements you can use to achieve the styling you desire, so keep to using them so no duplicate code is used.

	- Make all your build files html files only (no using PHP include and guff) as this will just make TECH more difficult.

- **Tech Stage**
	- Configure the boilerplate before you start first with the config.php
		- Add all database details
		- Enable and disable on required constants
		- All new functions should be commented and documented in the following fashion
/**
* @function get_taxonomy_class( $var )
* @param type $var
* @staticvar $term 
*		@uses get_queried_object()
*		@see http://codex.wordpress.org/Function_Reference/get_queried_object
* @return string
*/

***Affinity New Media Bones Boilerplate Updates*** 

/* v3.01 update */
- Wordpress CMS 3.6 package
- Included Plugins (Remove when not required)
	- Advanced Custom Fields
	- ACF Gallery
	- ACF Options
	- ACF Repeater
	- Affinity New Media Admin ( Will be integrated into the boilerplate in v4.0)
	- Gravity Forms
	- Regenerate Thumbnails
	- YOST Wordpress SEO
	- WP Members ( include custom functions in functions directory )
	- WP Super Cache ( No caching will be available in v4.0 as a use of a CDN will be available )
- New Packaged functions and structure
	- Debugging
		- ?debug=sql
		- ?debug=phpinfo //displays only PHP Information
		- ?debug=http
		- ?debug=cache
		- ?debug=cron
		- dump()
		- add_stop()
		- dump_stops()
		- init_dump()
		- dump_http()
		- dump_trace()
		- print_a()
		- performance()
	- Boilerplate Functions
		- get_taxonomy_class()
		- get_thumbnail_caption()
		- get_current_url()
		- get_current_term_ID()
		- the_post_thumbnail_caption()
		- int_to_str()
		- the_date_from_string()
		- get_shorter_excerpt()
		- the_shorter_excerpt()
		- trim_text()
		- current_url() //Deprecated with get_current_url() but still available
		- limit_characters()
- Added new LESS elements and removed elements from _mixins.less
 * - .gradient()
 * - .bw-gradient()
 * - .bordered()
 * - .drop-shadow()
 * - .rounded()
 * - .border-radius()
 * - .opacity()
 * - .transition-duration()
 * - .transform()
 * - .rotation()
 * - .scale()
 * - .transition()
 * - .inner-shadow()
 * - .box-shadow()
 * - .box-sizing()
 * - .user-select()
 * - .columns()
 * - .translate()
 * - .background-clip()
 * - .transparent()
 * - .desaturate()
 * - .saturate()

What is Bones
=================

Bones is a Lightweight Wordpress Development Theme

_______________________________________________________________
HEADS UP!!!
Bones & Bones (Responsive Edition) have been merged.
_______________________________________________________________

Bones is designed to make the life of developers easier. It's built
using HTML5 & has a strong semantic foundation. It was updated recently
using some of the HTML5 Boilerplate's recommended markup and setup.
It's constantly growing so be sure to check back often if you are a
frequent user. I'm always open to contribution. :)

Designed by Eddie Machado
http://themble.com/bones

License: WTFPL
License URI: http://sam.zoy.org/wtfpl/
Are You Serious? Yes.

Special Thanks to:
Paul Irish & the HTML5 Boilerplate
Yoast for some WP functions & optimization ideas
Andrew Rogers for code optimization
David Dellanave for speed & code optimization
and several other developers. :)

Submit Bugs & or Fixes:
https://github.com/eddiemachado/bones/issues

To view Release & Update Notes, read the log.txt file inside
the library folder.

******************************************************************/

/* v1.25 update */
- updated custom post type page for translation
- added => to responsive jquery
- cleaned up theme tags (which make NO sense, but are best practice, go figure)
- updated html element to match hb5
- fixed echo problem on admin.php
- updated normalize (LESS also had some missing styles so I added them)
- GetComputedStyle fix for IE (for responsive js)
- cleaned up mixins (border radius)
- added translations! (Chinese, Spanish)

/* v1.2 HUGE update */
- merge responsive version with classic
- remove post title from read more link (it's way too long)
- removed readme.txt (it was pointless)
- organized info for each file called in on the functions page
- added custom gravatar call in comments
- i'm leaving jQuery to a plugin (that way I'm not providing dated jQuery)
- added translation folder
- put everything inside stuff so it's easier to be translated
- added an identifier in each 404 area so you know what template is showing
- remove custom walker. I think that's better left for you guys to do
- fixed some spelling errors
- added some translation options in the comments file
- added role=navigation to footer links
- deleted image.php (who really uses that anyway)
- added sidebar to search.php
- added class to custom post type title
- added link to custom meta box
- removed selectivizr
- updated html elements with new classes for IE
- added new mobile meta tags
- removed pinned site meta tag for IE9
- merged base.css into style.css for one less call in the header
- added styleguide page and styles (oh yea!)
- added nav class to both menus
- removed "Powered by Wordpress & Bones" from footer, because let's face it: we all delete this anyway.
- added button class to submit comment button
- removed html5 placeholder fallback (you should be using Gravity Forms)
- added slug and rewrite to custom post type for easier urls
- renamed the border radius mixins so they were easer to remember
- removed duplicate box shadow mixin
- deleted the plugins.php file
- facebook og:meta can be better handled by a plugin (or Yoast's SEO plugin)
- rel=me can also be handled by SEO plugin or another plugin
- removed author.php (you can use archive.php or add it yourself)

