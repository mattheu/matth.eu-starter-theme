<?php

/**
 *	Some more relevant contact methods.
 */
function mtf_filter_user_contactmethods( $contactmethods ) {

    // Add Contact Methods
    $contactmethods['twitter']     = 'Twitter';
    $contactmethods['facebook']    = 'Facebook';
    $contactmethods['google_plus'] = 'Google+';
    $contactmethods['skype']       = 'Skype';

    // Remove Contact Methods
    unset( $contactmethods['aim'] );
    unset( $contactmethods['yim'] );

    return $contactmethods;

}
add_filter( 'user_contactmethods','mtf_filter_user_contactmethods', 10, 1 );

/**
 * Get User contact method data.
 *
 * @return array user contact method data.
 */
function mtf_get_user_contact_methods() {

	$methods = array();

	foreach ( _wp_get_user_contactmethods() as $method => $name ) {

		if ( $value = get_the_author_meta( $method, $user_id ) ) {

			$method = array(
				'slug'  => $method,
				'name'  => $name,
				'value' => $value,
				'link'  => apply_filters( 'mtf_contact_method_link', null, $method, $value ),
			);

			if ( ! $method['link'] ) {

				if ( 'google_plus' == $method ) {
					$method['link'] = 'http://profiles.google.com/' . $contact_method;
				} elseif ( 'twitter' == $method ) {
					$method['link'] = 'http://twitter.com/' . $contact_method;
				} elseif ( 'facebook' == $method ) {
					$method['link'] = 'http://facebook.com/' . $contact_method;
				}

			}

			array_push( $methods, $method );
		}

	}

	return apply_filters( 'mtf_contact_methods', $methods );

}
