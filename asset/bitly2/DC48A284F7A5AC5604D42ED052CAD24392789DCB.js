(function() {
    if (window.BITLY == null) {
      window.BITLY = {};
    }
  
    (function(BITLY) {
      BITLY.post = function(url, data, settings) {
        if (data == null) {
          data = {};
        }
        if (settings == null) {
          settings = {};
        }
        return BITLY.request.call(BITLY.request, url, data, _.defaults({
          type: 'POST'
        }, settings));
      };
      BITLY.get = function(url, data, settings) {
        if (data == null) {
          data = {};
        }
        if (settings == null) {
          settings = {};
        }
        return BITLY.request.call(BITLY.request, url, data, _.defaults({
          type: 'GET'
        }, settings));
      };
      return BITLY.request = function(url, data, settings) {
        var context, error, response, success, xhr, _ref;
        response = $.Deferred();
        context = (_ref = settings.context) != null ? _ref : this;
        success = settings.success;
        error = settings.error;
        delete settings.success;
        delete settings.error;
        xhr = $.ajax(url, _.extend({
          beforeSend: function(xhr) {
            if ($.cookie) {
              xhr.setRequestHeader("X-XSRFToken", $.cookie.get("_xsrf"));
            }
            if (window.Bitmarklet) {
              if (!window.Bitmarklet.is_chrome) {
                return xhr.setRequestHeader("X-Bitly-Client", "bitmarklet");
              }
            }
          },
          data: data
        }, settings));
        xhr.fail(function() {
          if (error) {
            error.apply(context, arguments);
          }
          return response.reject.apply(context, arguments);
        });
        xhr.done(function(res, resText, jqXHR) {
          if (success) {
            success.apply(context, arguments);
          }
          return response.resolve.apply(context, arguments);
        });
        return response.promise();
      };
    })(BITLY);
  
  }).call(this);