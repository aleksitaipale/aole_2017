<?php
/*
Template Name: Front
*/
get_header(); ?>
<?php 
do_action( 'foundationpress_before_content' ); 

$fields = CFS()->get();
//print_r($fields); 
?>
<div class="main-wrap front-page full-width" role="main">
	<section class="vrbox">
		<blockquote data-width="100%" data-height="600px" class="ricoh-theta-spherical-image" >Post from RICOH THETA. #theta360 - <a href="https://theta360.com/s/jFtMPIK0W44acnaWi1y0nrwrg" target="_blank">Spherical Image - RICOH THETA</a></blockquote>
		<script async src="https://theta360.com/widgets.js" charset="utf-8"></script>
	</section>
	<section class="aole-info-container matched-height">
		<div class="aole-info">
			<div class="aole-description">
				<h2><?php echo $fields["what_is_aole_title"]; ?></h2>
				<p><?php echo $fields["what_is_aole_content"]; ?></p>
				<ul class="featured-team-members">
					<?php 
					$fields = CFS()->get();
					$team_members = [];

					$team_members[0]->post_info = get_post( $fields["featured_core_team_members"][0] );
					$team_members[0]->custom_fields = CFS()->get(false, $fields["featured_core_team_members"][0] );
					$team_members[1]->post_info = get_post( $fields["featured_core_team_members"][1] );
					$team_members[1]->custom_fields = CFS()->get(false, $fields["featured_core_team_members"][1] );
					echo "<pre style='font-size:9px;'>";
					echo "</pre>";
				//print_r($fields["featured_core_team_members"]);
					?>

					<?php foreach ($team_members as $team_member) {?>

					<li class="team-member">
						<img src="<?php echo get_the_post_thumbnail_url($team_member->post_info->ID, 'thumbnail');?>"></img>
						<div class="team-member-name"><?php echo $team_member->custom_fields["name"]; ?></div>
						<div class="team-member-title"><?php echo $team_member->custom_fields["title"]; ?></div>
						<div class="team-member-contact"><?php echo $team_member->custom_fields["contact_info"]; ?></div>
						<div class="team-member-social-media"><a href="<?php echo $team_member->custom_fields["social_media"]["url"];?>"><?php echo $team_member->custom_fields["social_media"]["text"]; ?></a></div>
					</li>
					<?php } ?>
				</ul>
			</div>

		</div>
	</section>
	<section class="teaching-container matched-height">
		<div class="teaching">
			<div>
				<h2><?php echo $fields["call_for_ideas_title"]; ?></h2>
				<p><?php echo $fields["call_for_ideas_content"]; ?></p>
			</div>
		</div>
	</section>
	<div class="aole-feed-container">
		<div class="aole-feeds">
			<div class="aole-feed matched-height2">

				<h2><?php echo $fields["news_title"]; ?></h2>
				<p>selityksiä.</p>

			</div>
			<div class="next-event matched-height2">

				<h2>Next event</h2>
				<p>Tapahtumapuheita.</p>

			</div>
		</div>
	</div>


<!--	<section class="pilots-showcase front-section">
		<h2><?php echo $fields["pilots_showcase_title"]; ?></h2>
		<div class="pilots-carousel"></div>
	</section> -->


	<section class="why-online-container">
		<div class="why-online">
			<div class="content matched-height3">
				<h2><?php echo $fields["why_online_title"]; ?></h2>
				<p><?php echo $fields["why_online_content"]; ?></p>
			</div>
			<div class="image matched-height3">
				<img src="<?php echo $fields["featured_image_for_why_online_learning_section"]; ?>"></img>
			</div>
		</div>
	</section>
	<section class="why-aole-container">
		<div class="why-aole">
			<div class="content matched-height4">
				<h2><?php echo $fields["why_aole_title"]; ?></h2>
				<p><?php echo $fields["why_aole_content"]; ?></p>
			</div>
			<div class="image matched-height4">
				<img src="<?php echo $fields["featured_image_for_why_aole_section"]; ?>"></img>
			</div>
		</div>
	</section>


	<?php do_action( 'foundationpress_after_content' ); ?>

	<div class="section-divider">
		<hr />
	</div>


	<section class="benefits">

	</section>
</div>



<?php get_footer();
