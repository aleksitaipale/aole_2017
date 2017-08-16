<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "off-canvas-wrap" div and all content after.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

</section>
<div class="footer-container" data-sticky-footer>
	<footer class="footer">
		<div class="footer-logos">
			<img src="<?php echo get_field("aalto_logo_large_white", "option"); ?>" />
				<img src="<?php echo get_field("aole_logo_white", "option"); ?>" />
		</div>
		<div class="footer-text">
			<?php the_field("footer_text", "option"); ?>
		</div>
		<div class="footer-links">
			b
		</div>
	</footer>
</div>

<?php do_action( 'foundationpress_layout_end' ); ?>

<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
</div><!-- Close off-canvas content -->
</div><!-- Close off-canvas wrapper -->
<?php endif; ?>


<?php wp_footer(); ?>
<?php do_action( 'foundationpress_before_closing_body' ); ?>
</body>
</html>
