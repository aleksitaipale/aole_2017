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
		<article <?php post_class('main-content about-aole') ?> id="post-<?php the_ID(); ?>">
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

		<section class="team-members">
			<?php

			//Get all team members
			$team_members_array = get_posts(
				array( 'showposts' => -1,
					'post_type' => 'team_members'
					)
				);
			
			//Display all team members
			foreach ($team_members_array as $team_member){
				$custom_fields = CFS()->get(false, $team_member->ID);

				?>
				<div class="team-member">
				<img src="<?php echo get_the_post_thumbnail_url($team_member->ID, 'thumbnail');?>"></img>
				<span><?php echo $custom_fields["name"]; ?></span>
				<span><?php echo $custom_fields["title"]; ?></span>
				<span><?php echo $custom_fields["contact_info"]; ?></span>
				<span><a href="<?php echo $custom_fields["social_media"]["url"];?>"><?php echo $custom_fields["social_media"]["text"]; ?></a></span>
				</div>
				<?php 
			}
			?>
		</section>

		<?php 
global $post; // required
$args = array('category' => 8); // include category 8 (About)
$custom_posts = get_posts($args);
foreach($custom_posts as $post) { 
	setup_postdata($post);

	?>
	<article class="about-aole-article">
		<h2><?php the_title(); ?></h2>
		<p><?php the_content(); ?></p>
	</article>

	<?php } // end foreach ?>

	<?php do_action( 'foundationpress_after_content' ); ?>
	<?php get_sidebar(); ?>

</div>

<?php get_footer();
