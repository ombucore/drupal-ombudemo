/**
 * Ajax Chosen
 */
(function($) {
  return $.fn.ajaxChosen = function(settings, callback, chosenOptions) {
    var chosenXhr, defaultOptions, options, select;
    if (settings == null) {
      settings = {};
    }
    if (callback == null) {
      callback = {};
    }
    if (chosenOptions == null) {
      chosenOptions = function() {};
    }
    defaultOptions = {
      minTermLength: 3,
      afterTypeDelay: 500,
      jsonTermKey: "term",
      typing_placeholder: 'Keep typing...',
      searching_placeholder: 'Looking for ',
    };
    select = this;
    chosenXhr = null;
    options = $.extend({}, defaultOptions, $(select).data(), settings);
    this.chosen(chosenOptions ? chosenOptions : {});
    return this.each(function() {
      return $(this).next('.chosen-container').find(".search-field > input, .chosen-search > input").bind('keyup', function() {
        var field, msg, success, untrimmed_val, val;
        untrimmed_val = $(this).val();
        val = $.trim(untrimmed_val);
        msg = val.length < options.minTermLength ? options.typing_placeholder : options.searching_placeholder + val;
        select.next('.chosen-container').find('.no-results').text(msg);
        if (val === $(this).data('prevVal')) {
          return false;
        }
        $(this).data('prevVal', val);
        if (this.timer) {
          clearTimeout(this.timer);
        }
        if (val.length < options.minTermLength) {
          return false;
        }
        field = $(this);
        if (!(options.data != null)) {
          options.data = {};
        }
        // options.data[options.jsonTermKey] = val;
        if(!options.originalUrl) options.originalUrl = options.url;
        options.url = options.originalUrl + '/' + val;
        if (options.dataCallback != null) {
          options.data = options.dataCallback(options.data);
        }
        success = options.success;
        options.success = function(data) {
          var items, selected_values;
          if (!(data != null)) {
            return;
          }
          selected_values = [];
          select.find('optgroup').each(function() {
            return $(this).remove();
          });
          select.find('option').each(function() {
            if (!$(this).is(":selected")) {
              return $(this).remove();
            } else {
              return selected_values.push($(this).val() + "-" + $(this).text());
            }
          });
          items = callback(data);
          $.each(items, function(value, element) {
            var group;
            if (element.group) {
              group = $("<optgroup />").attr('label', element.text).appendTo(select);
              return $.each(element.items, function(value, text) {
                if ($.inArray(value + "-" + text, selected_values) === -1) {
                  return $("<option />").attr('value', value).html(text).appendTo(group);
                }
              });
            } else if ($.inArray(value + "-" + element, selected_values) === -1) {
              return $("<option />").attr('value', value).html(element).appendTo(select);
            }
          });
          select.trigger("chosen:updated");
          if (success != null) {
            success(data);
          }
          return field.attr('value', untrimmed_val);
        };
        return this.timer = setTimeout(function() {
          if (chosenXhr) {
            chosenXhr.abort();
          }
          return chosenXhr = $.ajax(options);
        }, options.afterTypeDelay);
      });
    });
  };
})(jQuery);
