/**
 * Yolo main javascript
 * 
 * @since 1.0.0
 */
import './scss/main.scss';
import {FooterWidgetToggleMobile} from './footer-widget-sidebar'

;((w, $) => {
  'use strict';
  //console.log(FooterWidgetToggleMobile);

  const ReadyHandle = () => {
    FooterWidgetToggleMobile(document.querySelectorAll('.footer-widgets.column-two .widget'));

  }

  /**
   * Dom Ready
   */

  $(ReadyHandle);

  /**
   * Anchor Menu
   */
  function AnchorActiveMenuItemScroll() {
    var sec_attr = [];

    if( $('body').hasClass('admin-bar') ) {
      var scroll_pos = $(window).scrollTop() + 33;
    } else {
      var scroll_pos = $(window).scrollTop() + 1;
    }
  
    $('.home .elementor-top-section').each(function(){
      sec_attr.push([$(this).attr('id'), $(this).offset().top]);
    });
  
    $.each(sec_attr, function( index, value ) {
      if(scroll_pos >= value[1] && scroll_pos < value[1] + $('#' + value[0]).innerHeight()){
        $('.archor-menu ul.menu > li').removeClass('current-menu-item');
        $('.archor-menu ul.menu > li > a[href="#' + value[0] +'"]').parent().addClass('current-menu-item');
      }
    });
  }

  /**
   * Back To Top
   */
	function BackToTop() {
		if ($('#site_backtop').length) {
			$('#site_backtop').on('click', function() {
				$('html,body').animate({
					scrollTop: 0
				}, 400);
				return false;
			});
			
		}
	}

  jQuery(document).ready(function($) {
    AnchorActiveMenuItemScroll();
    BackToTop();
  });

  jQuery(window).on('resize', function() {
		AnchorActiveMenuItemScroll();
	});

	jQuery(window).on('scroll', function() {
		AnchorActiveMenuItemScroll();
	});

})(window, jQuery)
