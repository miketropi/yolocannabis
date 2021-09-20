/**
 * Yolo main javascript
 * 
 * @since 1.0.0
 */
import './scss/main.scss';
import {FooterWidgetToggleMobile} from './footer-widget-sidebar'

;((w, $) => {
  'use strict';
  console.log(FooterWidgetToggleMobile);

  const ReadyHandle = () => {
    FooterWidgetToggleMobile(document.querySelectorAll('.footer-widgets.column-two .widget'));
  }

  /**
   * Dom Ready
   */
  $(ReadyHandle);
})(window, jQuery)