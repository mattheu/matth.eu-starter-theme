<?php

/**
 *
 *	Plugins to be loaded by the theme. (can't be disabled)
 *
 */
require_once( 'plugins/better_excerpt.php' );

/**
 *
 *	Set up theme.
 *
 */
add_action( 'after_setup_theme', 'mtf_setup' );
function mtf_setup() {

	add_theme_support( 'post-formats', array( 'image', 'link', 'gallery', 'status', 'quote' ) );
	add_theme_support( 'post-thumbnails' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	
}

/**
 *	Scripts.
 *
 *	Use jQuery hosted by google. 
 *
 */
if ( !is_admin() ) { 
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' );
	wp_enqueue_script( 'jquery' );
}

register_nav_menus(
	array(
	  'mtf_menu_main' => 'Main Menu',
	  'mtf_menu_foot' => 'Footer Menu'
	)
);

register_sidebar( array(
	'name' => __( 'Main Sidebar Top', 'mtf_secondary_top' ),
	'id' => 'mtf_secondary_top',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h1 class="widget-title">',
	'after_title' => '</h1>',
) );
register_sidebar( array(
	'name' => __( 'Main Sidebar Bottom', 'mtf_secondary_bottom' ),
	'id' => 'mtf_secondary_bottom',
	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	'after_widget' => "</aside>",
	'before_title' => '<h1 class="widget-title">',
	'after_title' => '</h1>',
) );

if ( ! function_exists( 'mtf_comment' ) ) :
function mtf_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
			<div class="comment_info">
				<div class="comment_author vcard">
					<?php 
						defined( 'MTF_AVATAR_DEFAULT' ) ?  $default_avatar = MTF_AVATAR_DEFAULT : $default_avatar = false; 
						echo get_avatar( $comment, 60, $default_avatar ); 
					?>
					<?php printf( __( '%s <span class="says">says:</span>' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment_author .vcard -->
			</div><!-- .comment_info -->

		<div class="comment_body">
		
		<div class="comment_meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php /* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), ' ' );
			
				 if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.' ); ?></em>
				<?php endif; ?>
			</div><!-- .comment-meta .commentmetadata -->
		
			<?php comment_text(); ?>

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->

		
		</div>

	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;	


function mtf_coment_form_fields($fields) {
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $fields['author'] = '<p class="comment-form-author">' . '<label for="author">' . __( 'Name' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' . 
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    $fields['email']  = '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ' ' . ( $req ? '<span class="required">*</span>' : '' ) . '</label>' . 
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    $fields['url']    = '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label>' .
                '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>';
    return $fields; 
}
add_filter('comment_form_default_fields','mtf_coment_form_fields' );

function mtf_coment_form_modifications( $defaults ) {
    $defaults['comment_notes_after'] = ' ';
    return $defaults; 
}
add_filter( 'comment_form_defaults', 'mtf_coment_form_modifications' );

function mtf_get_theme_setting( $setting ) {
	
	switch( $setting ) {		

		case( 'dynamic_sidebar_before' ) :
			if( defined( 'MTF_DYNAMIC_SIDEBAR_BEFORE' ) )
				$r = MTF_DYNAMIC_SIDEBAR_BEFORE;
			break;
		
		case( 'dynamic_sidebar_after' ) :			
			if( defined( 'MTF_DYNAMIC_SIDEBAR_AFTER' ) )
				$r = MTF_DYNAMIC_SIDEBAR_AFTER;
			break;

			
	}
	
	
	if( !isset( $r ) )
		return;
			
	return $r; 
		
	
}

