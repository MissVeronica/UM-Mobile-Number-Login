<?php



remove_action( 'um_submit_form_errors_hook_login', 'um_submit_form_errors_hook_login', 10 );
add_action( 'um_submit_form_errors_hook_login', 'my_um_submit_form_errors_hook_login', 10, 1 );
add_action( 'um_custom_field_validation_unique_mobile_number', 'um_custom_validate_unique_mobile_number', 30, 3 );

function my_um_submit_form_errors_hook_login( $args ) {

    // Replace mobile_number with your site's mobile or phone number meta key field to use for User identification
    $meta_key_mobile = 'mobile_number'; 
    $is_email = false;

    $form_id = $args['form_id'];
    $mode = $args['mode'];
    $user_password = $args['user_password'];

    if ( isset( $args['username'] ) && $args['username'] == '' ) {
        UM()->form()->add_error( 'username', __( 'Please enter your mobile number, username or email', 'ultimate-member' ) );
    }

    if ( isset( $args['user_login'] ) && $args['user_login'] == '' ) {
        UM()->form()->add_error( 'user_login', __( 'Please enter your username', 'ultimate-member' ) );
    }

    if ( isset( $args['user_email'] ) && $args['user_email'] == '' ) {
        UM()->form()->add_error( 'user_email', __( 'Please enter your email', 'ultimate-member' ) );
    }

    if ( isset( $args[$meta_key_mobile] ) && $args[$meta_key_mobile] == '' ) {
        UM()->form()->add_error( $meta_key_mobile, __( 'Please enter your mobile number', 'ultimate-member' ) );
    }


    if ( isset( $args['username'] ) ) {
        $authenticate = $args['username'];
        $field = 'username';

        if ( UM()->validation()->is_phone_number( $args['username'] ) ) {
            $meta_args  = array(
                'meta_key'     => $meta_key_mobile,
                'meta_value'   => $args['username'],
                'meta_compare' => '=' );
    
            $user_query = new WP_User_Query( $meta_args );
            $user_mobile = $user_query->get_results();
    
            if( !empty( $user_mobile )) {
                if( count( $user_mobile ) == 1 ) {
                    $user_mobile = $user_mobile[0];
                    $field = $meta_key_mobile;
                    $user_name = $user_mobile->user_login;
                    $authenticate = $user_mobile->user_login;
    
                } else {
                    UM()->form()->add_error( $meta_key_mobile, __( 'There are more than one user registered with this mobile number', 'ultimate-member' ) );
                }
    
            } else {
                UM()->form()->add_error( $meta_key_mobile, __( 'Mobile number not found', 'ultimate-member' ) );
            }
        }
        
        elseif ( is_email( $args['username'] ) ) {
            $is_email = true;
            $data = get_user_by('email', $args['username'] );
            $user_name = isset( $data->user_login ) ? $data->user_login : null;
        } else {
            $user_name  = $args['username'];
        }

    } elseif ( isset( $args['user_email'] ) ) {
        $authenticate = $args['user_email'];
        $field = 'user_email';
        $is_email = true;
        $data = get_user_by('email', $args['user_email'] );
        $user_name = isset( $data->user_login ) ? $data->user_login : null;

    } elseif ( isset( $args[$meta_key_mobile] ) ) {
        if ( UM()->validation()->is_phone_number( $args[$meta_key_mobile] ) ) {
            $meta_args  = array(
                'meta_key'     => $meta_key_mobile,
                'meta_value'   => $args[$meta_key_mobile],
                'meta_compare' => '=' );

            $user_query = new WP_User_Query( $meta_args );
            $user_mobile = $user_query->get_results();

            if( !empty( $user_mobile )) {
                if( count( $user_mobile ) == 1 ) {
                    $user_mobile = $user_mobile[0];
                    $field = $meta_key_mobile;
                    $user_name = $user_mobile->user_login;
                    $authenticate = $user_mobile->user_login;

                } else {
                    UM()->form()->add_error( $meta_key_mobile, __( 'There are more than one user registered with this mobile number', 'ultimate-member' ) );
                }

            } else {
                UM()->form()->add_error( $meta_key_mobile, __( 'Mobile number not found', 'ultimate-member' ) );
            }
        } else {
            UM()->form()->add_error( $meta_key_mobile, __( 'Invalid mobile number', 'ultimate-member' ) );
        }

    } else {
        $field = 'user_login';
        $user_name = $args['user_login'];
        $authenticate = $args['user_login'];
    }

	if ( $args['user_password'] == '' ) {
		UM()->form()->add_error( 'user_password', __( 'Please enter your password', 'ultimate-member' ) );
	}
    
	$user = get_user_by( 'login', $user_name );
	if ( $user && wp_check_password( $args['user_password'], $user->data->user_pass, $user->ID ) ) {
		UM()->login()->auth_id = username_exists( $user_name );
	} else {
        UM()->form()->add_error( 'user_password', __( 'Password is incorrect. Please try again.', 'ultimate-member' ) );
	}

	// @since 4.18 replacement for 'wp_login_failed' action hook
	// see WP function wp_authenticate()
	$ignore_codes = array( 'empty_username', 'empty_password' );

	$user = apply_filters( 'authenticate', null, $authenticate, $args['user_password'] );
	if ( is_wp_error( $user ) && ! in_array( $user->get_error_code(), $ignore_codes ) ) {
		UM()->form()->add_error( $user->get_error_code(), __( 'Password is incorrect. Please try again.', 'ultimate-member' ) );
	}

	$user = apply_filters( 'wp_authenticate_user', $user, $args['user_password'] );
	if ( is_wp_error( $user ) && ! in_array( $user->get_error_code(), $ignore_codes ) ) {
		UM()->form()->add_error( $user->get_error_code(), __( 'Password is incorrect. Please try again.', 'ultimate-member' ) );
	}

	// if there is an error notify wp
	if ( UM()->form()->has_error( $field ) || UM()->form()->has_error( $args['user_password'] ) || UM()->form()->count_errors() > 0 ) {
		do_action( 'wp_login_failed', $user_name, UM()->form()->get_wp_error() );
	}
}

function um_custom_validate_unique_mobile_number( $key, $array, $args ) {

    if ( isset( $args[$key] )) {
            
        if ( ! UM()->validation()->is_phone_number( $args[$key] ) ) {
            UM()->form()->add_error( $key, __( 'Please enter a valid phone number', 'ultimate-member' ) );
        }

        $meta_args  = array(
            'meta_key'     => $key,
            'meta_value'   => $args[$key],
            'meta_compare' => '=' );

        $user_query = new WP_User_Query( $meta_args );
        $user_mobile = $user_query->get_results();

        if( !empty( $user_mobile )) {

            UM()->form()->add_error( $key, __( 'There is a user registered with this mobile number', 'ultimate-member' ) );
        }    
    }
}

