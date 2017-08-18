<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-wrap guide-page full-width" role="main">
	<div data-equalizer>
		
		<section class="right-header-container" data-equalizer-watch>
			<div class="right-header">
				<div class="right-header-content">
					<?php the_post_thumbnail(); ?>
				</div>

			</div>
		</section>
		<div class="guide-description-container left-header-container" data-equalizer-watch>
			<?php do_action( 'foundationpress_before_content' ); ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article <?php post_class('guide-description-content left-header') ?> id="post-<?php the_ID(); ?>">
					
					<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
					<div class="entry-content left-header-content">
						<header>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						</header>
						<?php the_content(); ?>
						<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
					<footer>
						<?php
						wp_link_pages(
							array(
								'before' => '<nav id="page-nav"><p>' . __( 'Pages:', 'foundationpress' ),
								'after'  => '</p></nav>',
								)
							);
							?>
							<p><?php the_tags(); ?></p>
						</footer>
						<?php do_action( 'foundationpress_page_before_comments' ); ?>
						<?php comments_template(); ?>
						<?php do_action( 'foundationpress_page_after_comments' ); ?>

					</article>
				</div>
			<?php endwhile;?>
		</div>

		<?php do_action( 'foundationpress_after_content' ); ?>
		<?php get_sidebar(); ?>

		<div class="about-opit-container">
			<div class="about-opit">
				<div class="about-opit-content">
					<h3>About Aalto Learning IT</h3>
					<p>	
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam rhoncus, felis eget semper feugiat, tellus dui tincidunt felis, ut posuere ipsum augue vel est. Nulla quis risus et purus lacinia lobortis. Ut malesuada libero quis magna convallis, eget dapibus metus mattis. Fusce convallis eros porta, ultricies quam eget, vehicula nisi. Fusce scelerisque tristique metus quis eleifend. Cras non ante a metus accumsan feugiat. Nulla sed est in nisi pellentesque posuere vel sed enim. Maecenas porttitor mattis est vitae faucibus. Nulla elementum maximus tincidunt. Aliquam placerat iaculis scelerisque. Nam et eros nec sapien luctus sagittis vel eget nisi. Ut a condimentum neque, vitae pellentesque sapien. Aenean finibus libero sed felis pharetra, at feugiat magna dapibus. Aliquam varius tortor ac ligula interdum imperdiet.


					</p>
				</div>
				<div class="about-opit-quote quote">

					<?php 

					// Select a random quote from the quotes associated with this theme group to be shown.
					//$theme_quote = $theme_groups[$idx]["quotes"][array_rand($theme_groups[$idx]["quotes"])];

					//$custom_fields = get_fields($theme_quote->ID);

					?>
					<div class="theme-quote-content quote-content">
						<div class="theme-quote-underline quote-underline"></div>
						<div class="quote-text"><?php echo "Onhan tässä aika hyvä olla Learning IT:N huostassa hei."; ?></div>

						<div class="quote-author-name"><?php echo "Jaakko Virtanen"; ?></div>
						<div class="quote-author-info"><?php echo "D. Sc, Aalto University"; ?></div>

					</div>
					

				</div>
			</div>
		</div>

	</div>

	<?php get_footer();
