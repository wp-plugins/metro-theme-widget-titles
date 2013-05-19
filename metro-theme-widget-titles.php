<?php

/**
 * Plugin Name: Metro Theme Widget Titles
 * Plugin URI: http://blackhillswebworks.com
 * Description: Fixes a theme/plugin compatibility issue by removing the StudioPress Metro theme widget title filter and adding another filter that is compatible with plugins.
 * Version: 0.1
 * Author: John Sundberg
 * Author URI: http://blackhillswebworks.com
 * License: GPLv2 or later
 */

/*
	Copyright 2013 John Sundberg (email: john@blackhillswebworks.com)

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/



/**
 * Remove the Metro theme widget title filter
 *
 */

	add_action( 'genesis_before', 'remove_metro_widget_title_filter' );

	function remove_metro_widget_title_filter() {
		
		remove_filter( 'widget_title', 'metro_widget_title' );

	}
	


/**
 * Now re-add the span class to widget titles in a way that is compatible with plugins
 *
 */	

	add_filter( 'genesis_register_sidebar_defaults', 'bhww_metro_widget_titles' );

	function bhww_metro_widget_titles( $defaults ) {
		
		return 	array(
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => "</div></div>\n",
			'before_title'  => '<h4 class="widgettitle"><span class="widget-headline">', // Added span tag and class
			'after_title'   => "</span></h4>\n", // Added closing span tag
		);
		
	}