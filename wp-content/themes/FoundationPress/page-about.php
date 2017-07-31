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

<div class="main-wrap about-page full-width" role="main">

	<div class="about-description-container matched-height">
		<?php do_action( 'foundationpress_before_content' ); ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<article <?php post_class('main-content about-description-content') ?> id="post-<?php the_ID(); ?>">
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
			</div>
		<?php endwhile;?>

		<section class="team-members-container matched-height">
			<div class="team-members">
				<h2>Core team</h2>
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
						<div><?php echo $custom_fields["name"]; ?></div>
						<div><?php echo $custom_fields["title"]; ?></div>
						<div><?php echo $custom_fields["contact_info"]; ?></div>
						<div><a href="<?php echo $custom_fields["social_media"]["url"];?>"><?php echo $custom_fields["social_media"]["text"]; ?></a></div>
					</div>

					<?php 
				}
				?>
			</div>
		</section>
		<div class="aole-article-container">
			<?php 
global $post; // required
$args = array('category' => 8); // include category 8 (About)
$custom_posts = get_posts($args);
foreach($custom_posts as $post) { 
	setup_postdata($post);

	?>

	<div class="aole-article">
		<article class="aole-article-content">
			<h2><?php the_title(); ?></h2>
			<p><?php the_content(); ?></p>
		</article>
		<div class="aole-article-image">
			<?php the_post_thumbnail(); ?>
		</div>
	</div>

	<?php } // end foreach ?>

	<?php do_action( 'foundationpress_after_content' ); ?>
	<?php get_sidebar(); ?>

</div>
</div>

<?php get_footer();
