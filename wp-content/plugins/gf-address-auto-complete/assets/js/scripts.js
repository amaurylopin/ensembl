jQuery(document).ready(function () {
        initAutocomplete();
    jQuery(document).bind('gform_post_render', function () {
        initAutocomplete();
    });
});

function initAutocomplete() {
    
    var componentForm = {
        route: 'long_name',
        street_number: 'short_name',
        sublocality_level_1: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'long_name',
        country: 'long_name',
        postal_code: 'short_name'
    };


    jQuery('.gfac_autocomplete_addr').each( function () {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        //check if address filed
        var addr = jQuery(this);
        if(addr.find('div.ginput_container_address').length>0)
            var v = addr.find('div.ginput_container_address').attr('id');
        else
            var v = addr.find('input').attr('id');
        
        if (jQuery('div#' + v).length > 0 && jQuery('input#' + v+ '_1').length>0) {
            var autocomplete = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */(document.getElementById(v + '_1')),
                    {types: ['geocode']});
            if(jQuery('div#'+v).closest('li[class*="gfac_autocomplete_country_"]').length>0){
            // Set initial restrict to the greater list of countries.
                var clslist = jQuery('div#'+v).closest('li[class*="gfac_autocomplete_country"]')[0].className;
                var country = clslist.substring(clslist.lastIndexOf("gfac_autocomplete_country_")+26,clslist.lastIndexOf("gfac_autocomplete_country_")+28);
                autocomplete.setComponentRestrictions(
                    {'country': [country]});
            }
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
                var address1 = '';
                for (var i = 0; i < place.address_components.length; i++) {

                    var addressType = place.address_components[i].types[0];
                    if (componentForm[addressType]) {
                        var val = place.address_components[i][componentForm[addressType]];

                        //address line 1                        
                        if (addressType == 'street_number') {
                            address1 = val;
                        }

                        if (addressType == 'route') {
                            address1 = address1 + ' ' + val;
                        }

                        jQuery('#' + v + '_1').val(address1);

                        //address line 2
                        if (addressType == 'sublocality_level_1') {
                            jQuery('#' + v + ' .address_line_2 input[type="text"]').val(val);
                        }

                        //city
                        if (addressType == 'locality') {
                            jQuery('#' + v + ' .address_city input[type="text"]').val(val);
                        }

                        //state
                        if (addressType == 'administrative_area_level_1') {
                            jQuery('#' + v + ' .address_state input[type="text"]').val(val);
                            //us state
                            jQuery('#' + v + ' .address_state select').val(val);
                        }

                        //postal code
                        if (addressType == 'postal_code') {
                            jQuery('#' + v + ' .address_zip input[type="text"]').val(val);
                        }

                        //country
                        if (addressType == 'country') {
                            jQuery('#' + v + ' .address_country select').val(val);
                        }
                    }
                }
            });
        } else if(jQuery('input#'+v).length>0) {
            //text field
            var autocomplete = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */(document.getElementById(v)),
                    {types: ['geocode']});
            if(jQuery('input#'+v).closest('li[class*="gfac_autocomplete_country_"]').length>0){
            // Set initial restrict to the greater list of countries.
                var clslist = jQuery('input#'+v).closest('li[class*="gfac_autocomplete_country"]')[0].className;
                var country = clslist.substring(clslist.lastIndexOf("gfac_autocomplete_country_")+26,clslist.lastIndexOf("gfac_autocomplete_country_")+28);
                autocomplete.setComponentRestrictions(
                    {'country': [country]});
            }
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                if(jQuery('input#'+v).closest('li[class*="gfac_autocomplete_addr_format"]').length>0){
                    jQuery('#' + v).val(place.formatted_address);
                }
				var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }
				console.log(address);
            });
        }
    });
}