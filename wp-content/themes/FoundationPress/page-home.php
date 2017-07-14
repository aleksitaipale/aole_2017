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
	<section class="aole-info-container front-box">
		<div class="aole-info">
			<div class="aole-description">
				<h2><?php echo $fields["what_is_aole_title"]; ?></h2>
				<p><?php echo $fields["what_is_aole_content"]; ?></p>
			</div>
		</div>
	</section>
	<section class="teaching-container front-box">
		<div class="teaching">
			<div>
				<h2><?php echo $fields["call_for_ideas_title"]; ?></h2>
				<p><?php echo $fields["call_for_ideas_content"]; ?></p>
			</div>
		</div>
	</section>
	<div class="aole-feed-container">
		<div class="aole-feed front-box2">
			<div>
				<h2><?php echo $fields["news_title"]; ?></h2>
				<p>selityksiä.</p>
			</div> 
		</div>
		<div class="next-event front-box2">
			<div>
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
			<div class="content front-box3">
				<h2><?php echo $fields["why_online_title"]; ?></h2>
				<p><?php echo $fields["why_online_content"]; ?></p>
			</div>
			<div class="image front-box3">
				KUVA
			</div>
		</div>
	</section>
	<section class="why-aole-container">
		<div class="why-aole">
			<div class="content front-box4">
				<h2><?php echo $fields["why_aole_title"]; ?></h2>
				<p><?php echo $fields["why_aole_content"]; ?></p>
			</div>
			<div class="image front-box4">
				KUVA
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
