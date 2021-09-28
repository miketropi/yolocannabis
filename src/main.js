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

  function CustomSelectBox() {
    var x, i, j, l, ll, selElmnt, a, b, c;
    /* Look for any elements with the class "custom-select": */
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
      selElmnt = x[i].getElementsByTagName("select")[0];
      ll = selElmnt.length;
      /* For each element, create a new DIV that will act as the selected item: */
      a = document.createElement("DIV");
      a.setAttribute("class", "select-selected");
      a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      x[i].appendChild(a);
      /* For each element, create a new DIV that will contain the option list: */
      b = document.createElement("DIV");
      b.setAttribute("class", "select-items select-hide");
      for (j = 1; j < ll; j++) {
        /* For each option in the original select element,
        create a new DIV that will act as an option item: */
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
            /* When an item is clicked, update the original select box,
            and the selected item: */
            var y, i, k, s, h, sl, yl;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            sl = s.length;
            h = this.parentNode.previousSibling;
            for (i = 0; i < sl; i++) {
              if (s.options[i].innerHTML == this.innerHTML) {
                s.selectedIndex = i;
                h.innerHTML = this.innerHTML;
                y = this.parentNode.getElementsByClassName("same-as-selected");
                yl = y.length;
                for (k = 0; k < yl; k++) {
                  y[k].removeAttribute("class");
                }
                this.setAttribute("class", "same-as-selected");
                break;
              }
            }
            h.click();
        });
        b.appendChild(c);
      }
      x[i].appendChild(b);
      a.addEventListener("click", function(e) {
        /* When the select box is clicked, close any other select boxes,
        and open/close the current select box: */
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
      });
    }

    function closeAllSelect(elmnt) {
      /* A function that will close all select boxes in the document,
      except the current select box: */
      var x, y, i, xl, yl, arrNo = [];
      x = document.getElementsByClassName("select-items");
      y = document.getElementsByClassName("select-selected");
      xl = x.length;
      yl = y.length;
      for (i = 0; i < yl; i++) {
        if (elmnt == y[i]) {
          arrNo.push(i)
        } else {
          y[i].classList.remove("select-arrow-active");
        }
      }
      for (i = 0; i < xl; i++) {
        if (arrNo.indexOf(i)) {
          x[i].classList.add("select-hide");
        }
      }
    }

    /* If the user clicks anywhere outside the select box,
    then close all select boxes: */
    document.addEventListener("click", closeAllSelect);
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
    CustomSelectBox();
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
