<?php
/*
Template Name: Front
*/
get_header(); ?>
<?php 
do_action( 'foundationpress_before_content' ); 

$what_is_aole_section = get_field('what_is_aole_section');

?>
<div class="main-wrap front-page full-width" role="main">
	<!--<section class="vrbox">
		<blockquote data-width="100%" data-height="600px" class="ricoh-theta-spherical-image" >Post from RICOH THETA. #theta360 - <a href="https://theta360.com/s/jFtMPIK0W44acnaWi1y0nrwrg" target="_blank">Spherical Image - RICOH THETA</a></blockquote>
		<script async src="https://theta360.com/widgets.js" charset="utf-8"></script>
	</section>-->
	<section class="aole-info-container matched-height">
		<div class="aole-info">
			<div class="aole-description">
				<h2><?php echo $what_is_aole_section["what_is_aole_title"]; ?></h2>
				<p><?php echo $what_is_aole_section["what_is_aole_content"]; ?></p>
			</div>
			
			<div class="featured-team-members">
				<?php 

				$team_members = get_field('featured_core_team_members');

				if( $team_members ): ?>
				<?php foreach( $team_members as $post): // variable must be called $post (IMPORTANT) ?>
					<?php setup_postdata($post); ?>
					<div class="front-team-member team-member">
						<img src="<?php echo get_the_post_thumbnail_url(null, "thumbnail"); ?>"></img>
						<div class="team-member-name"><?php the_field('name'); ?></div>
						<div class="team-member-title"><?php the_field('title'); ?></div>
						<?php if( get_field('contact_info') ): ?>
							<div class="team-member-contact"><?php the_field('contact_info'); ?></div>
						<?php endif; ?>
						<?php if( have_rows('social_media') ): ?>
							<?php 
							while( have_rows('social_media') ): the_row(); 
							$link = get_sub_field('social_media_link');
							?>
							<?php if( $link ): ?>
								<a class="social-media-link" href="<?php echo $link["url"]; ?>"><?php echo $link["title"]?></a>
							<?php endif; ?>
							<?php 
							endwhile;
							?>
						<?php endif; ?>
						

					</div>
				<?php endforeach; ?>
				<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php
$call_for_idea_proposals_section = get_field('call_for_idea_proposals_section');
?>
<section class="teaching-container matched-height">
	<div class="teaching">
		<div>
			<h2><?php echo $call_for_idea_proposals_section["call_for_ideas_title"]; ?></h2>
			<p><?php echo $call_for_idea_proposals_section["call_for_ideas_content"]; ?></p>
		</div>
	</div>
</section>
<?php

$blog_news_title = get_field("blog_news_title"); // this field has to be retrieved before the "loop inside a loop" to be able to be shown

$args = array(
    'posts_per_page' => 1, // we need only the latest post, so get that post only
    'category_name' => 'news',
    );
$newsQuery = new WP_Query( $args);

if ( $newsQuery->have_posts() ) {
	while ( $newsQuery->have_posts() ) {
		$newsQuery->the_post();        

		?>
		<section class="aole-feed-container">
			<div class="aole-feeds">
				<div class="aole-feed matched-height2">
					<h2><?php echo $blog_news_title; ?></h2>
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
				<?php
			}
			wp_reset_postdata();
		}?>
		<div class="next-event events matched-height2">
			<div class="event-container">
				<div class="event front-event">
					<h2>Next event</h2>
					<?php
					$next_event = EM_Events::get(array("scope"=>"future", "limit"=>1, "orderby" => "event_start_date"))[0];
					$event = get_all_event_info($next_event);
					?>
					<div class="event-left-container matched-heightA">
						<!-- Date -->
						<span>
							<?php 
							$start_date = date_create($event["event"]->event_start_date);
							$end_date = date_create($event["event"]->event_end_date);
							if ($event->event_start_date != $event->event_end_date){
								echo date_format($start_date, "D d F")."-".date_format($end_date, "D d F");
							} else {
								echo date_format($start_date, "D d F");
							}
							?>

						</span>
						<!-- Time -->
						<div class="event-time"><?php echo $event["event"]->event_start_time."-".$event["event"]->event_end_time; ?></div>
						<!-- Location -->
						<div class="event-location"><?php echo $event["event"]->location->location_name; ?></div>
						<!-- Only for pilots? -->
						<div class="event-for-pilots"><?php if ($event["event"]->custom_fields["only_for_pilots"] == 1) { echo "Event for pilots"; } else { echo "Public event"; }; ?> </div>
					</div>
					<!-- Picture -->
					<div class="event-center-container matched-heightA">
						<img class="event-thumbnail" src="<?php echo get_the_post_thumbnail_url($event["event"]->post_id, 'square-large'); ?>"></img>
					</div>
					<!-- Event categories -->
					<div class="event-right-container matched-heightA">
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
					<!--
					<div class="event-description">
						<?php if( strpos( $next_event->post_content, '<!--more-->' ) ) {
							echo get_the_content_by_id($event["post"]->ID);
							echo "<a class='read-more-link' href='".get_the_permalink($event["post"]->ID)."'>Read more...</a>";
						}
						else {
							echo get_the_excerpt_by_id($event["post"]->ID);
						}
						?>
					</div>
				-->
			</div>
		</div>

	</div>

</div>

</div>

<?php $pilots_showcase_section = get_field("pilots_showcase_section"); ?>
<section class="pilots-showcase-container front-section">
	<div class="aole-pilots-showcase">
		<h2><?php echo $pilots_showcase_section["title_for_aole_pilots_showcase_section"]; ?></h2>
		<div class="pilots-carousel">
			<?php foreach ($pilots_showcase_section["showcased_pilots"] as $showcase_pilot): ?>
				<a href="<?php echo get_the_permalink($showcase_pilot->ID); ?>"><div class="single-carousel-pilot"><img src="<?php echo get_the_post_thumbnail_url($showcase_pilot->ID); ?>"></img></div></a>
			<?php endforeach; ?>
		</div>

	</div>
</section>
<?php $why_online_section = get_field("why_online_section"); ?>
<section class="why-online-container">
	<div class="why-online">
		<div class="content matched-height3">
			<h2><?php echo $why_online_section["why_online_title"]; ?></h2>
			<p><?php echo $why_online_section["why_online_content"]; ?></p>
		</div>
		<div class="home-image matched-height3">
			<img src="<?php echo $why_online_section["why_online_featured_image"]; ?>"></img>
		</div>
	</div>
</section>
<?php $why_aole_section = get_field("why_aole_section"); ?>
<section class="why-aole-container">
	<div class="why-aole">
		<div class="content matched-height4">
			<h2><?php echo $why_aole_section["why_aole_title"]; ?></h2>
			<p><?php echo $why_aole_section["why_aole_content"]; ?></p>
		</div>
		<div class="home-image matched-height4">
			<img src="<?php echo $why_aole_section["why_aole_featured_image"]; ?>"></img>
		</div>
	</div>
</section>


<?php do_action( 'foundationpress_after_content' ); ?>

<div class="section-divider">
	<hr />
</div>

</div>



<?php get_footer();
