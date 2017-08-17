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
			<div class="footer-links-container">
				<div class="aole-some">
					<p><b>Aalto Online Learning</b> in social media</p>
					<?php 
					$aole_some = get_field("aole_social_media_links", "option");

					if ($aole_some):
						?>

					<?php if ($aole_some["facebook"]): ?>
						<a href="<?php echo $aole_some["facebook"]; ?>"><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a>
					<?php endif;?>

					<?php if ($aole_some["twitter"]): ?>
						<a href="<?php echo $aole_some["twitter"]; ?>"><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a>
					<?php endif;?>

					<?php if ($aole_some["instagram"]): ?>
						<a href="<?php echo $aole_some["instagram"]; ?>"><i class="fa fa-instagram-square fa-3x" aria-hidden="true"></i></a>
					<?php endif;?>

				<?php endif; ?>
			</div>
			
			<div class="aalto-some">
				<p><b>Aalto University</b> in social media</p>
				<?php 
				$aalto_some = get_field("aalto_social_media_links", "option");

				if ($aalto_some):
					?>

				<?php if ($aalto_some["facebook"]): ?>
					<a href="<?php echo $aalto_some["facebook"]; ?>"><i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i></a>
				<?php endif;?>

				<?php if ($aalto_some["twitter"]): ?>
					<a href="<?php echo $aalto_some["twitter"]; ?>"><i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a>
				<?php endif;?>

						<?php if ($aalto_some["youtube"]): ?>
					<a href="<?php echo $aalto_some["youtube"]; ?>"><i class="fa fa-youtube-square fa-3x" aria-hidden="true"></i></a>
				<?php endif;?>

				<?php if ($aalto_some["instagram"]): ?>
					<a href="<?php echo $aalto_some["instagram"]; ?>"><i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
				<?php endif;?>

			<?php endif; ?>
		</div>

	</div>

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
