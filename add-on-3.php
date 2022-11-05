<?php

add_filter( 'um_add_user_frontend_submitted', 'um_add_user_frontend_submitted_mobile_login', 10, 1 );

function um_add_user_frontend_submitted_mobile_login( $args ) {

    if( !isset( $args['user_login'] ) || empty( $args['user_login'] )) {
        $args['user_login'] = $args['mobile_number'];
        $args['submitted']['user_login'] = $args['mobile_number'];
    }
    return $args;
}
