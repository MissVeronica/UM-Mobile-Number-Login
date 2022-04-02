<?php
add_filter( "um_mobile_number_form_edit_field", "um_mobile_number_form_edit_field_tel", 10, 2 );
add_filter( "um_phone_number_form_edit_field", "um_mobile_number_form_edit_field_tel", 10, 2 );
    
    function um_mobile_number_form_edit_field_tel( $output, $set_mode ) {
        
        if( $set_mode == 'register' || $set_mode == 'profile' ) {
            $output = str_replace( 'type="text"', 'dir="ltr" type="tel"', $output );
        }
        return $output;
    }
