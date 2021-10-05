!function(){"use strict";var e={907:function(e,t){Object.defineProperty(t,"__esModule",{value:!0}),t.FooterWidgetToggleMobile=void 0,t.FooterWidgetToggleMobile=function(e){e&&0!=e.length&&e.forEach((function(e,t){e.classList.add("widget-toggle-mobile");var a=e.querySelector("h2.widget-title"),r=document.createElement("span");r.classList.add("toggle-arrow"),r.innerHTML="▾",a.appendChild(r),a.addEventListener("click",(function(t){t.preventDefault(),e.classList.toggle("widget-toggle-mobile--open")}))}))}},80:function(e,t,a){a.r(t)}},t={};function a(r){var i=t[r];if(void 0!==i)return i.exports;var o=t[r]={exports:{}};return e[r](o,o.exports,a),o.exports}a.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},function(){a(80);var e=a(907);!function(t,a){function r(){a(".custom-select select").select2({minimumResultsForSearch:1/0})}function i(e){var t=new Date,a=new Date(e),r=t.getFullYear()-a.getFullYear(),i=t.getMonth()-a.getMonth();return(i<0||0===i&&t.getDate()<a.getDate())&&r--,r}function o(){a("#custom_location").select2({minimumResultsForSearch:1/0}),a("form.age-gate-form").find('input[type="checkbox"]').parent().append('<span class="status"></span>'),a(".age-gate-form-elements input").change((function(){var e=i(a(this).parents(".age-gate-form").find("#age-gate-d").val()+"/"+a(this).parents(".age-gate-form").find("#age-gate-m").val()+"/"+a(this).parents(".age-gate-form").find("#age-gate-y").val());"QC"===a("#custom_location").val()?21>e?(a('div[data-error-field="age_gate_failed"]').addClass("has-error"),a('div[data-error-field="age_gate_failed"]').show(),a('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>')):a('div[data-error-field="age_gate_failed"]').hide():19>e?(a('div[data-error-field="age_gate_failed"]').addClass("has-error"),a('div[data-error-field="age_gate_failed"]').show(),a('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>')):a('div[data-error-field="age_gate_failed"]').hide()})),a("#custom_location").change((function(){var e=i(a(this).parents(".age-gate-form").find("#age-gate-d").val()+"/"+a(this).parents(".age-gate-form").find("#age-gate-m").val()+"/"+a(this).parents(".age-gate-form").find("#age-gate-y").val()),t=a(this).val();""===t?(a(this).parent().find(".location-error").addClass("has-error"),a(this).parent().find(".location-error").html('<p class="location-error-message">Please select province</p>'),a(this).parent().find(".location-error").show(),19>e?(a('div[data-error-field="age_gate_failed"]').addClass("has-error"),a('div[data-error-field="age_gate_failed"]').show(),a('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>')):a('div[data-error-field="age_gate_failed"]').hide()):(a(this).parent().find(".location-error").hide(),"QC"===t?(a(".custom-field-term b").html("21"),21>e?(a('div[data-error-field="age_gate_failed"]').addClass("has-error"),a('div[data-error-field="age_gate_failed"]').show(),a('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>')):a('div[data-error-field="age_gate_failed"]').hide()):(a(".custom-field-term b").html("19"),19>e?(a('div[data-error-field="age_gate_failed"]').addClass("has-error"),a('div[data-error-field="age_gate_failed"]').show(),a('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>')):a('div[data-error-field="age_gate_failed"]').hide()))})),a(".custom-field-term input").change((function(){!0===a(this)[0].checked?a(this).parents(".age-gate-form").find(".term-error").hide():(a(this).parents(".age-gate-form").find(".term-error").addClass("has-error"),a(this).parents(".age-gate-form").find(".term-error").html('<p class="term-error-message">The field is required</p>'),a(this).parents(".age-gate-form").find(".term-error").show())})),a("form.age-gate-form").submit((function(e){e.preventDefault();var t=!1,r=!1,o=i(a(this).find("#age-gate-d").val()+"/"+a(this).find("#age-gate-m").val()+"/"+a(this).find("#age-gate-y").val()),d=a(this).find(".custom-field-location select").val();return""===d?(a(this).find(".location-error").addClass("has-error"),a(this).find(".location-error").html('<p class="location-error-message">Please select province</p>'),a(this).find(".location-error").show(),19>o?(a(this).find('div[data-error-field="age_gate_failed"]').addClass("has-error"),a(this).find('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>'),a(this).find('div[data-error-field="age_gate_failed"]').show()):(a(this).find('div[data-error-field="age_gate_failed"]').removeClass("has-error"),a(this).find('div[data-error-field="age_gate_failed"]').html(""),a(this).find('div[data-error-field="age_gate_failed"]').hide()),t=!1):(a(this).find(".location-error").removeClass("has-error"),a(this).find(".location-error").html(""),a(this).find(".location-error").hide(),"QC"===d?(a(this).find(".custom-field-term .age-gate").html("21"),21>o?(a(this).find('div[data-error-field="age_gate_failed"]').addClass("has-error"),a(this).find('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>'),a(this).find('div[data-error-field="age_gate_failed"]').show(),t=!1):t=!0):(a(this).find(".custom-field-term .age-gate").html("19"),19>o?(a(this).find('div[data-error-field="age_gate_failed"]').addClass("has-error"),a(this).find('div[data-error-field="age_gate_failed"]').html('<p class="age-gate-error-message">You are not old enough to view this content</p>'),a(this).find('div[data-error-field="age_gate_failed"]').show(),t=!1):t=!0)),!0===a(this).find(".custom-field-term input")[0].checked?(a(this).find(".term-error").removeClass("has-error"),a(this).find(".term-error").html(""),a(this).find(".term-error").hide(),r=!0):(a(this).find(".term-error").addClass("has-error"),a(this).find(".term-error").html('<p class="term-error-message">The field is required</p>'),a(this).find(".term-error").show(),r=!1),!0===t&&1==r}))}function d(){var e=[];if(a("body").hasClass("admin-bar"))var t=a(window).scrollTop()+33;else t=a(window).scrollTop()+1;a(".home .elementor-top-section").each((function(){e.push([a(this).attr("id"),a(this).offset().top])})),a.each(e,(function(e,r){t>=r[1]&&t<r[1]+a("#"+r[0]).innerHeight()&&(a(".archor-menu ul.menu > li").removeClass("current-menu-item"),a('.archor-menu ul.menu > li > a[href="#'+r[0]+'"]').parent().addClass("current-menu-item"))}))}function n(){var e=[];if(a("body").hasClass("admin-bar"))var t=a(window).scrollTop()+33;else t=a(window).scrollTop()+1;a("#terms_of_service_section .terms-heading").each((function(){e.push([a(this).attr("id"),a(this).offset().top])})),a.each(e,(function(e,r){t>=r[1]&&t<r[1]+a("#"+r[0]).innerHeight()&&(a(".elementor-icon-list-items > li").removeClass("current"),a('.elementor-icon-list-items > li > a[href="#'+r[0]+'"]').parent().addClass("current"))}))}function s(){a("#product_field").change((function(){var e=document.location.origin;window.location.href=e+"/product/"+a(this).val()+"/"}))}function l(){a(".woo-product-item").on("select2:open",(function(e){a(this).addClass("current")})),a(".woo-product-item").on("select2:close",(function(e){a(this).removeClass("current")})),a(".woo-variation-add-to-cart").on("click",(function(e){e.preventDefault(),a(this).parents(".woo-product-item").find(".single_add_to_cart_button").click()}))}function f(){a("#site_backtop").length&&a("#site_backtop").on("click",(function(){return a("html,body").animate({scrollTop:0},400),!1}))}a((function(){(0,e.FooterWidgetToggleMobile)(document.querySelectorAll(".footer-widgets.column-two .widget"))})),jQuery(document).ready((function(e){e(".elementor-icon-list-items > li:first-child").addClass("current"),r(),o(),d(),n(),s(),l(),f()})),jQuery(window).on("resize",(function(){d(),n()})),jQuery(window).on("scroll",(function(){d(),n()}))}(window,jQuery)}()}();