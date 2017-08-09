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


add_image_size( 'square-large', 300, 300, true); // name, width, height, crop 

add_image_size( 'pilot-showcase', 430, 190, true); // name, width, height, crop 


// Custom excerpt for feed posts on front page //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Source: https://stackoverflow.com/a/24160854

function wpse_allowedtags() {
    // Add custom tags to this string
    return '<script>,<style>,<br>,<em>,<i>,<ul>,<ol>,<li>,<a>,<p>,<img>,<video>,<audio>'; 
}

if ( ! function_exists( 'wpse_custom_wp_trim_excerpt' ) ) : 

    function wpse_custom_wp_trim_excerpt($wpse_excerpt) {
        global $post;
        $raw_excerpt = $wpse_excerpt;
        if ( '' == $wpse_excerpt ) {

            $wpse_excerpt = get_the_content('');
            $wpse_excerpt = strip_shortcodes( $wpse_excerpt );
            $wpse_excerpt = apply_filters('the_content', $wpse_excerpt);
            $wpse_excerpt = str_replace(']]>', ']]&gt;', $wpse_excerpt);
            //$wpse_excerpt = strip_tags($wpse_excerpt, wpse_allowedtags()); /*IF you need to allow just certain tags. Delete if all tags are allowed */

            //Set the excerpt word count and only break after sentence is complete.
            $excerpt_word_count = 75;
            $excerpt_length = apply_filters('excerpt_length', $excerpt_word_count); 
            $tokens = array();
            $excerptOutput = '';
            $count = 0;

                // Divide the string into tokens; HTML tags, or words, followed by any whitespace
            preg_match_all('/(<[^>]+>|[^<>\s]+)\s*/u', $wpse_excerpt, $tokens);

            foreach ($tokens[0] as $token) { 

                if ($count >= $excerpt_word_count && preg_match('/[\,\;\?\.\!]\s*$/uS', $token)) { 
                    // Limit reached, continue until , ; ? . or ! occur at the end
                    $excerptOutput .= trim($token);
                    break;
                }

                    // Add words to complete sentence
                $count++;

                    // Append what's left of the token
                $excerptOutput .= $token;
            }

            $wpse_excerpt = trim(force_balance_tags($excerptOutput));

            $excerpt_end = ' <a class="read-more-link" href="'. esc_url( get_permalink() ) . '">Read more...</a>'; 
            $excerpt_more = apply_filters('excerpt_more', ' ' . $excerpt_end); 

                //$pos = strrpos($wpse_excerpt, '</');
                //if ($pos !== false)
                // Inside last HTML tag
                //$wpse_excerpt = substr_replace($wpse_excerpt, $excerpt_end, $pos, 0); /* Add read more next to last word */
                //else
                // After the content
            $wpse_excerpt .= $excerpt_end; /*Add read more in new paragraph */

            return $wpse_excerpt;   

        }
        return apply_filters('wpse_custom_wp_trim_excerpt', $wpse_excerpt, $raw_excerpt);
    }

    endif; 

    remove_filter('get_the_excerpt', 'wp_trim_excerpt');
    add_filter('get_the_excerpt', 'wpse_custom_wp_trim_excerpt');


//Get the excerpt with ID:
//Source: https://wordpress.stackexchange.com/a/12503
    
    function get_the_excerpt_by_id($post_id) {
      global $post;  
      $save_post = $post;
      $post = get_post($post_id);
      $output = get_the_excerpt();
      $post = $save_post;
      return $output;
  }

  function get_the_content_by_id($post_id) {
      $post = get_post($post_id);
      $content_arr = get_extended($post->post_content);
      return apply_filters('the_content', $content_arr['main']);
  }
  
  function get_all_event_info($em_event) {
    $event_information = [];
    $post_id = $em_event->post_id;
    $post_info = get_post($post_id);
    $em_event->the_permalink = get_permalink($post_id);
    $em_event->custom_fields = get_fields($post_id); //Add all the fields from ACF to the post info object
    $em_event->location = em_get_location($em_event->location_id);
    $em_event->event_categories = wp_get_post_terms( $em_event->post_id, "event-categories");

    // The $event_information variable is divided into two objects, "post" and "event". The former contains the post information (that
    // has been fetched with get_post) and the latter contains the event information (gotten with EM_Events::get())
    $event_information["post"]=$post_info;
    $event_information["event"]=$em_event;


    return $event_information;
}

function get_event_image_url($event_id, $image_size){
// use default picture if event doesn't have a featured image
    $thumb_url = "";
    if (has_post_thumbnail($event_id)){
        $thumb_url = get_the_post_thumbnail_url($event_id, $image_size);
    } else {
        $thumb_url = get_template_directory_uri()."/assets/images/default_event.png";
    }

    return $thumb_url;

}
