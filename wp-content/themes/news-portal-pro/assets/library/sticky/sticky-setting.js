/*
 * Settings of the sticky menu
 */

jQuery(document).ready(function(){
   var wpAdminBar = jQuery('#wpadminbar');
   if (wpAdminBar.length) {
      jQuery("#masthead.default #np-menu-wrap,#masthead.layout1 .np-logo-section-wrapper,#masthead.layout2 #np-menu-wrap").sticky({topSpacing:wpAdminBar.height()});
   } else {
      jQuery("#masthead.default #np-menu-wrap,#masthead.layout1 .np-logo-section-wrapper,#masthead.layout2 #np-menu-wrap").sticky({topSpacing:0});
   }
});