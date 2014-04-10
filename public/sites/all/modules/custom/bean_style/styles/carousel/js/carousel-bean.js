(function ($) {

  Drupal.behaviors.carouselBean = {
    attach: function(context, settings) {
      // Instantiate this bean.
      new Drupal.carouselBean($('.bean-style-carousel', context));
    }
  };

  Drupal.carouselBean = function($bean) {
    // Remember this calendar's DOM node.
    this.$bean = $bean;

    // Remember the number of items in this carousel.
    this.countItems = $('ul.results > li:not(.spacer)', this.$bean).length;

    // Add previous and next links.
    $bean.prepend('<ul class="prevnext"><li class="previous"><a><span>Previous</span></a></li><li class="next"><a><span>Next</span></a></li></ul>');

    // Set up click handlers for next and previous.
    $('.prevnext .next a', $bean).click($.proxy(this.go, this, 'next'));
    $('.prevnext .previous a', $bean).click($.proxy(this.go, this, 'previous'));

    // Set up swipe handlers for next and previous.
    // Refs #6574: Disabling swipe event handlers.
    // jQuery($bean).on('swipeleft', $.proxy(this.go, this, 'next'));
    // jQuery($bean).on('swiperight', $.proxy(this.go, this, 'previous'));

    // If an active index has been provided via the data-index-active data
    // attribute in the markup, activate the bean to that item.  Otherwise,
    // default to the first item.
    if (!$bean.attr('data-index-active')) {
      $bean.attr('data-index-active', 0)
    }

    // Initialize metrics for the carousel and its items.
    this.init();

    // Reinitialize on window resize.
    $(window).on('debouncedresize', $.proxy(function() {
      setTimeout($.proxy(function() {
        this.init();
      }, this), 500);
    }, this));
  }

  Drupal.carouselBean.prototype.init = function() {

    // Determine the number of items that should be visible by calculating
    // the percentage width of the spacer list item relative to the parent
    // list element. These widths are set as percentages in the CSS.  The
    // rounded reciprocal of the result will be the visible number of items.
    var widthList = parseInt($('ul.results', this.$bean).css('width'));
    var widthItem = parseInt($('ul.results > li.spacer', this.$bean).css('width'));
    this.numVisible = Math.round(1 / (widthItem / widthList));

    // Remember how many items should be incremented at once.
    this.numIncrement = 1;

    // Remember how wide an inactive element is, as a percentage
    // of the total bean width.  This will be used to reposition the
    // list element so that the first active item aligns with the left
    // edge of the grid.
    this.widthInactive = (0.8 * 1 / this.numVisible) * 100;

    // Activate the initial item.
    this.activateItem(this.$bean.attr('data-index-active'));
  }

  Drupal.carouselBean.prototype.go = function(direction, e) {
    e.preventDefault();
    e.stopPropagation();

    // Find our scroll target, based on the visible number of days and
    // the given direction.
    var indexCur = parseInt(this.$bean.attr('data-index-active'));
    var indexOffset = (direction == 'next') ? (this.numIncrement) : (-1 * this.numIncrement);
    var indexTarget = indexCur + indexOffset;

    // Don't go backwards past the first item.
    if (indexTarget < 0) return false;

    // Don't go forward past the last set of visible items.
    if ((indexTarget + this.numVisible) > this.countItems) return false;

    // Activate the target item.
    this.activateItem(indexTarget);
  }

  Drupal.carouselBean.prototype.activateItem = function(index) {

    // Make sure the index is treated as an integer.
    index = parseInt(index);

    // Set bean data attribute for target item.
    this.$bean.attr('data-index-active', index);

    // Get handle to target item.
    var $item = this.$bean.find('ul.results > li').eq(index);

    // Remove active class on all items.
    $('ul.results > li', this.$bean).removeClass('active touched');

    // Set active class on visible items.
    var i = 0;
    while (i < this.numVisible) {
      $('ul.results > li', this.$bean).eq(index + i++).addClass('active');
    }

    // Reposition the list element so that first active item lines up with
    // the left edge of the grid.
    $('ul.results', this.$bean).css('left', (-1 * this.widthInactive * index) + '%');

    // If the last item has been activated, set a class so that elements
    // can be styled appropriately (e.g., the next link should be disabled).
    if ((index + this.numVisible) >= this.countItems) {
      this.$bean.addClass('at-end');
    } else {
      this.$bean.removeClass('at-end');
    }
  }

  // jQuery(window).on('swipeleft', function(e) {
  //   alert('Swiped left');
  // });

})(jQuery);
