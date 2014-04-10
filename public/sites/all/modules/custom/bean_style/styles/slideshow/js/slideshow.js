(function ($) {
  Drupal.behaviors.beanStyleSlideshow = {
    attach: function(context, settings) {

      // Process each slideshow on page.
      for (var slideshow in settings.slideshow) {

        // Instantiate a slideshow.
        new Drupal.slideshow(slideshow, context, Drupal.settings.slideshow[slideshow]);
      }
    }
  }

  Drupal.slideshow = function(slideshow, context, opts) {

    // Get a handle to the slideshow.
    this.$slides = $('#' + slideshow, context);

    // Only process slideshows that have one or more slides.
    if ($(' > li', this.$slides).length > 1) {

      // Get a handle to the slideshow container and remember the slideshow
      // instance options.
      this.$slideshow = this.$slides.parent();
      this.opts = opts;

      // Instantiate jQuery Cycle 2 plugin.
      this.$slides.cycle(opts);

      // Pause the slideshow if the user clicks or hovers anywhere inside
      // its container element.
      this.$slideshow.on('click mouseover', $.proxy(function(e) {
        e.stopPropagation();
        this.$slides.cycle('pause');
      }, this));

      // Resize the iframe on load and when the browse window is resized.
      $(window).on('resize', $.proxy(function() {
        resizeVideo(this.$slideshow, this.$slideshow.find('.file-video iframe'));
      }, this));

      resizeVideo(this.$slideshow, this.$slideshow.find('.file-video iframe'));
    }
  }

  function resizeVideo($container, $video) {
    var aspectRatio = $video.attr('height') / $video.attr('width');
    var newWidth = $container.width();
    var newHeight = newWidth * aspectRatio;
    $video.attr('width', newWidth);
    $video.attr('height', newHeight);
  }
})(jQuery);
