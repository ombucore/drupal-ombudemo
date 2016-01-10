(function ($) {

  Drupal.behaviors.bridgesMenu = {
    attach: function(context, settings) {
      var $region = $('[data-name="header"]', context);
      var $menuToggle = $('.menu-toggle', $region);
      var $topLink = $('.top-link', $region);

      // Scroll user to the top of the document on click of the top link.
      $topLink.on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({scrollTop: 0}, 500);
      });

      // Keep the top link hidden until the user scrolls a reasonable distance
      // down the page.
      var waypoint = new Waypoint({
        element: $('html').get(0),
        handler: function(direction) {
          $('html').toggleClass('show-top-link', (direction == 'down'));
        },
        offset: -30
      });

      $menuToggle.on('click', function(e) {
        e.preventDefault();
        $('html').toggleClass('menu-open');
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
