<footer class="site-footer">
	&copy; <?php echo date('Y', time() ); ?>
	<?php if( is_user_logged_in() && current_user_can( 'manage_options' ) ) { ?>
			| <a href="http://validator.w3.org/check?uri=referer" title="HTML/CSS">Valid HTML5?</a>
	<?php } ?>
	</p>
</footer>
</div>

<?php get_template_part( 'footer', 'foot' ); ?>