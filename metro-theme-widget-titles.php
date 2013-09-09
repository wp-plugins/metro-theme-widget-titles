<?php

/**
 * Plugin Name: Metro Theme Widget Titles
 * Plugin URI: http://blackhillswebworks.com
 * Description: Fixes a theme/plugin compatibility issue by removing the StudioPress Metro theme widget title filter and adding another filter that is compatible with plugins. Version 0.2 restores the 'old' Metro look to Metro Pro widget titles, comments title and comments reply title.
 * Version: 0.2
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
 * @since 0.1
 */

	add_action( 'genesis_before', 'remove_metro_widget_title_filter' );

	function remove_metro_widget_title_filter() {
		
		remove_filter( 'widget_title', 'metro_widget_title' );

	}



/**
 * Now re-add the span class to widget titles in a way that is compatible with plugins
 *
 * @since 0.1
 */	

	add_filter( 'genesis_register_sidebar_defaults', 'bhww_metro_widget_titles' );

	function bhww_metro_widget_titles( $defaults ) {
		
		return 	array(
			'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-wrap">',
			'after_widget'  => "</div></div>\n",
			'before_title'  => '<h4 class="widgettitle widget-title"><span class="widget-headline">', // Added span tag and class
			'after_title'   => "</span></h4>\n", // Added closing span tag
		);
		
	}


	
/**
 * Check to see if Metro (original, not Pro) is installed AND that HTML5 is enabled. 
 * If so, restore the comment reply title to the original Metro theme look.
 *
 * @since 0.2
 */	
	
	add_action( 'genesis_init', 'bhww_check_for_metro_theme' );
	
	function bhww_check_for_metro_theme() {
		
		$theme = wp_get_theme( 'metro' );
		
		if ( $theme->exists() ) {

			add_action( 'genesis_before', 'bhww_metro_filter_genesis_html5_reply_title' );

			function bhww_metro_filter_genesis_html5_reply_title() {
			
				// If this is not inside a function called with an action, things break!
				if ( genesis_html5() ) {
				
					// This filter is found in wp-includes/comment-template.php (at line 1641 in version 3.6)
					add_filter( 'comment_form_defaults', 'bhww_metro_title_reply_filter' );
					
					function bhww_metro_title_reply_filter ($arg) {
					
						$arg['title_reply'] = '<span class="comments-title">' . __( 'Leave a Reply' ) . '</span>';
						return $arg;
					
					}
					
				}
				
			}
				
		}
		
	}
	


/**
 * Check to see if Metro Pro is installed, and if it is, restore the widget titles,
 * comments title, and comment reply title to the original Metro theme look
 *
 * @since 0.2
 */	
	
	add_action( 'genesis_init', 'bhww_check_for_metro_pro_theme' );
	
	function bhww_check_for_metro_pro_theme() {
		
		$theme = wp_get_theme( 'metro-pro' );
		
		if ( $theme->exists() ) {
				
			/**
			 * Add the 'comments header text in comments' filter that was removed in Metro Pro
			 *
			 * @since 0.2
			 */
				
				add_filter( 'genesis_title_comments', 'bhww_metro_pro_title_comments' );
				
				function bhww_metro_pro_title_comments() {
				
					$title = '<h3><span class="comments-title">' . __( 'Comments', 'metro' ) . '</span></h3>';
					return $title;
					
				}
				
				

			/**
			 * Add a span class to the 'Leave a Reply' text
			 *
			 * @since 0.2
			 */

				add_action( 'genesis_before', 'bhww_metro_pro_filter_genesis_html5_reply_title' );

				function bhww_metro_pro_filter_genesis_html5_reply_title() {
					
					// This filter is found in wp-includes/comment-template.php (at line 1641 in version 3.6)
					add_filter( 'comment_form_defaults', 'bhww_metro_pro_title_reply_filter' );
					
					function bhww_metro_pro_title_reply_filter ($arg) {
					
						$arg['title_reply'] = '<span class="comments-title">' . __( 'Leave a Reply' ) . '</span>';
						return $arg;
					
					}
					
				}



			/**
			 * Register and enqueue the plugin stylesheet
			 *
			 * @since 0.2
			 */
			 
				add_action( 'wp_enqueue_scripts', 'bhww_metro_pro_widget_titles_styles' );
				
				function bhww_metro_pro_widget_titles_styles() {
					
					wp_register_style( 'bhww-mtwt', plugins_url( 'css/metro-theme-widget-titles-style.css', __FILE__ ), array(), '20130907a' );
					wp_enqueue_style( 'bhww-mtwt' );
					
				}
				
		}
		
	}