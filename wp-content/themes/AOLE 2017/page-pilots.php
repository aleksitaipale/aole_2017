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

<div class="main-wrap pilots-page full-width" role="main">	

	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div data-equalizer>
			
			<div class="right-header-container" data-equalizer-watch>
				<div class="right-header">
					<div class="right-header-content">

						<?php the_post_thumbnail(); ?>
					</div>
				</div>
			</div>
			<article data-equalizer-watch <?php post_class('pilots-description-container left-header-container') ?> id="post-<?php the_ID(); ?>">
				<div class="pilots-description left-header">
					<div class="pilots-description-content left-header-content">
						<header>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						</header>
						<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
						<article class="entry-content">
							<?php the_content(); ?>
							<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
						</article>
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
						</div>
					</div>
				</article>
			<?php endwhile;?>
		</div>
		<?php

		////////////// Get theme group information for each theme group as well as pilot information for each pilot under those theme groups //////////////

		$theme_groups = get_all_theme_groups_and_pilots();

		foreach ($theme_groups as $idx=>$theme_group){
			?>
			<section class="theme-group-section">
				<div class="theme-group-box">
					
					<article class="theme-group-info">
						<h3><?php echo $theme_groups[$idx]["theme_group_info"]->name?></h3>
						<p><?php echo $theme_groups[$idx]["theme_group_info"]->description; ?></p>
					</article>

					<div class="theme-quote quote">
						<?php 

					// Select a random quote from the quotes associated with this theme group to be shown.
						$theme_quote = $theme_groups[$idx]["quotes"][array_rand($theme_groups[$idx]["quotes"])];
						

						if ($theme_quote):
							$custom_fields = get_fields($theme_quote->ID);

						?>
						<div class="theme-quote-content quote-content">
							<div class="theme-quote-underline quote-underline"></div>
							<div class="quote-text"><?php echo $custom_fields["quote"]; ?></div>
							
							<div class="quote-author-name"><?php echo $custom_fields["author"]; ?></div>
							<div class="quote-author-info"><?php echo $custom_fields["author_info"]; ?></div>

						</div>

					<?php endif; ?>
				</div>
				

				
			</div>

			<div class="pilots-listing">
				<?php 
				foreach ($theme_groups[$idx]["pilots"] as $pilot):
					?>
				<div class='pilot-listing-item'>
					
					<a href="<?php echo get_the_permalink($pilot->ID);?>">
						<img src="<?php echo get_pilot_image_url($pilot->ID, 'medium'); ?>" />
					</a>
					<h4>
						<a href="<?php echo get_the_permalink($pilot->ID); ?>">
							<?php echo $pilot->post_title; ?>
							
						</a>
					</h4>
					
				</div>
				
			<?php endforeach; ?>
		</div>

	</section>

	<?php } // this ends the theme groups foreach ?> 



</div>

<?php get_footer();
