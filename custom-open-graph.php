<?php
/**
 * Plugin Name: Custom Open Graph 
 * Description: Adds Open Graph tags to your WordPress site for better social media sharing.
 * Version: 1.0
 * Author: Arul T
 * Author URI: http://example.com
 */

function add_opengraph_tags() {
  global $post;

  // Set default values
  $og_image = get_stylesheet_directory_uri() . '/images/og-image.jpg';
  $og_title = get_bloginfo('name');
  $og_description = get_bloginfo('description');

  // If single post or page, use specific post information
  if (is_singular()) {
    if (has_post_thumbnail()) {
        $og_image = get_the_post_thumbnail_url($post->ID, 'large');
      }
    $og_title = get_the_title();
    $og_description = get_the_excerpt();

  }

  // Filter values
  $og_image = apply_filters('opengraph_image', $og_image);
  $og_title = apply_filters('opengraph_title', $og_title);
  $og_description = apply_filters('opengraph_description', $og_description);


  // Output tags
  echo '<meta property="og:image" content="' . esc_url($og_image) . '"/>';
  echo '<meta property="og:title" content="' . esc_attr($og_title) . '"/>';
  echo '<meta property="og:description" content="' . esc_attr($og_description) . '"/>';

}

add_action('wp_head', 'add_opengraph_tags');

