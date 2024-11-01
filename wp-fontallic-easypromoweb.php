<?php 
/*
	Plugin Name: WP Fontallic
	Plugin URI: https://wordpress.org/plugins/wp-fontallic-easypromoweb/
	Description: Plugin for 2122 icons with all fonts,  Icons can be inserted using either HTML or a shortcode. <a href="Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8F8NY9RU2LR4L&source=url" target="_blank">Donate for us !</a> 
	Author: Dan Ichim
	Requires at least: 3.0.1
	Version: 1.2
	Tested up to: 5.2.3
	Requires PHP: 5.2.4
	Stable tag: 1.2
	Tags: font awesome, wp fontallic, shortcode font awesome, fontallic, Fontelico, Entypo, Meteocons, MFG Labs, Web Symbols, Brandico, Zocial, admin, editor, visual editor, icon, icons, icon font, icon fonts, fonts, font awesome, fontawesome, icon font shortcode
	Author URI: https://linktr.ee/danichimc
	Contributors: danichimc
	License: GPLv2 or later
	License URI: http://www.gnu.org/licenses/gpl-2.0.html
	
	Font All 2122 Icons and more in the visual editor with filter-search and rich content editing at your fingertips
	* your requested feature!! or any icon font set your little heart desires - Rate this plugin (favourably would be prefferable) and let me know what features / fonts you'd like to see included.
   
	License:

	Copyright (C) 2014 by Dan Ichim

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

	//--Credits--//
	## Linecons
	   Copyright (C) 2013 by Designmodo
	   Author:    Designmodo for Smashing Magazine
	   License:   CC BY ()
	   Homepage:  http://designmodo.com/linecons-free/
	## Typicons
	   (c) Stephen Hutchings 2012
	   Author:    Stephen Hutchings
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  http://typicons.com/
	## Fontelico
	   Copyright (C) 2012 by Fontello project
	   Author:    Crowdsourced, for Fontello project
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  http://fontello.com
	## Entypo
	   Copyright (C) 2012 by Daniel Bruce
	   Author:    Daniel Bruce
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  http://www.entypo.com
	## Iconic
	   Copyright (C) 2012 by P.J. Onori
	   Author:    P.J. Onori
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  http://somerandomdude.com/work/iconic/
	## Modern Pictograms
	   Copyright (c) 2012 by John Caserta. All rights reserved.
	   Author:    John Caserta
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  http://thedesignoffice.org/project/modern-pictograms/
	## Meteocons
	   Copyright (C) 2012 by Alessio Atzeni
	   Author:    Alessio Atzeni
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  http://www.alessioatzeni.com
	## MFG Labs
	   Copyright (C) 2012 by Daniel Bruce
	   Author:    MFG Labs
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  http://www.mfglabs.com/
	## Maki
	   Copyright (C) Mapbox, LCC
	   Author:    Mapbox
	   License:   BSD (https://github.com/mapbox/maki/blob/gh-pages/LICENSE.txt)
	   Homepage:  http://mapbox.com/maki/
	## Zocial
	   Copyright (C) 2012 by Sam Collins
	   Author:    Sam Collins
	   License:   MIT (http://opensource.org/licenses/mit-license.php)
	   Homepage:  http://zocial.smcllns.com/
	## Brandico
	   (C) 2012 by Vitaly Puzrin
	   Author:    Crowdsourced, for Fontello project
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  
	## Elusive
	   Copyright (C) 2013 by Aristeides Stathopoulos
	   Author:    Aristeides Stathopoulos
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  http://aristeides.com/
	## Web Symbols
	   Copyright (c) 2011 by Just Be Nice studio. All rights reserved.
	   Author:    Just Be Nice studio
	   License:   SIL (http://scripts.sil.org/OFL)
	   Homepage:  http://www.justbenicestudio.com/

*/

// Include Options
include( 'epw-options.php' );


// remove wp version param from any enqueued scripts
function vc_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
function vc_remove_wp_rev_css_js( $src ) {
    if ( strpos( $src, 'rev=' ) )
        $src = remove_query_arg( 'rev', $src );
    return $src;
}
add_filter( 'style_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_ver_css_js', 9999 );
add_filter( 'style_loader_src', 'vc_remove_wp_rev_css_js', 9999 );
add_filter( 'script_loader_src', 'vc_remove_wp_rev_css_js', 9999 );
// hide the meta tag generator from head and rss
function disable_version() {
   return '';
}
add_filter('the_generator','disable_version');
remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'rsd_link' ); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); // Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); // Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' ); // Display the XHTML generator that is generated on the wp_head hook, WP version


//Adding Shortcodes
function addscFontallic($atts) {
    extract(shortcode_atts(array(
    'type'  => '',
    'size' => '',
    'rotate' => '',
    'flip' => '',
    'pull' => '',
    'animated' => '',
    'class' => '',
	'color' => '',
  
    ), $atts));
 
    $classes  = ($type) ? 'easypromoweb-icon-'.$type. '' : 'recycle';
    $classes .= ($size) ? ' fa-'.$size.'' : '';
    $classes .= ($rotate) ? ' fa-rotate-'.$rotate.'' : '';
    $classes .= ($flip) ? ' fa-flip-'.$flip.'' : '';
    $classes .= ($pull) ? ' pull-'.$pull.'' : '';
    $classes .= ($animated) ? ' animate-spin' : '';
    $classes .= ($class) ? ' '.$class : '';
    $colors = ($color) ? ' '.$color : '';
 
    $theiconFontallic = '<i class="'.esc_html($classes).'" style="color:'.esc_html($colors).'"></i>';
      
    return $theiconFontallic;
}
  
add_shortcode('iconepw', 'addscFontallic');

function addscFontAwesome($atts) {
    extract(shortcode_atts(array(
    'type'  => '',
    'size' => '',
    'rotate' => '',
    'flip' => '',
    'pull' => '',
    'animated' => '',
    'class' => '',
	'color' => '',
  
    ), $atts));
 
    $classes  = ($type) ? 'fa-'.$type. '' : 'fa-star';
    $classes .= ($size) ? ' fa-'.$size.'' : '';
    $classes .= ($rotate) ? ' fa-rotate-'.$rotate.'' : '';
    $classes .= ($flip) ? ' fa-flip-'.$flip.'' : '';
    $classes .= ($pull) ? ' pull-'.$pull.'' : '';
    $classes .= ($animated) ? ' fa-spin' : '';
    $classes .= ($class) ? ' '.$class : '';
	$colors = ($color) ? ' '.$color : '';
 
    $theAwesomeFont = '<i class="fa '.esc_html($classes).'" style="color:'.esc_html($colors).'"></i>';
      
    return $theAwesomeFont;
}
  
add_shortcode('iconfa', 'addscFontAwesome');


function epw_return_font() {
	$opfont = get_option( 'font_select' );
	if ( isset($opfont) && !empty($opfont) ) {
		return $opfont;
	} else {
		return 'fontallic';
	}
}

/* Load Icon CSS
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_set_css() {
	return plugins_url('/css/epw-'.epw_return_font().'.css', __FILE__ );
}

/* Load Icon List
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_include_icon_list() {
	include 'iconlists/epw-'.epw_return_font().'.php';
}

/* Register and Enqueue Admin Scripts and Styles
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_editor_scripts() {
	// admin scripts
	wp_register_script('chosen', plugins_url('/js/chosen.js',__FILE__) );
	wp_register_script('epw-admin-js', plugins_url('/js/'.epw_return_font().'-admin.js',__FILE__) );
	wp_enqueue_script('chosen');
	wp_enqueue_script('epw-admin-js');

	// admin style
	wp_register_style('epw-admin-css', plugins_url('/css/epw-admin-style.css', __FILE__ ) );
	wp_enqueue_style('epw-admin-css');

	// Font CSS
	wp_register_style('epw-font-css', epw_set_css() );
	wp_enqueue_style('epw-font-css');
}

/* Add Icon CSS to the Editor
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_plugin_mce_css( $mce_css ) {
	if ( ! empty( $mce_css ) ) {
		$mce_css .= ',';
	}

	$mce_css .= epw_set_css();
	return $mce_css;
}

/* Add Icon Select Drop Down above editor
- - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_add_icon_select() {
	$icons = epw_icon_list();
    echo '<a id="ico-trig" class="button dashicons-before dashicons-dashboard">Find Icons</a><span class="ico-wrap"><select id="icon_select"><option>Search icon</option>';
    	foreach($icons as $icon) {
    		echo '<option>'.$icon.'</option>';
    	}
    echo '</select><a id="ico-close" class="button">X</a></span>';
}

/* Additional editor buttons
  - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_add_more_buttons($buttons) {
	$buttons[] = 'fontsizeselect';
	$buttons[] = 'forecolorpicker';
	return $buttons;
}

/* Add a custom selection
  - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_text_sizes($initArray){
	$initArray['theme_advanced_font_sizes'] = "10px,12px,14px,16px,18px,20px,22px,24px,30px,36px,48px,54px,61px,72px,84px,96px";
	return $initArray;
}

/* Add Actions for plugin backend
  - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_admin() {
	add_action('edit_form_after_title', 'epw_icon_list', 10 );
	add_action('edit_form_after_title', 'epw_editor_scripts', 11);
	add_action('media_buttons','epw_add_icon_select',12);
	add_filter('mce_css', 'epw_plugin_mce_css' );
	add_filter("mce_buttons_3", "epw_add_more_buttons");
	add_filter('tiny_mce_before_init', 'epw_text_sizes');
	add_filter('widget_text', 'do_shortcode');
}


/* Register and Enqueue Icons on the front End
  - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_icon_frontend_styles() {
	wp_register_style('fontallic-style', epw_set_css() );
	wp_enqueue_style('fontallic-style');
	
	//cond IE 7
	global $is_IE;
		if($is_IE ) {
			wp_register_style( 'easypromoweb-icon-ie7', plugins_url('/css/easypromoweb-icon-ie7.css', __FILE__ ) );
			$GLOBALS['wp_styles']->add_data( 'easypromoweb-icon-ie7', 'conditional', 'lte IE 7' );
			wp_enqueue_style( 'easypromoweb-icon-ie7' );
		}
}

/* Run Actions
  - - - - - - - - - - - - - - - - - - - - - - - - - */
add_action('admin_head', 'epw_include_icon_list');
add_action('admin_head', 'epw_admin');
add_action( 'wp_enqueue_scripts', 'epw_icon_frontend_styles' );


/* add a settings link to the plugin management page
  - - - - - - - - - - - - - - - - - - - - - - - - - */
function epw_plugin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=epw_plugin_options">Dashboard</a>';
    array_push( $links, $settings_link );
    return $links;
}

$plugin = plugin_basename( __FILE__ );

add_filter( "plugin_action_links_$plugin", 'epw_plugin_add_settings_link' );
