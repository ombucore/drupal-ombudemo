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

      // Configure anchor links to scroll smoothly.
      $('a[href*=#]').on('click', function(e) {
        e.preventDefault();
        var href = $(this).attr('href');
        var selector = href.substring(href.indexOf('#'), href.length);
        var top = parseInt($(selector).offset().top) - 53;
        var height = $(document).height();
        var distance = $(window).scrollTop() - top;
        var factor = Math.abs(distance / height) * 1.2;

        $('html, body').animate({
          scrollTop: top
        }, 1500 * factor);
      });

      // If page section navigation is present, add sticky behavior.
      if ($('#tiles-section-navigation').length) {
        var waypoint = new Waypoint({
          element: $('#block-system-main').get(0),
          handler: function(direction) {
            $('html').toggleClass('fix-section-nav', (direction == 'down'));
          },
          offset: 63
        });
      }
    },
  };

})(jQuery);
