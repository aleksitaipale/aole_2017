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
			<article data-equalizer-watch <?php post_class('pilots-description-container left-header-container') ?> id="post-<?php the_ID(); ?>">
				<div class="pilots-description left-header">
					<div class="pilots-description-content left-header-content">
						<header>
							<h2 class="entry-title"><?php the_title(); ?></h2>
						</header>
						<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
						<div class="entry-content">
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
						</div>
					</div>
				</article>
				<div class="right-header-container" data-equalizer-watch>
					<div class="right-header">
						<div class="right-header-content">
							<<?php the_post_thumbnail(); ?>
						</div>
					</div>
				</div>
			<?php endwhile;?>
		</div>
		<?php

		////////////// Get theme group information for each theme group as well as pilot information for each pilot under those theme groups //////////////

		$theme_groups = get_all_theme_groups_and_pilots();

		foreach ($theme_groups as $idx=>$theme_group){
			?>
			<section class="theme-group-section">
				<div class="theme-group-box">
					<div class="theme-quote">
						<?php 

					// Select a random quote from the quotes associated with this theme group to be shown.
						$theme_quote = $theme_groups[$idx]["quotes"][array_rand($theme_groups[$idx]["quotes"])];
						
						$custom_fields = get_fields($theme_quote->ID);

						?>
						<span class="quote-content"><?php echo $custom_fields["quote"]; ?></span>
						<span class="quote-author-name"><?php echo $custom_fields["author"]; ?></span>
						<span class="quote-author-info"><?php echo $custom_fields["author_info"]; ?></span>
						<hr>

					</div>
					<div class="theme-group-info">
						<h2><?php echo $theme_groups[$idx]["theme_group_info"]->name?></h2>
						<p><?php echo $theme_groups[$idx]["theme_group_info"]->description; ?></p>
					</div>
					

					
				</div>

				<div class="pilots-listing">
					<?php 
					foreach ($theme_groups[$idx]["pilots"] as $pilot){
						echo "<div class='pilot-listing-item'>";
						echo "<a href='" . get_the_permalink($pilot->ID) . "'><h4>"."<img src='".get_the_post_thumbnail_url($pilot->ID, 'medium')."'></img></a>";
						echo "<a href='" . get_the_permalink($pilot->ID) . "'><h4>" . $pilot->post_title."</h4></a>";
						echo "</div>";
					} ?>
				</div>

			</section>
			<?php } // this ends the theme groups foreach ?> 



		</div>

		<?php get_footer();
