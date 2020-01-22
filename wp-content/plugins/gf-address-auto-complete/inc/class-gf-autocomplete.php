<?php
// Exit if accessed directly
if (!defined('ABSPATH'))
    exit;

if (!class_exists('GF_Autocomplete_Address')) {

    class GF_Autocomplete_Address {

        public function __construct() {
            add_action('gform_field_standard_settings', array($this, 'gfac_filed_control'), 10, 2);
            add_action('gform_editor_js', array($this, 'gfac_autocomplete_admin_script'));
            add_filter('gform_tooltips', array($this, 'gfac_autocomplete_tooltips'));

            //add script
            add_action('gform_enqueue_scripts', array($this, 'gfac_autocomplete_script'));
            add_filter( 'gform_field_css_class', array($this,'custom_class'), 10, 3 );
        }
        public function custom_class($classes, $field, $form){
            if (($field->type == 'address' || $field->type == 'text') && $field->autocompleteGoogle) {
                $classes .=' gfac_autocomplete_addr ';
                if(($field->type == 'address' || $field->type == 'text') && !empty($field->defaultCountry)){
                   $classes .=' gfac_autocomplete_country_'. GF_Fields::get( 'address' )->get_country_code( $field->defaultCountry);
                    
                }
                
            }
            if ($field->type == 'text' && $field->autocompleteFormat) {
                $classes .=' gfac_autocomplete_addr_format ';
            }
            return $classes;
        }
        public function gfac_filed_control($position, $form_id) {
            if ($position == 50) {
                ?>
                <li class="autocomplete_setting field_setting">                    
                    <input type="checkbox" id="field_autocomplete_value" onclick="SetFieldProperty('autocompleteGoogle', this.checked);" /> <?php __('Enable', 'gf-autocomplete-address'); ?>
                    <label class="inline" for="field_autocomplete_value">
                        <?php esc_html_e('Enable Autocomplete/Suggest with Google Places API', 'gf-autocomplete-address'); ?>
                        <?php gform_tooltip('form_field_autocomplete_value') ?>
                    </label>
                </li>
				<li class="autocomplete_formatting field_setting">
					<input type="checkbox" id="field_autocomplete_format" onclick="SetFieldProperty('autocompleteFormat', this.checked);" /> <?php __('Enable', 'gf-autocomplete-address'); ?>
					<label class="inline" for="field_autocomplete_format">
                        <?php esc_html_e('Enable Autocomplete Formatted Address', 'gf-autocomplete-address'); ?>
                        <?php gform_tooltip('form_field_autocomplete_format') ?>
                    </label>
				</li>
                <?php
            }
        }

        public function gfac_autocomplete_admin_script() {
            ?>
            <script type='text/javascript'>
                //adding setting to fields of type "text"
                fieldSettings.address += ', .autocomplete_setting';
                fieldSettings.text += ', .autocomplete_setting';
				fieldSettings.text += ', .autocomplete_formatting';

                //binding to the load field settings event to initialize the checkbox
                jQuery(document).bind('gform_load_field_settings', function (event, field, form) {
                    jQuery('#field_autocomplete_value').attr('checked', field.autocompleteGoogle == true);
					jQuery('#field_autocomplete_format').attr('checked', field.autocompleteFormat == true);
                });
            </script>
            <?php
        }

        public function gfac_autocomplete_tooltips($tooltips) {
            $tooltips['form_field_autocomplete_value'] = "<h6>" . __('Autocomplete', 'gf-autocomplete-address') . "</h6>" . __('Check this box to enable autocomplete with google places API', 'gf-autocomplete-address');
			$tooltips['form_field_autocomplete_format'] = "<h6>" . __('Autocomplete Formatting', 'gf-autocomplete-address') . "</h6>" . __('Check this box to enable autocomplete address formatting note: This will strip slashes in case enable this if you want addresses formatted without slashes inside it.', 'gf-autocomplete-address');
            return $tooltips;
        }

        public function gfac_autocomplete_script($form) {
            $form_id = $form['id'];
            //check for address field
            $address_fileds_container = array();
            $country='';
            
            foreach ($form['fields'] as $field) {
                if (($field->type == 'address' || $field->type == 'text') && $field->autocompleteGoogle) {
                    $address_fileds_container[] = 'input_' . $form_id . '_' . $field->id;
                    if(($field->type == 'address' || $field->type == 'text') && !empty($field->defaultCountry)){
                       $country= GF_Fields::get( 'address' )->get_country_code( $field->defaultCountry);
                        
                    }
                    
                }
                
            }
           
            if ($address_fileds_container) {
                $api_url = "https://maps.googleapis.com/maps/api/js?libraries=places";
                $google_api_key = get_option('gfac_api_key');
                if ($google_api_key)
                    $api_url = $api_url . '&key=' . $google_api_key;

                wp_register_script('gfac-maps-googleapi', $api_url, '', '', true);
                wp_enqueue_script('gfac-autocomplete', GF_AUTOCOMPLETE_ADDRESS_URL . 'assets/js/scripts.js', array('jquery', 'gfac-maps-googleapi'), null, true);
            }
        }

    }

}