<?php
$methods = mtf_get_user_contact_methods();

if ( empty( $methods ) ) {
	return;
}

?>

<ul class="contact-methods">

	<?php foreach ( $methods as $method ) : ?>

		<li class="contact-method-type-<?php echo esc_attr( $method['slug'] ); ?>">
			<b class="contact-method-name"><?php echo esc_html( $method['name'] ) ?>:</b>

			<?php if ( $method['link'] ) : ?>

			<a class="contact-method-value" rel="me" href="<?php echo esc_url( $method['link'] ); ?>">
				<?php echo esc_html( $method['value'] ); ?>
			</a>

			<?php else : ?>

			<span class="contact-method-value">
				<?php echo esc_html( $method['value'] ); ?>
			</span>

			<?php endif; ?>


		</li>

	<?php endforeach; ?>

</ul>
