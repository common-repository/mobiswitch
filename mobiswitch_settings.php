<?php 
//save settings to options database
if($_POST['mobiswitch_hidden'] == 'Y') {
	$mobiswitch_mobile_theme = $_POST['mobiswitch_mobile_theme'];
	update_option('mobiswitch_mobile_theme',$mobiswitch_mobile_theme);
	
	$mobiswitch_desktop_footer = $_POST['mobiswitch_desktop_footer'];
	update_option('mobiswitch_desktop_footer',$mobiswitch_desktop_footer);
	
	if ($mobiswitch_desktop_footer == 1){
		$mobiswitch_checked = 'checked';
	}
	else
	{
		$mobiswitch_checked = '';
		}
?>
<div class="updated"><p><strong><?php _e( 'Settings Saved', 'mobiswitch' );?></strong></p></div>
<?php
}
else {
	// get options saved in database
	$mobiswitch_mobile_theme = get_option('mobiswitch_mobile_theme');
	$mobiswitch_desktop_footer = get_option('mobiswitch_desktop_footer');
	if ($mobiswitch_desktop_footer == 1){
		$mobiswitch_checked = 'checked';
	}
	else
	{
		$mobiswitch_checked = '';
		}
}

//get available themes
	foreach (wp_get_themes() as $wp_themes) {
		$available_wp_themes[] = $wp_themes->name;
}
?>
<div class="wrap">
<h2><?php _e( 'Mobiswitch Settings Page', 'mobiswitch' );?></h2>
<hr />
<br />
<b><?php _e( 'Mobile Theme Settings', 'mobiswitch' );?></b> 
<br />
<form name="mobiswitch_form" method="post" action="<?php echo str_replace( '%7e', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="mobiswitch_hidden" value="Y">
<p><?php _e( 'Mobile Theme', 'mobiswitch' );?>:
<select name="mobiswitch_mobile_theme">
<?php foreach (wp_get_themes() as $wp_theme) : ?>
<option value="<?php echo $wp_theme->Template?>" <?php selected($wp_theme->Template, $mobiswitch_mobile_theme) ?>><?php echo $wp_theme ?> </option>
<?php  endforeach ?>
</select>
</p>
<p><?php _e( 'Display "View Desktop Site" link below footer', 'mobiswitch' );?>: 
<input type="checkbox" name="mobiswitch_desktop_footer" value="1" <?php echo $mobiswitch_checked;?>></p>

<p class="submit">
	<input type="submit" name="Submit" class="button-primary" Value="<?php _e( 'Save Settings', 'mobiswitch');?>" />
	</p>
    </form>
</div>
<hr />
Mobiswitch - Mobile Theme Switcher WP Plugin by <a href="http://joeybdesign.co.uk" target="_new">Jo Biesta</a>