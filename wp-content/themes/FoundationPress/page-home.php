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
	<section class="vrbox">
		<blockquote data-width="100%" data-height="600px" class="ricoh-theta-spherical-image" >Post from RICOH THETA. #theta360 - <a href="https://theta360.com/s/jFtMPIK0W44acnaWi1y0nrwrg" target="_blank">Spherical Image - RICOH THETA</a></blockquote>
		<script async src="https://theta360.com/widgets.js" charset="utf-8"></script>
	</section>
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
$args = array(
    'posts_per_page' => 1, // we need only the latest post, so get that post only
    'category_name' => 'news',
    );
$newsQuery = new WP_Query( $args);

if ( $newsQuery->have_posts() ) {
	while ( $newsQuery->have_posts() ) {
		$newsQuery->the_post();        

		?>
		<div class="aole-feed-container">
			<div class="aole-feeds">
				<div class="aole-feed matched-height2">
					<h2><?php get_field('blog_news_title'); ?></h2>
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
		<div class="next-event matched-height2">
			<h2>Next event</h2>
			<?php
			$next_event = EM_Events::get(array("scope"=>"future", "limit"=>1, "orderby" => "event_start_date"))[0];

			?>
			<a href="<?php echo get_permalink($next_event->post_id)?>"><h3><?php echo $next_event->event_name; ?></h3></a>
			<p><?php 
				if( strpos( $next_event->post_content, '<!--more-->' ) ) {
					echo get_the_content_by_id($next_event->post_id);
					echo "<a class='read-more-link' href='".get_the_permalink($next_event->post_id)."'>Read more...</a>";
				}
				else {
					echo get_the_excerpt_by_id($next_event->post_id);
				}?>
			</p>
		</div>
	</div>
</div>

<?php $pilots_showcase_section = get_field("pilots_showcase_section"); ?>
<section class="pilots-showcase-container front-section">
	<div class="aole-pilots-showcase">
		<h2><?php echo $pilots_showcase_section["title_for_aole_pilots_showcase_section"]; ?></h2>
		<div class="pilots-carousel">
			<div class="single-carousel-pilot"><img src="http://via.placeholder.com/350x150"></img></div>
			<div class="single-carousel-pilot"><img src="http://via.placeholder.com/350x150"></img></div>
			<div class="single-carousel-pilot"><img src="http://via.placeholder.com/350x150"></img></div>
			<div class="single-carousel-pilot"><img src="http://via.placeholder.com/350x150"></img></div>
			<div class="single-carousel-pilot"><img src="http://via.placeholder.com/350x150"></img></div>
			<div class="single-carousel-pilot"><img src="http://via.placeholder.com/350x150"></img></div>
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
		<div class="image matched-height3">
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
		<div class="image matched-height4">
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
