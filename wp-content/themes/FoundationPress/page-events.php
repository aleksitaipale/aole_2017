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
		<article <?php post_class('main-content aole-events-section') ?> id="post-<?php the_ID(); ?>">
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
			// Fetch all the A!OLE events
		$query = new WP_Query(array(
			'post_type' => 'event',
			'post_status' => 'publish',
			'posts_per_page' => -1
			));

		$future_events = [];
		$past_events = [];

		while ($query->have_posts()) {
			$query->the_post();
			$post_id = get_the_ID();
			$post_info = get_post($post_id);
			$categories = get_the_category();
			if ( ! empty( $categories ) ) {
				$post_info->post_category=$categories[0]->name;   
			}

			$post_info->custom_fields = CFS()->get(); //Add all the fields from CFS to the post info object
			// Check if event was a past event or a future event and add info to the according array
			if(time() <= strtotime($post_info->custom_fields["event_date"])){
				$future_events[] = $post_info;
			} else {
				$past_events[] = $post_info;
			}
			echo "<br>";
		}

		?>
		<section>
			<h2>Upcoming events</h2>
			<ul>
				<?php 
				foreach ($future_events as &$post) {
					echo "<li>".$post->post_title."</li>";
				}
				?>
			</ul>
		</section>
		<section>
			<h2>Past events</h2>
			<ul>
				<li>
					<?php 
					foreach ($past_events as &$post) {
						?>
						<span><?php 
							$date = date_create($post->custom_fields["event_date"]);

							echo date_format($date, "D d F");

							?></span>
							<span><?php echo $post->custom_fields["event_time"]?></span>
							<span><?php echo $post->custom_fields["location"]?></span>
							<span><?php foreach($post->custom_fields["pilot_or_public"] as $key=>$label){ echo $label; }?></span>
							<ul>
								<?php foreach($post->custom_fields["facilitators"] as $field){ echo "<li>".$field["facilitator"]."</li>"; } ?>
							</ul>

							<ul>

							</ul>
							<h3><?php echo $post->post_title; ?></h3>
							<hr>
							<?php } ?>
						</ul>

					</section>

					<?php do_action( 'foundationpress_after_content' ); ?>
					<?php get_sidebar(); ?>

				</div>

				<?php get_footer();
