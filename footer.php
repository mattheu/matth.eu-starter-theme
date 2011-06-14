<footer>
	<p>Basic wordpress theme framework by <a href="http://matth.eu">matth.eu</a> &mdash; 
	&copy; <?php echo date('Y', time() ); ?>
	<?php if( is_user_logged_in() ) { ?>
			<a href="#" id="show_grid">Grid</a> | 
			<a href="http://validator.w3.org/check?uri=referer" title="HTML/CSS">Valid HTML5?</a>
	<?php } ?>
	</p>
</footer>
</div>

<?php wp_footer(); ?>
<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php bloginfo('template_directory'); ?>/js/libs/jquery-1.4.2.js"%3E%3C/script%3E'))</script>

<script src="<?php bloginfo('stylesheet_directory'); ?>/js/plugins.js"></script>
<script src="<?php bloginfo('stylesheet_directory'); ?>/js/script.js"></script>
</body>
</html>