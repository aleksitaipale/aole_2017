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

<?php get_template_part( 'template-parts/featured-image' ); ?>

<div class="main-wrap full-width jobs-page" role="main">

	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<div data-equalizer>
			<article data-equalizer-watch <?php post_class('jobs-description-container left-header-container') ?> id="post-<?php the_ID(); ?>">
				<div class="jobs-description left-header">
					<div class="jobs-description-content left-header-content">
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
							<?php the_post_thumbnail(); ?>
						</div>
					</div>
				</div>
			<?php endwhile;?>

			<?php do_action( 'foundationpress_after_content' ); ?>
			<?php get_sidebar(); ?>

		</div>

		<?php get_footer();