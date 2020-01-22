<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

if (!class_exists('GF_Autocomplete_Address_Settings')) {

    class GF_Autocomplete_Address_Settings {

        public function __construct() {
            add_action('admin_menu', array($this, 'gfac_autocomplete_settings_page'));
        }

        public function gfac_autocomplete_settings_page() {
            add_submenu_page('gf_edit_forms', __('GF Autocomplete Settings', 'gf-autocomplete-address'), __('GF Autocomplete Settings', 'gf-autocomplete-address'), 'manage_options', 'autocomplete-settings', array($this, 'gfac_autocomplete_settings_custom_menu'));
            add_action('admin_init', array($this, 'gfac_autocomplete_group_settings'));
        }

        public function gfac_autocomplete_group_settings() {
            register_setting('gfac-autocomplete-settings', 'gfac_api_key');
        }

        public function gfac_autocomplete_settings_custom_menu() {
            ?>
            <div class="wrap">
                <h2> <?php _e('Gravity Forms Address Autocomplete Settings', 'gf-autocomplete-address'); ?></h2>

                <form method="post" action="options.php" class="autocomplete-settings" id='autocomplete-form'>
                    <?php settings_fields('gfac-autocomplete-settings'); ?>
                    <?php do_settings_sections('gfac-autocomplete-settings'); ?>                    
                    <div class="line">
                        <table class='form-table'>
                            <tbody>
                                <tr valign='top'>
                                    <th scope='row'><?PHP _e('Google API Key', 'obj-autocomplete-address') ?></th>
                                    <td><input type='text' name='gfac_api_key' value="<?php echo get_option("gfac_api_key"); ?>" style="width:50%;"/></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <?php
                    submit_button();
                    ?>

                </form>
            </div>
            <?php
        }

    }

}