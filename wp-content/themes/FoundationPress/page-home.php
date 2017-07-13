<?php
/*
Template Name: Front
*/
get_header(); ?>



<?php 
do_action( 'foundationpress_before_content' ); 

$fields = CFS()->get();
print_r($fields); 
?>

<section class="vrbox">
	<blockquote data-width="100%" data-height="600px" class="ricoh-theta-spherical-image" >Post from RICOH THETA. #theta360 - <a href="https://theta360.com/s/jFtMPIK0W44acnaWi1y0nrwrg" target="_blank">Spherical Image - RICOH THETA</a></blockquote>
	<script async src="https://theta360.com/widgets.js" charset="utf-8"></script>
</section>
<section class="aole-info front-section">
	<div class="what-is-aole front-section">
		<h2><?php echo $fields["what_is_aole_title"]; ?></h2>
		<p><?php echo $fields["what_is_aole_content"]; ?></p>
	</div>
	<div class="teaching-at-aalto front-section">
		<h2><?php echo $fields["call_for_ideas_title"]; ?></h2>
		<p><?php echo $fields["call_for_ideas_content"]; ?></p>
	</div>
</section>
<section class="aole-feeds front-section">
	<div class="aole-feed front-section">
		<h2><?php echo $fields["news_title"]; ?></h2>
		<div></div>
	</div>
	<div class="next-event front-section">
		<h2>Next event</h2>
		<div></div>
	</div>
</section>
<section class="pilots-showcase front-section">
	<h2><?php echo $fields["pilots_showcase_title"]; ?></h2>
	<div class="pilots-carousel"></div>
</section>
<section class="why-online front-section">
	<h2><?php echo $fields["why_online_title"]; ?></h2>
	<p><?php echo $fields["why_online_content"]; ?></p>
</section>
<section class="why-aole front-section">
	<h2><?php echo $fields["why_aole_title"]; ?></h2>
	<p><?php echo $fields["why_aole_content"]; ?></p>
</section>


<?php do_action( 'foundationpress_after_content' ); ?>

<div class="section-divider">
	<hr />
</div>


<section class="benefits">
	
</section>



<?php get_footer();
