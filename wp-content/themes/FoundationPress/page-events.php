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
		$future_events = EM_Events::get(array("scope"=>"future"));
		$past_events = EM_Events::get(array("scope"=>"past"));

		function create_event_array($em_events){
			$events_array = [];
			$event_information = [];
			
			foreach ($em_events as $idx=>$event){
				$post_id = $event->post_id;
				$post_info = get_post($post_id);
				$event->the_permalink = get_permalink($post_id);
			$event->custom_fields = CFS()->get(false, $post_id); //Add all the fields from CFS to the post info object
			$event->location = em_get_location($event->location_id);
			$event->event_categories = wp_get_post_terms( $event->post_id, "event-categories");

			// The $event_information variable is divided into two objects, "post" and "event". The former contains the post information (that
			// has been fetched with get_post) and the latter contains the event information (gotten with EM_Events::get())
			$event_information["post"]=$post_info;
			$event_information["event"]=$event;

			$events_array[] = $event_information; 
		}	
		return $events_array;
	}
	$future_events = create_event_array($future_events);
	$past_events = create_event_array($past_events);
	?>
	<section class="upcoming-events">
		<h2>Upcoming events</h2>
		<ul>

			<?php 
			foreach ($future_events as &$event) {
				?>
				<li>
					<img src="<?php echo get_the_post_thumbnail_url($event["event"]->post_id); ?>"></img>
					<span><?php 
						$start_date = date_create($event["event"]->event_start_date);
						$end_date = date_create($event["event"]->event_end_date);
						if ($event->event_start_date != $event->event_end_date){
							echo date_format($start_date, "D d F")."-".date_format($end_date, "D d F");
						} else {
							echo date_format($start_date, "D d F");
						}
						?></span>
						<span><?php //echo $event->custom_fields["event_type"]; ?></span>
						<span><?php echo $event["event"]->event_start_time; ?></span>
						<span><?php echo $event["event"]->location->location_name; ?></span>
						<span><?php
							if ($event["event"]->custom_fields["only_for_pilots"] == 1) { echo "Event for pilots"; } else { echo "Public event"; }; ?> </span>
							<ul>
								<?php foreach($event["event"]->custom_fields["facilitators"] as $field){ echo "<li>".$field["facilitator"]."</li>"; } ?>
							</ul>
							<ul>
								<?php foreach($event["event"]->event_categories as $cat){ echo "<li>".$cat->name."</li>"; } ?>
							</ul>


							<a href="<?php echo $event["event"]->the_permalink; ?>"><h3><?php echo $event["event"]->event_name; ?></h3></a>
							<hr>
						</li>
						<?php } ?>

					</ul>

				</section>
				<section class="past-events">
					<h2>Past events</h2>
					<ul>

						<?php 
						foreach ($past_events as &$event) {
							?>
							<li>
								<img src="<?php echo get_the_post_thumbnail_url($event["event"]->post_id); ?>"></img>
								<span><?php 
									$start_date = date_create($event["event"]->event_start_date);
									$end_date = date_create($event["event"]->event_end_date);
									if ($event->event_start_date != $event->event_end_date){
										echo date_format($start_date, "D d F")."-".date_format($end_date, "D d F");
									} else {
										echo date_format($start_date, "D d F");
									}
									?></span>
									<span><?php //echo $event->custom_fields["event_type"]; ?></span>
									<span><?php echo $event["event"]->event_start_time; ?></span>
									<span><?php echo $event["event"]->location->location_name; ?></span>
									<span><?php
										if ($event["event"]->custom_fields["only_for_pilots"] == 1) { echo "Event for pilots"; } else { echo "Public event"; }; ?> </span>
										<ul>
											<?php foreach($event["event"]->custom_fields["facilitators"] as $field){ echo "<li>".$field["facilitator"]."</li>"; } ?>
										</ul>
										<ul>
											<?php foreach($event["event"]->event_categories as $cat){ echo "<li>".$cat->name."</li>"; } ?>
										</ul>


										<a href="<?php echo $event["event"]->the_permalink; ?>"><h3><?php echo $event["event"]->event_name; ?></h3></a>
										<hr>
									</li>
									<?php } ?>

								</ul>

							</section>

							<?php do_action( 'foundationpress_after_content' ); ?>
							<?php get_sidebar(); ?>

						</div>

						<?php get_footer();
