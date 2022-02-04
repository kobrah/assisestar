=== Plugin Name ===
Plugin Name: ADS-WP SITE COUNT Plugin
Version: 1.8
URI: http://www.ad-soft.ch/wpplugins
Tags: site counter, counter widget, hit counter, graphic counter, short code site counter
Requires at least: 3.1.0
Tested up to: 4.9
Stable tag: 1.8
PHP Version: 5.2.9
MySql Version: 5.0.91-community
Author: adespont
Donate link: http://www.ad-soft.ch/wpplugins
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display a site counter with graphic or text on widget or on blog.

== Description ==
This plugin shows a graphic visitor counter. 
Display the counter as dynamic image or text on sidebar widget or blog.
You can set many options for hit and cleanup. 
This plugin supports German and/or English language.
Not designed for multi-pages. You can try it without warranty.

Dieses Plugin zeige einen graphischen Besucher Zähler. 
Der Zähler erscheint als dynamische Bild oder als Text in Ihrer Seitenleiste oder im Blog.
Sie können diverse Optionen einstellen.
Das Plugin ist auf Deutsch und/oder Englisch verfügbar.
Nicht ausgelegt für Multiseiten. Sie können es versuchen, ohne Garantie.

== Installation ==
1. Upload Folder `ads-wp-site-count` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure the Settings for cleanup IP db entrys when you need.
4. Place Widget ADS-WpSiteCount on your sidebar (NOT the Shortcode)
5. or add [ads-wpsitecount <args, ...>] in your templates/pages/blogs, set params on <args, ...> 

== Frequently Asked Questions ==
= How can i add a shortcode into my blog page? =
You can add [ads-wpsitecount] on your text area on blog editor. use paramters to setup you counter.
for the filename look on the plugin directory ./counter to see all your counter images.

= How can i add my one counter? =
yes, you can. put the graphic file mit a fix size per digit to the ./counter folder. 
The image must have all digits from 0 to 9 and a empty digit inside. 

= What args can i put on shotcode? =
* please look inside settings on help

= How to use the placeholder? =
* please look inside settings on help
 
= How to use the statistic? =
Into dashboard you can find a little statistic for your page.
You can enable this on wordpress top right settings on dashboard
to show or hide the dashboard-widget.

== Screenshots ==
1. Main screen of WP
2. Admin panel whit settings menu
3. wpsitecount options page
4. Widget page options
5. small statistic on dashboard

== Changelog ==
= 1.8 - 2017-11-20 =
* fix delete comment

= 1.7 - 2017-11-20 =
* fix wp 4.9
* removed Tiny Button (wrong code)

= 1.6 - 2017-05-09 =
* correction: bosize/boradius 0 to 9, display width
* correction: bocolor size

= 1.5 - 2017-05-06 =
* correction: Warning DoReset

= 1.4 - 2017-04-24 =
* changed: language translation

= 1.3 - 2017-04-22 =
* changed: menu outside settings
* changed: tab settings and help
* correction tiny MCE button, disable on settings if younot need
* correction language translation

= 1.2 - 2017-04-21 =
* add: border style changeable

= 1.1 - 2017-04-21 =
* Tested with 4.7.4
* changed UTC time to local time

= 1.0.21 - 2017-02-05 =
* Tested with 4.7.2
* Optionpage correction, checkboxes

= 1.0.20 - 2017-01-25 =
* Tested with 4.7.1
* added language support for widget
* now you can put more languages on same setting, 
* eq: title => {de}Besucher{en}Visitor
* or: title => {de_DE}Besucher{en_US}Visitor
* fields with this function: title-, before-, after-widget

= 1.0.19 - 2016-12-14 =
* Tested with 4.7
* tiny button correction fill with zero, only text
* old wp functions changed to actual functions (eq: warnings)

= 1.0.17 - 2016-12-12 =
* Tested with 4.7
* Included ch-DE language

= 1.0.16 - 2016-02-23 =
* Tested with 4.4.2

= 1.0.15 - 2016-02-09 =
* Statistic dashboard widgets, arrange buttons

= 1.0.14 - 2015-10-23 =
* Statistic dashboard widgets, add period selection

= 1.0.13 - 2015-10-15 =
* Correction wrong usage on imgtojpeg (Error: NAS System cant display the picture) 

= 1.0.12 - 2015-04-16 =
* It is not clear whether the nixi background images are copy protected or not. That's why we have these removed until further notice.

= 1.0.11 - 2015-03-05 =
* Correction changed cleanup/IP min/max Value on options

= 1.0.10 - 2014-10-28 =
* Correction wrong cleanup Time on options

= 1.0.9 - 2014-09-16 =
* correction code on widget (sorry) 
* random image wrong parameter
* fail safe and double set at widget before (sorry)

= 1.0.8 - 2014-09-01 =
* remove reset cleanup time on settings after save, reset time when cleaned now.
* correction variable definition

= 1.0.7 - 2014-08-26 =
* optimized code
* removed Log database, no more needed, data will be converted
* added images max size for output and should be based on width/height. (at a small width no high resolution image is required, high-resolution images cause a longer charge time) 
* added shortcode tinyMce button, turn on/off on settings.
* !!! parameters changed on widget and settings, re-save after update and check output.

= 1.0.6 - 2014-08-19 =
* Counter Images update, many file correction unicode.

= 1.0.5 - 2014-08-16 =
* correction on function after text, missing parameter
* new placeholder %count

= 1.0.4 - 2014-08-16 =
* correction on readme text
* added startrek counter, klingon, romulan, vulcan, added counter flipping-numbers 
* placeholder for after and before text, %ip, %image, %[.%sname,%dname,%fname,%lname.]%
* language updated

= 1.0.3 - 2014-08-13 =
* added new counters

= 1.0.2 - 2014-08-09 =
* Small statistic included on dashboard widget, 
* On widget you can display random counter image on each hour/day/month.

= 1.0.1 - 2014-08-08 =
* div. corrections, only count from one displayed counte, settings correted

= 1.0.0 - 2014-07-23 = 
* Start plug-in Wp Site Count 1.0.0
* more new counters, translated en_EN

== Translations ==
* English: - default, always included
* German: Deutsch - immer mit dabei!
