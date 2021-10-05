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
   * Custom Select Box
   */
  function CustomSelectBox() {
    $('.custom-select select').select2({
      minimumResultsForSearch: Infinity
    });
  }

  /**
   * Get Age
   */
  function getAge(dateString) {
    var today = new Date();
    var birthDate = new Date(dateString);
    var age = today.getFullYear() - birthDate.getFullYear();
    var m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        age--;
    }
    return age;
  }
  /**
   * Age gate form
   */
  function AgeGateForm() {
    $('#custom_location').select2({
      minimumResultsForSearch: Infinity
    });

    $('form.age-gate-form').find('input[type="checkbox"]').parent().append('<span class="status"></span>');

    $('.age-gate-form-elements input').change(function(){
      var age_d = $(this).parents('.age-gate-form').find('#age-gate-d').val(),
          age_m = $(this).parents('.age-gate-form').find('#age-gate-m').val(),
          age_y = $(this).parents('.age-gate-form').find('#age-gate-y').val(),
          age = getAge(age_d + '/' + age_m + '/' + age_y),
          location = $('#custom_location').val();

      if( 'QC' === location ) {
        if( 21 > age ) {
          $('div[data-error-field="age_gate_failed"]').addClass('has-error');
          $('div[data-error-field="age_gate_failed"]').show();
          $('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>');
        } else {
          $('div[data-error-field="age_gate_failed"]').hide();
        }
      } else {
        if( 19 > age ) {
          $('div[data-error-field="age_gate_failed"]').addClass('has-error');
          $('div[data-error-field="age_gate_failed"]').show();
          $('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>');
        } else {
          $('div[data-error-field="age_gate_failed"]').hide();
        }
      }
    });

    $('#custom_location').change(function(){
      var age_d = $(this).parents('.age-gate-form').find('#age-gate-d').val(),
          age_m = $(this).parents('.age-gate-form').find('#age-gate-m').val(),
          age_y = $(this).parents('.age-gate-form').find('#age-gate-y').val(),
          age = getAge(age_d + '/' + age_m + '/' + age_y),
          location = $(this).val();
      
      if( '' === location ) {
        $(this).parent().find('.location-error').addClass('has-error');
        $(this).parent().find('.location-error').html('<p class="location-error-message">Please select province</p>');
        $(this).parent().find('.location-error').show();

        if( 19 > age ) {
          $('div[data-error-field="age_gate_failed"]').addClass('has-error');
          $('div[data-error-field="age_gate_failed"]').show();
          $('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>');
        } else {
          $('div[data-error-field="age_gate_failed"]').hide();
        }
        
      } else {
        $(this).parent().find('.location-error').hide();

        if( 'QC' === location ) {
          $('.custom-field-term b').html('21');
  
          if( 21 > age ) {
            $('div[data-error-field="age_gate_failed"]').addClass('has-error');
            $('div[data-error-field="age_gate_failed"]').show();
            $('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>');
          } else {
            $('div[data-error-field="age_gate_failed"]').hide();
          }
        } else {
          $('.custom-field-term b').html('19');
  
          if( 19 > age ) {
            $('div[data-error-field="age_gate_failed"]').addClass('has-error');
            $('div[data-error-field="age_gate_failed"]').show();
            $('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>');
          } else {
            $('div[data-error-field="age_gate_failed"]').hide();
          }
        }
      }
    });

    $('.custom-field-term input').change(function(){
      if(true === $(this)[0].checked) {
        $(this).parents('.age-gate-form').find('.term-error').hide();
      } else {
        $(this).parents('.age-gate-form').find('.term-error').addClass('has-error');
        $(this).parents('.age-gate-form').find('.term-error').html('<p class="term-error-message">The field is required</p>');
        $(this).parents('.age-gate-form').find('.term-error').show();
      }
    });
    
    $('form.age-gate-form').submit(function( event ) {
      event.preventDefault();
      
      var location_validate = false,
          term_validate = false,
          age_d = $(this).find('#age-gate-d').val(),
          age_m = $(this).find('#age-gate-m').val(),
          age_y = $(this).find('#age-gate-y').val(),
          age = getAge(age_d + '/' + age_m + '/' + age_y),
          location = $(this).find('.custom-field-location select').val();

      if('' === location) {
        $(this).find('.location-error').addClass('has-error');
        $(this).find('.location-error').html('<p class="location-error-message">Please select province</p>');
        $(this).find('.location-error').show();

        if(19 > age) {
          $(this).find('div[data-error-field="age_gate_failed"]').addClass('has-error');
          $(this).find('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>');
          $(this).find('div[data-error-field="age_gate_failed"]').show();
        } else {
          $(this).find('div[data-error-field="age_gate_failed"]').removeClass('has-error');
          $(this).find('div[data-error-field="age_gate_failed"]').html('');
          $(this).find('div[data-error-field="age_gate_failed"]').hide();
        }

        location_validate = false;
      } else {
        $(this).find('.location-error').removeClass('has-error');
        $(this).find('.location-error').html('');
        $(this).find('.location-error').hide();

        if('QC' === location) {
          $(this).find('.custom-field-term .age-gate').html('21');

          if(21 > age) {
            $(this).find('div[data-error-field="age_gate_failed"]').addClass('has-error');
            $(this).find('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>');
            $(this).find('div[data-error-field="age_gate_failed"]').show();
  
            location_validate = false;
          } else {

            location_validate = true;
          }
        } else {
          $(this).find('.custom-field-term .age-gate').html('19');

          if(19 > age) {
            $(this).find('div[data-error-field="age_gate_failed"]').addClass('has-error');
            $(this).find('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>');
            $(this).find('div[data-error-field="age_gate_failed"]').show();
  
            location_validate = false;
          } else {

            location_validate = true;
          }
        }
      }

      if( true === $(this).find('.custom-field-term input')[0].checked ) {
        $(this).find('.term-error').removeClass('has-error');
        $(this).find('.term-error').html('');
        $(this).find('.term-error').hide();
        term_validate = true;
      } else {
        $(this).find('.term-error').addClass('has-error');
        $(this).find('.term-error').html('<p class="term-error-message">The field is required</p>');
        $(this).find('.term-error').show();
        term_validate = false;
      }
      
      if( true === location_validate && true == term_validate ) {
        return true;
      } else {
        return false;
      }
    });
  }

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
   * Anchor Term Scroll
   */
   function AnchorTermScroll() {
    var sec_attr = [];

    if( $('body').hasClass('admin-bar') ) {
      var scroll_pos = $(window).scrollTop() + 33;
    } else {
      var scroll_pos = $(window).scrollTop() + 1;
    }
    
    $('#terms_of_service_section .terms-heading').each(function(){
      sec_attr.push([$(this).attr('id'), $(this).offset().top]);
    });

    $.each(sec_attr, function( index, value ) {
      if(scroll_pos >= value[1] && scroll_pos < value[1] + $('#' + value[0]).innerHeight()){
        $('.elementor-icon-list-items > li').removeClass('current');
        $('.elementor-icon-list-items > li > a[href="#' + value[0] +'"]').parent().addClass('current');
      }
    });
  }

  /**
   * Product Field Redirect
   */
  function ProductFieldRedirect() {
    $('#product_field').change(function(){
      var current_url = document.location.origin;

      window.location.href = current_url + '/product/' + $(this).val() + '/';
    });
    
  }

  /**
   * VariationAddToCart
   */
   function VariationAddToCart() {

    $('.woo-product-item .add_to_cart_button').on('click', function(event) {
      event.preventDefault();

      $(this).parents('.woo-product-item').addClass('form-cart-enable');
    });

    $('.woo-product-item .close').on('click', function(event) {
      event.preventDefault();
      
      $(this).parents('.woo-product-item').removeClass('form-cart-enable');
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
    $('.elementor-icon-list-items > li:first-child').addClass('current');
    
    CustomSelectBox();
    AgeGateForm();
    AnchorActiveMenuItemScroll();
    AnchorTermScroll();
    ProductFieldRedirect();
    VariationAddToCart();

    BackToTop();
    
  });

  jQuery(window).on('resize', function() {
		AnchorActiveMenuItemScroll();
    AnchorTermScroll();
	});

	jQuery(window).on('scroll', function() {
		AnchorActiveMenuItemScroll();
    AnchorTermScroll();
	});
 
})(window, jQuery)
