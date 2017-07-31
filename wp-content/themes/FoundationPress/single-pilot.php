<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>


<div class="main-wrap single-pilot-page full-width" role="main">

	<div class="pilot-image-container">
		<div class="pilot-image matched-height">
			<div><?php the_post_thumbnail();?></div>
		</div>
	</div>
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('main-content pilot-description-container matched-height') ?> id="post-<?php the_ID(); ?>">
			<header class="pilot-description">
				<?php foundationpress_entry_meta(); ?>
				<div class="pilot-description-content">
					<h1 class="entry-title"><?php the_title(); ?></h1>
					<h2>Description</h2>
					<?php echo CFS()->get( 'description' ); ?>
				</div>
			</header>
		</article>

		<div class="content-container">

			<?php do_action( 'foundationpress_post_before_entry_content' ); ?>

			<div class="entry-content">

				<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
				<section class="pilot-info matched-height2">
					<div class="">
						<h2>People</h2>
						<p><?php echo CFS()->get( 'people' ); ?></p>
					</div>
					<div class="">
						<h2>Tools used</h2>
						<p><?php echo CFS()->get( 'tools_used' ); ?></p>
					</div>
					<div class="">
						<h2>Links and materials</h2>
						<p><?php echo CFS()->get( 'links_materials' ); ?></p>
					</div>
				</section>
				<section class="pilot-reflection matched-height2">
					<h2>Reflection</h2>
					<p><?php echo CFS()->get( 'reflection' ); ?></p>
				</section>

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
