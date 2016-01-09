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
    },
  };

})(jQuery);
