<?php
	/*
	Plugin Name: MobiSwitch
	Plugin URI: http://www.joeybdesign.co.uk/mobiswitch-mobile-device-theme/
	Description: This plugin will allow you to specify a different theme for mobile users. It will automatically detect mobile users and load a mobile theme chosen by you in the administration area.
	Author: J. Biesta
	Version: 1.1
	Author URI: http://www.joeybdesign.co.uk
	*/
	/*  Copyright 2013  Jo Biesta  (email : jo@joeybdesign.co.uk)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Mobile settings page
function mobiswitch_settings() {
	include('mobiswitch_settings.php');
}

function mobiswitch_admin_actions() {
	add_menu_page("Mobiswitch", "Mobiswitch", 1, "Mobiswitch", "mobiswitch_settings");
}

add_action('admin_menu', 'mobiswitch_admin_actions');

// Build filters for template and stylesheet

function template_filter() {
	$mobiswitch_mobile_theme = get_option('mobiswitch_mobile_theme');
	$mobiswitch_theme_data = wp_get_theme($mobiswitch_mobile_theme);
	//return $mobiswitch_theme_data->Template;
	return get_option('mobiswitch_mobile_theme');
}
function stylesheet_filter() {
	$mobiswitch_mobile_theme = get_option('mobiswitch_mobile_theme');
	$mobiswitch_theme_data = wp_get_theme($mobiswitch_mobile_theme);
	//return $mobiswitch_theme_data->Template;
	return get_option('mobiswitch_mobile_theme');
}

// Mobile Detection
function mobiswitch_mobile_detect() {
	if(session_id() == '') {// if no session is started start a session
		session_start();
	}
		if (isset($_GET['mobiswitch'])) { //if mobiswitch is set then set it to a session
		$_SESSION['mobiswitch'] = $_GET['mobiswitch'];
		}
			if (!isset($_SESSION['mobiswitch'])) {//if mobiswitch isnt set then continue to switch theme
			include ('mobiswitch_mobile_detect.php');
			$mobiswitch_detect = new Mobile_Detect();
				if($mobiswitch_detect->isMobile() && !is_admin()) { //if mobile is detected
					add_filter( 'template', 'template_filter' );
 					add_filter( 'stylesheet', 'stylesheet_filter' );
		}
	}
	else {
		}
}
	
add_action('setup_theme', 'mobiswitch_mobile_detect');

// View desktop site
function mobiswitch_view_desktop() {
	$mobiswitch_desktop_link = get_option('mobiswitch_desktop_footer');
	if ($mobiswitch_desktop_link != 1) { // if the setting to show in desktop isnt ticked do nothing
	} else {
		include ('mobiswitch_mobile_detect.php');
		$mobiswitch_detect = new Mobile_Detect();
			if($mobiswitch_detect->isMobile() && !is_admin() && (!isset($_SESSION['mobiswitch']))) { //if we're mobile, not admin & desktop hasnt been set
                echo '<center><a href="?mobiswitch=deskop">View Desktop Site</a></center>'; 
			}
	}
}

add_action('wp_footer', 'mobiswitch_view_desktop');

///Translations
function mobiswitch_translations() {
	load_plugin_textdomain( 'mobiswitch', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
}
add_action('plugins_loaded', 'mobiswitch_translations');
?>