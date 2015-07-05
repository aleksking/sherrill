<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package ZeroGravity
 */
?>
	</div><!-- #main .wrapper -->
	<footer id="colophon" role="contentinfo">
		<div class="site-info">
			<div class="credits credits-left"><?php echo wp_kses_post(get_theme_mod('zerogravity_footer_text_left', __('Copyright 2015', 'zerogravity'))); ?></div>
			<div class="credits credits-center"><?php echo wp_kses_post(get_theme_mod('zerogravity_footer_text_center', __('Footer text center', 'zerogravity'))); ?></div>
			<div class="credits credits-right">
			<a href="<?php echo ZEROGRAVITY_AUTHOR_URI; ?>/wordpress-themes/zerogravity">ZeroGravity</a> <?php _e('by', 'zerogravity'); ?> GalussoThemes.com<br />
			<?php _e('Powered by', 'zerogravity'); ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'zerogravity' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'zerogravity' ); ?>"> WordPress</a>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php
	if (get_theme_mod('zerogravity_boton_ir_arriba', 1) == 1){ ?>
		<a href='#inicio_pagina' title='<?php echo __('Back to top', 'zerogravity'); ?>'><div class="ir-arriba"><i class="fa fa-chevron-up"></i></div></a>
	<?php } 
	
wp_footer(); ?>

</body>
</html>