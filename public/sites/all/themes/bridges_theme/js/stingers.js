(function ($) {

  Drupal.behaviors.bridgesStingers = {
    attach: function(context, settings) {

      // TODO: Replace ID with Stinger style class name.
      var $stinger = $('#block-bean-home-stinger-cta', context);

      // Only configure waypoints if a stinger CTA exists on the page.
      if ($stinger.length) {

        // Add an active class to the stinger as soon as it’s in view.
        var waypoint = new Waypoint({
          element: $stinger,
          handler: function(direction) {
            $stinger.addClass('arrived', (direction == 'down'));
          },
          offset: 'bottom-in-view'
        });
      }
    },
  };

})(jQuery);
