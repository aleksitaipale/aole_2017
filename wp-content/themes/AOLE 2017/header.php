<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "container" div.
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

require_once("custom-functions.php"); // For logic needed on multiple pages (e.g. fetching posts of a certain category / taxonomy)
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?> >
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php wp_head(); ?>
	<noscript><style>
		
		* {
			/*CSS transitions*/
			-o-transition-property: none !important;
			-moz-transition-property: none !important;
			-ms-transition-property: none !important;
			-webkit-transition-property: none !important;
			transition-property: none !important;
			/*CSS transforms*/
			-o-transform: none !important;
			-moz-transform: none !important;
			-ms-transform: none !important;
			-webkit-transform: none !important;
			transform: none !important;
			/*CSS animations*/
			-webkit-animation: none !important;
			-moz-animation: none !important;
			-o-animation: none !important;
			-ms-animation: none !important;
			animation: none !important;
		}
		
		.vr-box { 
			display: none 
		} 

		.front-top-header{
			background:none !important;
		}
		.featured-header{
			display:block !important;
		}
	</style>

</noscript>
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#338fd4",
      "text": "#ffffff"
    },
    "button": {
      "background": "transparent",
      "text": "#ffffff",
      "border": "#ffffff"
    }
  },
  "content": {
    "href": "http://www.aalto.fi/en/site/register/"
  }
})});
</script>
</head>
<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<div class="off-canvas-wrapper">
			<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
		<?php endif; ?>

		<?php do_action( 'foundationpress_layout_start' ); ?>

		<header class="site-header" role="banner">
			<div class="aalto-header">
				<a href="http://www.aalto.fi/en/"><img class="aalto-logo" src="<?php echo get_field('aalto_logo_small_white', 'option');?>" /></a>
			</div>
			<div class="site-title-bar title-bar" <?php foundationpress_title_bar_responsive_toggle() ?>>
				<div class="title-bar-left">
					<button class="menu-icon" type="button" data-toggle="<?php foundationpress_mobile_menu_id(); ?>"></button>
					<span class="site-mobile-title title-bar-title">	
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</span>
				</div>
			</div>
			<nav class="site-navigation top-bar" role="navigation">
				<div class="top-bar-left">					
					<div class="site-desktop-title top-bar-title">
						<img class="aole-logo" src="<?php echo get_field('aole_logo_without_text', 'option');?>" />
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					</div>
				</div>
				<div class="top-bar-right">
					<?php foundationpress_top_bar_r(); ?>

					<?php if ( ! get_theme_mod( 'wpt_mobile_menu_layout' ) || get_theme_mod( 'wpt_mobile_menu_layout' ) === 'topbar' ) : ?>
						<?php get_template_part( 'template-parts/mobile-top-bar' ); ?>
					<?php endif; ?>
				</div>
			</nav>
		</header>

		<section class="container">
			<?php do_action( 'foundationpress_after_header' );


			if( is_single() && !is_singular(array("pilot", "event", "jobs")) && !(in_category(["news", "awards", "blog"], get_post()))) {
				global $wp_query;
				$wp_query->set_404();
				status_header( 404 );
				get_template_part( '404' );
				exit();
			}
