<?php
//if uninstall isnt called exit here
//if(!defined(WP_UNINSTALL_PLUGIN) exit();

if (
	!defined( 'WP_UNINSTALL_PLUGIN' )
||
	!WP_UNINSTALL_PLUGIN
||
	dirname( WP_UNINSTALL_PLUGIN ) != dirname( plugin_basename( __FILE__ ) )
) {
	status_header( 404 );
	exit;
}

//start deleting all sored options
delete_option('mobiswitch_mobile_theme');
delete_option('mobiswitch_desktop_footer');
?>

