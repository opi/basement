// Prevent IE8 from bugging when a console.log call is left
if (!window.console) window.console = {};
if (!window.console.log) window.console.log = function () { };

(function ($, Drupal) {

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
        var firstLink = $(this).find('a').not('.contextual-links a').first(),
            dest = firstLink.attr('href'),
            blank = (firstLink.attr('target') == '_blank');
        if (dest && !blank) {
          window.location = dest
        }else if (blank){
          window.open(dest);
        };
      }
    })
    .css({cursor: 'pointer'});
  } // Drupal.basement.enlargeYourClick

  Drupal.basement.equalHeight = function(elements, extraHeight){
    var maxHeight = 0;
    extraHeight = extraHeight || 2;
    // Calculate optimal minHeight
    elements.once('equalHeight').css('minHeight', 0).each(function(){
      // get max height
      if ($(this).height() > maxHeight)
        maxHeight = $(this).height() + extraHeight;
    }).css('minHeight', maxHeight);
  } // Drupal.basement.equalHeight

  /** ********************************************************************
   * BEHAVIORS
   ** ***************************************************************** */

  Drupal.behaviors.basement = {
    attach: function(context, settings) {
      //$.extend(true, Drupal.settings, settings);

      // <html> js class
      $('html').removeClass('no-js') // addClass('js') is already done in misc/drupal.js

      /* Load images in placeholders */
      Drupal.basement.imagePlaceholder();

      /* Enlarge click zone */
      Drupal.basement.enlargeYourClick($('.example-selector'));

      /* Equal Height elements */
      $(window).load(function(){
        // Wait for images loadind
        Drupal.basement.equalHeight($('.example-parent-selector .example-children-selector'));
      });

      /* IE Specific script */
      if ($.browser.msie) {
        // IE9- scripts
        if(parseInt($.browser.version, 10) < 10) {
          $('input[placeholder], textarea[placeholder]').placeholder();
        }
      }

      // Trigger backspace to empty drupal date/hour field
      if (Drupal.settings.datePopup !== undefined) {
        for (var id in Drupal.settings.datePopup) {
         $('#'+id).bind('keyup', function(e){
           var code = (e.keyCode ? e.keyCode : e.which);
           if (code==46 || code==8) {
             $(this).val("");
           }
         })
        }
      }

    }
  } // Drupal.behaviors.basement

})(jQuery, Drupal);
