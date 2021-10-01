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

  require(YOLO_DIR . '/woocommerce/hooks.php');
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
    'select2',
    YOLO_URI . '/src/select2.min.css',
    false,
    $randomVersion // wp_get_theme()->get('Version')
  );

  wp_enqueue_script(
    'select2',
    YOLO_URI . '/src/select2.min.js',
    ['jquery'],
    $randomVersion, // wp_get_theme()->get('Version'),
    true
  );

  wp_enqueue_style(
    'yolo',
    YOLO_URI . '/dist/css/frontend-yolo.bundle.css',
    false,
    $randomVersion // wp_get_theme()->get('Version')
  );

  wp_enqueue_script(
    'yolo',
    YOLO_URI . '/dist/frontend-yolo.bundle.js',
    ['jquery'],
    $randomVersion, // wp_get_theme()->get('Version'),
    true
  );
}

add_action('wp_enqueue_scripts', 'YoloEnqueueScripts');

function yolo_sidebar_registration() {

  // Arguments used in all register_sidebar() calls
  $shared_args = [
    'before_title'  => '<h2 class="widget-title subheading heading-size-3">',
    'after_title'   => '</h2>',
    'before_widget' => '<div class="widget %2$s"><div class="widget-content">',
    'after_widget'  => '</div></div>',
  ];

  // Footer copyright
  register_sidebar( array_merge(
    $shared_args, [
      'name' 		=> __( 'Footer Copyright', 'yolo' ),
      'id' 			=> 'footer-copyright',
      'description' 	=> __( 'Widgets in this area will be displayed in the bottom of footer.', 'chaplin' ),
    ] )
  );
}

add_action( 'widgets_init', 'yolo_sidebar_registration' );

function yolo_add_woocommerce_support() {
  // Theme support woocommerce
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'yolo_add_woocommerce_support' );