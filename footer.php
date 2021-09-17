<?php

$only_content_templates = array( 'template-only-content.php', 'template-full-width-only-content.php' );
$show_footer = apply_filters( 'chaplin_show_header_footer_on_only_content_templates', false );

// Don't output the markup of the footer on the only content templates, unless filtered to do so
if ( ! is_page_template( $only_content_templates ) || $show_footer ) : ?>
  <footer id="site-footer" role="contentinfo">
    <div class="section-inner">
      <div class="yolo-footer-widget">
        <?php if ( is_active_sidebar( 'footer-one' ) ) : ?>
          <div class="footer-widgets column-one grid-item">
            <?php dynamic_sidebar( 'footer-one' ); ?>
          </div>
        <?php endif; ?>

        <?php if ( is_active_sidebar( 'footer-two' ) ) : ?>
          <div class="footer-widgets column-two grid-item">
            <?php dynamic_sidebar( 'footer-two' ); ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </footer><!-- #site-footer -->
  <?php 
endif;
wp_footer(); 
?>
</body>
</html>
