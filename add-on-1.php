<?php
add_filter( "um_mobile_number_form_edit_field", "um_mobile_number_form_edit_field_tel", 10, 2 );
add_filter( "um_phone_number_form_edit_field", "um_mobile_number_form_edit_field_tel", 10, 2 );

add_filter( "um_mobile_number_form_show_field", "um_mobile_number_form_edit_field_tel", 10, 2 );
add_filter( "um_phone_number_form_show_field", "um_mobile_number_form_edit_field_tel", 10, 2 );
    
    function um_mobile_number_form_edit_field_tel( $output, $set_mode ) {

        if( $set_mode == 'register' || $set_mode == 'profile' ) {
            $output = str_replace( 'type="text"', 'dir="ltr" type="tel"', $output );
            $output = str_replace( 'um-field-type_text" ', 'um-field-type_text" dir="ltr" ', $output );
        }
        return $output;
    }
