<?php

/*
Plugin Name: Widon't (Modified by matth.eu)
Plugin URI: http://www.shauninman.com/post/heap/2007/01/03/widont_2_1_wordpress_plugin
Description: Eliminates widows in your post titles by inserting a non-breaking space between the last two words of a title. What is a widow? In typesetting, a widow is a single word on a line by itself at the end of a paragraph and is considered bad style.
Author: Shaun Inman
Author URI: http://www.shauninman.com/
*/

function widont($str = '') {
	return preg_replace( '|([^\s])\s+([^\s]+)\s*$|', '$1&nbsp;$2', $str);
}
add_filter('the_title', 	'widont');