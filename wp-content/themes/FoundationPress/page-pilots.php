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

<div class="main-wrap" role="main">	

	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('main-content pilots-description') ?> id="post-<?php the_ID(); ?>">
			<header>
				<h1 class="entry-title"><?php the_title(); ?></h1>
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
			</article>
		<?php endwhile;?>
		<?php

		////////////// Get theme group information for each theme group as well as pilot information for each pilot under those theme groups //////////////

		/* Modified from https://wordpress.stackexchange.com/questions/165610/get-posts-under-custom-taxonomy/165613#165613 */
		$taxonomies = array( 
			'theme_group',
			);

		$args = array(
			'orderby'           => 'name', 
			'order'             => 'ASC',
			'hide_empty'        => true, 
			'exclude'           => array(), 
			'exclude_tree'      => array(), 
			'include'           => array(),
			'number'            => '', 
			'fields'            => 'all', 
			'slug'              => '', 
			'parent'            => '',
			'hierarchical'      => true, 
			'child_of'          => 0, 
			'get'               => '', 
			'name__like'        => '',
			'description__like' => '',
			'pad_counts'        => false, 
			'offset'            => '', 
			'search'            => '', 
			'cache_domain'      => 'core'
			); 

		$terms = get_terms( $taxonomies, $args );
		//print_r($terms);
		foreach ( $terms as $term ) {


			// here's my code for getting the posts for custom post type

			$posts_array = get_posts(
				array( 'showposts' => -1,
					'post_type' => 'pilot',
					'tax_query' => array(
						array(
							'taxonomy' => 'theme_group',
							'field' => 'term_id',
							'terms' => $term->term_id,
							)
						)
					)
				);

				?>

				<section class="theme-group-section">
					<h2><?php echo $term->name?></h2>
					<?php
		////////////// Print theme group informatio  //////////////

					foreach ( $posts_array as $pilot ){
						echo "<div class='pilot-listing-item'>";
						echo "<img src='".get_the_post_thumbnail_url($pilot->ID, 'medium')."'></img>";
						echo "<h4>".$pilot->post_title."</h4>";
						echo "</div>";

					}
					?>

					<?php do_action( 'foundationpress_after_content' ); ?>
					<?php get_sidebar(); ?>
				</section>

				<?php

				//print_r( $posts_array ); 
			} //end foreach ($terms)

			?>



		</div>

		<?php get_footer();
