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


<div class="main-wrap page-blog" role="main">

	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('blog-article-container blog-page-header') ?> id="post-<?php the_ID(); ?>">
			<div class="blog-article">
				<div class="blog-article-content">
					<header>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					</header>
					<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
					<div class="entry-content">
						<?php the_content(); ?>
						<?php edit_post_link( __( '(Edit)', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>
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
					<div class="blog-article-image">
						<?php the_post_thumbnail(); ?>
					</div>
				</div>
			</article>
		<?php endwhile;?>
		<?php 
		$args = array( 'category_name' => 'blog,news,awards' );
		$posts = get_posts($args);

		foreach ($posts as $post) : setup_postdata($post);
		?>
		<div class="blog-article-container">

			<div class="blog-article">
				<div class="blog-article-content">
					<span class="the-author"><?php the_author(); ?></span>
					<a href="<?php echo get_permalink(); ?>"><h3><?php the_title(); ?></h2></a>
					<p><?php
						// If the writer has specified a "More" tag, show the content, otherwise use the (custom made) excerpt.
						if( strpos( $post->post_content, '<!--more-->' ) ) {
							the_content("Read more...");
						}
						else {
							the_excerpt();
						}?>
					</p>
				</div>
				<div class="blog-article-image">
					<?php the_post_thumbnail(); ?>
				</div>
			</div>

		</div>

	<?php endforeach; 
	wp_reset_postdata();
	?>


	<?php do_action( 'foundationpress_after_content' ); ?>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
