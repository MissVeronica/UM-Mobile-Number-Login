<?php

add_filter( 'um_view_field_value_text', 'my_custom_view_field_value', 10, 2 );

function my_custom_view_field_value( $res, $data ) {
	
	if( $data['metakey'] == 'phone_number' || $data['metakey'] == 'mobile_number' ) {
        if( !empty( $res )) {
            $res = '<a href="tel:' . str_replace( array( '(', ')', '.', '-', ' ' ), '', $res ) . '">' . $res . '</a>';
        }
	}
	return $res;
}
