<?php

/**
 * Plugin Name: Gravity Forms Address Autocomplete 
 * Description: Gravity Forms Address Autocomplete is a WordPress addon that allow customers to enable google places address autocomplete on two text fields types (Address or Single Line Text) by using its name.
 * Plugin URI: https://codecanyon.net/item/gravity-forms-address-google-autocomplete/21957132	
 * Author: wpexperts.io
 * Author URI: https://wpexperts.io
 * Text Domain: gf-autocomplete-address
 * Version:           1.5
 * License:           GPL3
 * License URI:       https://www.gnu.org/licenses/gpl.html
 */
if (!defined('ABSPATH')) {
    exit;
}


/**
 * check for gravity forms plugin
 */
add_action('wp_loaded', 'square_plugin_dependencies');

function square_plugin_dependencies() {
    if (!class_exists('GF_Field')) {
        add_action('admin_notices', 'gfac_admin_notices');
    } else {
        define('GF_AUTOCOMPLETE_ADDRESS_URL', plugin_dir_url(__FILE__));
        define('GF_AUTOCOMPLETE_ADDRESS_PATH', plugin_dir_path(__FILE__));

        /**
         * GF class
         */
        require_once( GF_AUTOCOMPLETE_ADDRESS_PATH . 'inc/class-gf-autocomplete.php' );
        new GF_Autocomplete_Address();

        /**
         * Settings
         */
        require_once( GF_AUTOCOMPLETE_ADDRESS_PATH . 'inc/class-gf-autocomplete-settings.php' );
        new GF_Autocomplete_Address_Settings();
    }
}

function gfac_admin_notices() {
    $class = 'notice notice-error';
    $message = __('GF address autocomplete requires Gravity Forms to be installed and active.', 'gf-autocomplete-address');
    printf('<div class="%1$s"><p>%2$s</p></div>', $class, $message);
}
