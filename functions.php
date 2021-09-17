<?php 
/**
 * Theme Functions
 */

{
  /**
   * Define 
   */
  define('YOLO_VERSION', '1.0.0');
  define('YOLO_DIR', get_stylesheet_directory(__FILE__));
  define('YOLO_URI', get_stylesheet_directory_uri(__FILE__));
}

{
  /**
   * Includes 
   */
  require(YOLO_DIR . '/inc/hooks.php');
  require(YOLO_DIR . '/inc/helpers.php');
  require(YOLO_DIR . '/inc/template-tags.php');
  require(YOLO_DIR . '/inc/ajax.php');
}

function YoloEnqueueScripts() {
  $theme = wp_get_theme();
  $parentHandle = 'chaplin-style';;

  # Yolo childtheme
  wp_enqueue_style( 
    'yolo-style', 
    get_stylesheet_uri(),
    [$parentHandle], 
    wp_get_theme()->get('Version')
  );
}

add_action('wp_enqueue_scripts', 'YoloEnqueueScripts');