<?php
/**
 * @package SS Link Hover Effect
 * @version 3.0.3
 */
/*
* Plugin Name:        SS Link Hover Effect
* Plugin URI:         http://sobshomoy.com/plugins/ss-link-hover
* Description:        This plugin will use  wp page and post inside links hover effects. Very nice mouse hover effect for your post inside link. Easy to install and use. Support major theme and major wp versions.
* Version:            3.0.2
* Requires at least:  4.0
* Requires PHP:       7.2
* Tested up to:       5.5.0
* Author:             Shiful Islam
* Author URI:         http://bn.hs-bd.com
* License:            GPL v2 or later
* License URI:        https://www.gnu.org/licenses/gpl-2.0.html
*/

//fix up path
define('ss_link_hover_path', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );


//Register customizer in below file and set it to wp_footer
function sslhe_customizer_register($wp_customize){
	$wp_customize->add_panel( 'sslhe_settings', array(
			  'priority'       => 200,
			  'capability'     => 'edit_theme_options',
			  'theme_supports' => '',
			  'title'          => __('SSLHE Options', 'sslhe'),
			  'description'    => __('SSLHE all settings are here', 'sslhe'),));
			  
	 //Color Palettes settings==================><================	
	//Color selections	
	$wp_customize->add_section('sslhe_color_palette', array(
		 'title' => __('Color Changes', 'sslhe'),
		 'description' => 'Change colors , you can put all the colors following your color palettes.',
		 'panel'  => 'sslhe_settings',	));	
	
	//links color background	'transport'           => 'refresh',
	$wp_customize->add_setting('links-color-bg', array('default' => '#303F9F', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color', ));	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'links-color-bg', array('label' => __('Change background color', 'sslhe'),
		 'section' => 'sslhe_color_palette', 'settings' => 'links-color-bg', )));
		 
	//links text color	'transport'           => 'refresh',
	$wp_customize->add_setting('links-color-text', array('default' => '#000000', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color', ));	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'links-color-text', array('label' => __('Change text color', 'sslhe'),
		 'section' => 'sslhe_color_palette', 'settings' => 'links-color-text', )));	
    
    //links text hover color	'transport'           => 'refresh',
	$wp_customize->add_setting('links-color-text-hover', array('default' => '#ffffff', 'transport' => 'refresh', 'sanitize_callback' => 'sanitize_hex_color', ));	
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'links-color-text-hover', array('label' => __('Change text hover color', 'sslhe'),
		 'section' => 'sslhe_color_palette', 'settings' => 'links-color-text-hover', )));	
}// customizer ends

function sslhe_css_customizer(){ ?>
<style type="text/css"> 

.post.status-publish p  a{
/*linear-gradient for hover background*/
background:-webkit-gradient(linear,left top,left bottom,from(<?php echo get_theme_mod('links-color-bg', '#303F9F');?>),color-stop(<?php echo get_theme_mod('links-color-bg', '#303F9F');?>),0));
background:-webkit-linear-gradient(<?php echo get_theme_mod('links-color-bg', '#303F9F');?>, <?php echo get_theme_mod('links-color-bg', '#303F9F');?>) no-repeat scroll center bottom / 100% 2px rgba(0, 0, 0, 0) !important;
background:   -moz-linear-gradient(<?php echo get_theme_mod('links-color-bg', '#303F9F');?>, <?php echo get_theme_mod('links-color-bg', '#303F9F');?>) no-repeat scroll center bottom / 100% 2px rgba(0, 0, 0, 0) !important;
background:     -o-linear-gradient(<?php echo get_theme_mod('links-color-bg', '#303F9F');?>, <?php echo get_theme_mod('links-color-bg', '#303F9F');?>) no-repeat scroll center bottom / 100% 2px rgba(0, 0, 0, 0) !important;
background:        linear-gradient(<?php echo get_theme_mod('links-color-bg', '#303F9F');?>, <?php echo get_theme_mod('links-color-bg', '#303F9F');?>) no-repeat scroll center bottom / 100% 2px rgba(0, 0, 0, 0) !important;
text-decoration:none !important;
border:none !important;
color:<?php echo get_theme_mod('links-color-text', '#000000');?>!important;
padding:3px !important;
/*transition*/
-webkit-transition:background-size 0.2s ease 0s, color 0.1s ease 0.1s !important;
   -moz-transition:background-size 0.2s ease 0s, color 0.1s ease 0.1s !important;
     -o-transition:background-size 0.2s ease 0s, color 0.1s ease 0.1s !important;
        transition:background-size 0.2s ease 0s, color 0.1s ease 0.1s !important;
}


.post.status-publish p  a:hover{
/*background-size*/
-webkit-background-size:100% 100% !important;
   -moz-background-size:100% 100% !important;
     -o-background-size:100% 100% !important;
        background-size:100% 100% !important;
color:<?php echo get_theme_mod('links-color-text-hover', '#FFFFFF');?> !important;
}

.post.status-publish a img, .post.status-publish a:hover img{background:none !important;}

</style>		
<?php }
add_action( 'wp_head', 'sslhe_css_customizer'); 
add_action( 'customize_register', 'sslhe_customizer_register' );
?>