<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */

$fullWPpath = '/Users/taipala2/Documents/OneDrive - Aalto-yliopisto/Web Projects/htdocs/wordpress';

require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Format comments */
require_once( 'library/class-foundationpress-comments.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/class-foundationpress-top-bar-walker.php' );
require_once( 'library/class-foundationpress-mobile-walker.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** Configure responsive image sizes */
require_once( 'library/responsive-images.php' );

/* Write to log */

if (!function_exists('write_log')) {
    function write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}


//add_filter('tribe_events_meta_box_template', 'change_event_mb_tpl');

/*function change_event_mb_tpl($tpl) {
        return (false !== strpos($tpl, 'events-meta-box.php'))
                ? '/Users/taipala2/Documents/OneDrive - Aalto-yliopisto/Web Projects/htdocs/wordpress/wp-content/themes/FoundationPress/tribe-events/custom-meta-box.php' //TODO CHANGE PATH
                : $tpl;
            }*/

            /** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/class-foundationpress-protocol-relative-theme-assets.php' );




// from https://gist.github.com/brenna/7377802
// Idea being: whenever a new Theme Group post is added, it also adds it to the Theme Group taxonomy (so that they'll stay in sync)

            function update_custom_terms($post_id) {

    // only update terms if it's a theme group post
             if ( 'theme_group' != get_post_type($post_id)) {
              return;
          }

    // don't create or update terms for system generated posts
          if (get_post_status($post_id) == 'auto-draft') {
              return;
          }

    /*
    * Grab the post title and slug to use as the new 
    * or updated term name and slug
    */
    $term_title = get_the_title($post_id);
    $term_slug = get_post( $post_id )->post_name;

    /*
    * Check if a corresponding term already exists by comparing 
    * the post ID to all existing term descriptions. 
    */
    $existing_terms = get_terms('theme_group', array(
    	'hide_empty' => false
    	)
    );

    foreach($existing_terms as $term) {
    	if ($term->description == $post_id) {
            //term already exists, so update it and we're done
    		wp_update_term($term->term_id, 'theme_group', array(
    			'name' => $term_title,
    			'slug' => $term_slug
    			)
    		);
    		return;
    	}
    }

    /* 
    * If we didn't find a match above, this is a new post, 
    * so create a new term.
    */
    wp_insert_term($term_title, 'theme_group', array(
    	'slug' => $term_slug,
    	'description' => $post_id
    	)
    );
}

//run the update function whenever a post is created or edited
add_action('save_post', 'update_custom_terms');


/* Remove the regular WYSIWYG editor from the front page, which is handled by CFS. */
add_action( 'admin_head', 'hide_editor' );
function hide_editor() {
    $template_file = basename( get_page_template() );
    if($template_file == 'page-home.php'){ // template
        remove_post_type_support('page', 'editor');
    }
}

add_image_size( 'square-large', 300, 300, true); // name, width, height, crop 



