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

<div class="main-wrap events-page full-width" role="main">

	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class('main-content events-description-container matched-height') ?> id="post-<?php the_ID(); ?>">
			<div class="events-description">
				<div class="events-description-content">
					<header>
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>
					<?php do_action( 'foundationpress_page_before_entry_content' ); ?>
					<div class="entry-content">
						<a href=<?php echo site_url( "/events.ics", $scheme ); ?>>iCal - all events</a>
						<?php the_content(); ?>
						<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>

						<div class="event-calendar">
							<?php echo do_shortcode("[events_calendar full=1 month=".date('n')."]"); ?>
						</div>
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
			<div class="events-image-container">
				<div class="events-image matched-height">
					<div>
						<?php the_post_thumbnail(); ?>
					</div>
				</div>
			</div>
		<?php endwhile;?>
		<?php
		// Fetch all the A!OLE events
		$future_events = EM_Events::get(array("scope"=>"future"));
		$past_events = EM_Events::get(array("scope"=>"past"));

		function create_event_array($em_events){
			$events_array = [];
			$event_information = [];

			foreach ($em_events as $idx=>$event){
				$events_array[] = get_all_event_info($event);
			}	
			return $events_array;
		}
		$upcoming_events = create_event_array($future_events);
		$past_events = create_event_array($past_events);
		?>
		<section class="events upcoming-events">
			<h2>Upcoming events</h2>


			<?php 
			foreach ($upcoming_events as &$event) {
				?>
				<div class="event-container">
					<div class="event upcoming-event">
						<div class="event-left-container matched-height2">
							<!-- Date -->
							<span><?php 
								$start_date = date_create($event["event"]->event_start_date);
								$end_date = date_create($event["event"]->event_end_date);
								if ($event->event_start_date != $event->event_end_date){
									echo date_format($start_date, "D d F")."-".date_format($end_date, "D d F");
								} else {
									echo date_format($start_date, "D d F");
								}
								?></span>
								<!-- Time -->
								<div class="event-time"><?php echo $event["event"]->event_start_time."-".$event["event"]->event_end_time; ?></div>
								<!-- Location -->
								<div class="event-location"><?php echo $event["event"]->location->location_name; ?></div>
								<!-- Only for pilots? -->
								<div class="event-for-pilots"><?php if ($event["event"]->custom_fields["only_for_pilots"] == 1) { echo "Event for pilots"; } else { echo "Public event"; }; ?> </div>
								<!-- Export event to iCal -->
								<div class="export-event-to-ical">
									<a href="<?php echo do_shortcode("[event post_id='".$event["post"]->ID."']#_EVENTICALURL[/event]");?>">Export to iCal</a>
								</div>
							</div>
							<!-- Picture -->
							<div class="event-center-container matched-height2">
								<img class="event-thumbnail" src="<?php echo get_the_post_thumbnail_url($event["event"]->post_id, 'square-large'); ?>"></img>
							</div>
							<!-- Event categories -->
							<div class="event-right-container matched-height2">
								<ul class="event-category-list">
									<?php foreach($event["event"]->event_categories as $cat){ echo "<li>".$cat->name."</li>"; } ?>
								</ul>
								<!-- Facilitator(s) -->
								<ul class="event-facilitator-list">
									<?php foreach($event["event"]->custom_fields["facilitators"] as $field){ echo "<li>".$field["facilitator"]."</li>"; } ?>
								</ul>
								<!-- Event title -->
								<a class="event-title" href="<?php echo $event["event"]->the_permalink; ?>"><h3><?php echo $event["event"]->event_name; ?></h3></a>	
							</div>
						</div>
						<hr>
					</div>

					<?php } ?>



				</section>
				<section class="events past-events">
					<h2>Past events</h2>
					<ul>
						<?php 
						foreach ($past_events as &$event) {
							?>
							<li>
								<div class="event past-event">
									<div class="event-left-container matched-height2">
										<!-- Date -->
										<span><?php 
											$start_date = date_create($event["event"]->event_start_date);
											$end_date = date_create($event["event"]->event_end_date);
											if ($event->event_start_date != $event->event_end_date){
												echo date_format($start_date, "D d F")."-".date_format($end_date, "D d F");
											} else {
												echo date_format($start_date, "D d F");
											}
											?></span>
											<!-- Time -->
											<div class="event-time"><?php echo $event["event"]->event_start_time."-".$event["event"]->event_end_time; ?></div>
											<!-- Location -->
											<div class="event-location"><?php echo $event["event"]->location->location_name; ?></div>
											<!-- Only for pilots? -->
											<div class="event-for-pilots"><?php if ($event["event"]->custom_fields["only_for_pilots"] == 1) { echo "Event for pilots"; } else { echo "Public event"; }; ?> </div>
										</div>
										<!-- Picture -->
										<div class="event-center-container matched-height2">
											<img class="event-thumbnail" src="<?php echo get_the_post_thumbnail_url($event["event"]->post_id, 'square-large'); ?>"></img>
										</div>
										<!-- Event categories -->
										<div class="event-right-container matched-height2">
											<ul class="event-category-list">
												<?php foreach($event["event"]->event_categories as $cat){ echo "<li>".$cat->name."</li>"; } ?>
											</ul>
											<!-- Facilitator(s) -->
											<ul class="event-facilitator-list">
												<?php foreach($event["event"]->custom_fields["facilitators"] as $field){ echo "<li>".$field["facilitator"]."</li>"; } ?>
											</ul>
											<!-- Event title -->
											<a class="event-title" href="<?php echo $event["event"]->the_permalink; ?>"><h3><?php echo $event["event"]->event_name; ?></h3></a>	
										</div>
										<hr>
									</div>
								</li>
								<?php } ?>

							</ul>

						</section>

						<?php do_action( 'foundationpress_after_content' ); ?>
						<?php get_sidebar(); ?>

					</div>

					<?php get_footer();
