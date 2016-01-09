(function ($) {

  Drupal.behaviors.bridgesSearch = {
    attach: function(context, settings) {
      var $tile = $('#block-search-form', context);
      var $input = $('input[name="search_block_form"]', $tile);

      console.log($input);

      $input.on('focus', function(e) {
        $tile.addClass('focused');
        return false;
      });

      $input.on('blur', function(e) {
        $tile.removeClass('focused');
        return false;
      });
    },
  };

})(jQuery);
