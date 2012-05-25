<?php

/**
 *	Some more relevant contact methods.
 */
function mtf_add_remove_contactmethods( $contactmethods ) {

    // Add Contact Methods
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['google_plus'] = 'Google+';
    $contactmethods['skype'] = 'Skype';
    
    // Remove Contact Methods
    unset($contactmethods['aim']);
    unset($contactmethods['yim']);

    return $contactmethods;

}
add_filter( 'user_contactmethods','mtf_add_remove_contactmethods', 10, 1 );


/**
 *	Append the user contact methods (if set) to the user description. 
 *	Added because I don't like the idea that there are default fields in the admin that do nothing in the theme.
 *
 *	Only done on the author page.
 *
 *	@todo is this too much functionality for this starter theme?
 */
function mtf_output_user_contact_methods( $description, $user_id ) {

	if( ! is_author() )
		return $description;

	foreach ( _wp_get_user_contactmethods() as $method => $name ) {
	
		if( $contact_method = get_the_author_meta( $method, $user_id ) ) {
			
			if( 'google_plus' == $method )
				$methods[] = '<li  class="contact-method-type-gplus"><b class="contact-method-name">' . $name . ':</b> <a class="class="contact-method-value" rel="me" href="http://profiles.google.com/' . $contact_method . '">' . $contact_method . '</a></li>';

			elseif( 'twitter' == $method )
				$methods[] = '<li class="contact-method-type-twitter"><b class="contact-method-name">' . $name . ':</b> <a class="class="contact-method-value" rel="me" href="http://twitter.com/' . $contact_method . '">' . $contact_method . '</a></li>';

			elseif( 'facebook' == $method )
				$methods[] = '<li class="contact-method-type-fbook"><b class="contact-method-name">' . $name . ':</b> <a class="class="contact-method-value" rel="me" href="http://facebook.com/' . $contact_method . '">' . $contact_method . '</a></li>';				
	
			else
				$methods[] = '<li><b class="contact-method-name">' . $name . ':</b> <span class="class="contact-method-value" rel="me">' . $contact_method . '</span></li>';
						
		}
	
	}
	
	if( ! empty( $methods ) )
		$description .= '<ul class="contact-methods">' . implode( "\n", $methods ) . '</ul>';
		
	return $description;

}
add_filter( 'get_the_author_description', 'mtf_output_user_contact_methods', 10, 2 );