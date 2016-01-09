(function ($) {

  Drupal.behaviors.bridgesMenu = {
    attach: function(context, settings) {
      var $region = $('[data-name="header"]', context);
      var $menuToggle = $('.menu-toggle', $region);

      $menuToggle.on('click', function(e) {
        e.preventDefault();
        $('body').toggleClass('menu-open');
        $nestedMenus.find('.opened').removeClass('opened');
        return false;
      });

      // Compress the header after the user has scrolled down the page.
      var waypointDown = new Waypoint({
        element: $('html').get(0),
        handler: function(direction) {
          $('html').toggleClass('compressed-header', (direction == 'down'));
        },
        offset: -1
      });
    },
  };

})(jQuery);
