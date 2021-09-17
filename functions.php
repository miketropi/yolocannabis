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
  $parentHandle = 'chaplin-style';
  $randomVersion = rand(0, 99999); // avoid browser caching static file

  # Yolo childtheme
  wp_enqueue_style( 
    'yolo-style', 
    get_stylesheet_uri(),
    [$parentHandle], 
    wp_get_theme()->get('Version')
  );

  wp_enqueue_style(
    'yolo',
    YOLO_URI . '/dist/css/frontend-yolo.bundle.css',
    false,
    $random // wp_get_theme()->get('Version')
  );

  wp_enqueue_script(
    'yolo',
    YOLO_URI . '/dist/frontend-yolo.bundle.js',
    ['jquery'],
    $random, // wp_get_theme()->get('Version'),
    true
  );
}

add_action('wp_enqueue_scripts', 'YoloEnqueueScripts');