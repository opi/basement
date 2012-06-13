(function ($) {

  /** ********************************************************************
   * INIT
   ** ***************************************************************** */

  Drupal.basement = Drupal.basement || {}
  Drupal.settings.basement = Drupal.settings.basement || {}


  /** ********************************************************************
   * FUNCTIONS
   ** ***************************************************************** */

  Drupal.basement.imagePlaceholder = function(){
    $('.image-placeholder').once('image-placeholder').each(function(){
      $(this).replaceWith( $('<img/>')
        .attr('src', $(this).data('src'))
        .attr('alt', $(this).data('alt'))
        .attr('title', $(this).data('title'))
      );
    });
  } // Drupal.basement.imagePlaceholder

  // Enlarge Your Click Zone : allow link'parent element to be clickable too
  Drupal.basement.enlargeYourClick = function(selector){
    $(selector).once('enlargeYourClick').click(function(e){
      // don't handle if user click on a link, or if he click with mouse wheel
      if (e.target.tagName != "A" && e.button != 1) {
        var dest = $(this).find('a:first').attr('href');
        if (dest) {window.location = dest};
      }
    })
    .css({cursor: 'pointer'});
  } // Drupal.basement.enlargeYourClick


  /** ********************************************************************
   * BEHAVIORS
   ** ***************************************************************** */

  Drupal.behaviors.basement = {
    attach: function(context, settings) {
      //$.extend(true, Drupal.settings, settings);


      /* Load images in placeholders */
      Drupal.basement.imagePlaceholder();

      /* Enlarge click zone */
      Drupal.basement.enlargeYourClick($('.node-teaser'));


      /* IE Specific script */
      if ($.browser.msie) {
        // IE9- scripts
        if(parseInt($.browser.version, 10) < 10) {
          $('input[placeholder], textarea[placeholder]').placeholder();
        }
      }

    }
  } // Drupal.behaviors.basement

})(jQuery);
