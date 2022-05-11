<?php
/**
 * Plugin Name:       Menu Fetcher
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Fetch the Food Menus From RMS Magic Office LTD
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.0
 * Author:            Erfan Ahmed Siam
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Domain Path:       /languages
 */


function menu_fetcher_activate(){
    
 }

register_activation_hook( __FILE__, 'menu_fetcher_activate' );

add_action( 'admin_menu', 'my_admin_menu' );

function menu_fetcher_page() {
    require plugin_dir_path( __FILE__ ) . 'menu-fetcher-admin.php';
}

function my_admin_menu() {
	add_menu_page( 'Menu Fetcher', 'Menu Fetcher', 'manage_options', 'menu-fetcher', 'menu_fetcher_page', 'dashicons-menu', 6 );
}