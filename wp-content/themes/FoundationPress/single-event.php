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






<div class="main-wrap single-event-page" role="main">
	<?php do_action( 'foundationpress_before_content' ); ?>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php
		$this_event = EM_Events::get(array("scope"=>"all", "post_id"=>get_the_ID()))[0];

		$event = get_all_event_info($this_event);

		?>

		<div class="event-container">
			<div class="event upcoming-event" data-equalizer>
				<?php do_action( 'foundationpress_before_content' ); ?>
				<div class="event-left-container" data-equalizer-watch>
					<!-- Date -->
					<span class="event-date"><?php 
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
					<div class="event-center-container" data-equalizer-watch>
						<img class="event-thumbnail" src="<?php echo get_event_image_url($event["event"]->post_id, 'square-large'); ?>"></img>
						<?php if ($event["event"]->custom_fields["registration_link"]): ?>
							<div class="registration-link">
								<a class="button" href="<?php echo $event["event"]->custom_fields["registration_link"]; ?>">Register here</a>
							</div>
						<?php endif; ?>
					</div>
					<!-- Event categories -->
					<div class="event-right-container" data-equalizer-watch>
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
					<div class="event-description">
						<?php the_content(); ?>
						<?php if ($event["event"]->custom_fields["registration_link"]): ?>
							<div class="registration-link">
								<a class="button" href="<?php echo $event["event"]->custom_fields["registration_link"]; ?>">Register here!</a>
							</div>
						<?php endif; ?>
						<?php edit_post_link( __( 'Edit', 'foundationpress' ), '<span class="edit-link">', '</span>' ); ?>

					</div>
				</div>
			</div>



			
		<?php endwhile;?>

		<?php do_action( 'foundationpress_after_content' ); ?>
		<?php get_sidebar(); ?>

	</div>


	<?php get_footer();