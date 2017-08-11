<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>


<div class="main-wrap single-pilot-page full-width" role="main">
	<div data-equalizer>
		<div class="pilot-image-container" data-equalizer-watch>
			<div class="pilot-image">
				<div><?php the_post_thumbnail();?></div>
			</div>
		</div>
		<?php do_action( 'foundationpress_before_content' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article data-equalizer-watch <?php post_class('pilot-header-container') ?> id="post-<?php the_ID(); ?>">
				<div class="pilot-header">
					<div class="pilot-header-content">
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<?php the_field( 'subtitle' ); ?>
						<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
					</div>
				</div>
			</article>
		</div>
		<div class="content-container">
			<?php do_action( 'foundationpress_post_before_entry_content' ); ?>
			<article class="entry-content">
				<section class="pilot-description">
					<h2>Description</h2>
					<?php the_field("description"); ?>
				</section>
				<section class="pilot-info">
					<div>
						<h2>People</h2>
						<p><?php the_field( 'people' ); ?></p>
					</div>
					<div>
						<h2>Tools used</h2>
						<p><?php the_field( 'tools_used' ); ?></p>
					</div>
					<div>
						<h2>Links and materials</h2>
						<p><?php the_field( 'links_materials' ); ?></p>
					</div>
				</section>
				<section class="pilot-reflection matched-height2">
					<h2>Reflection</h2>
					<p><?php the_field( 'reflection' ); ?></p>
				</section>
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
				<?php the_post_navigation(); ?>
				<?php do_action( 'foundationpress_post_before_comments' ); ?>
				<?php comments_template(); ?>
				<?php do_action( 'foundationpress_post_after_comments' ); ?>
			</div>
		<?php endwhile;?>

		<?php do_action( 'foundationpress_after_content' ); ?>
		<?php get_sidebar(); ?>
	</div>
	<?php get_footer();
