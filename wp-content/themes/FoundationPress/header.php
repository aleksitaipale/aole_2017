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
</head>
<body <?php body_class(); ?>>
	<?php do_action( 'foundationpress_after_body' ); ?>

	<?php if ( get_theme_mod( 'wpt_mobile_menu_layout' ) === 'offcanvas' ) : ?>
		<div class="off-canvas-wrapper">
			<?php get_template_part( 'template-parts/mobile-off-canvas' ); ?>
		<?php endif; ?>

		<?php do_action( 'foundationpress_layout_start' ); ?>

		<header class="site-header" role="banner">
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
						<img class="aole-logo" src="<?php echo get_template_directory_uri()."/assets/images/aole_logo_notext.png"; ?>" />
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
