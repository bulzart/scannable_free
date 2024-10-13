(function() {
    var PLACEHOLDER_SUPPORT, cache, computedStyle, ex, _ref;
  
    try {
      PLACEHOLDER_SUPPORT = !!("placeholder" in document.createElement("input"));
    } catch (_error) {
      ex = _error;
      PLACEHOLDER_SUPPORT = false;
    }
  
    computedStyle = (_ref = window.getComputedStyle) != null ? _ref : function(el) {
      return el.currentStyle;
    };
  
    cache = {};
  
    window.App || (window.App = {});
  
    App.Lib || (App.Lib = {});
  
    App.Lib.PlaceholderShim = (function() {
      function PlaceholderShim(el, options) {
        if (options == null) {
          options = {};
        }
        this.el = $(el);
        if (!this.el.length) {
          return;
        }
        this.options = options;
        this.state = {};
        this.orig_text = this.text = options.text || this.el.attr("placeholder");
        this.id = "ph_" + parseInt(Math.random() * (+new Date()) * 1000, 10);
        this.container = $(document.createElement("b")).attr("id", this.id);
        this.container.get(0).className = "ph_shim";
        if (PLACEHOLDER_SUPPORT) {
          return;
        }
        this.setStyles();
        this.bindEvents();
        this.checkLength();
        this.insertContainer();
      }
  
      PlaceholderShim.prototype.insertContainer = function() {
        this.container.insertBefore(this.el);
        return this.container.append(this.el.detach());
      };
  
      PlaceholderShim.prototype.bindEvents = function() {
        var _this = this;
        this.el.bind("keyup.ph", function(e) {
          return _this.checkLength();
        });
        this.el.bind("keydown.ph", function(e) {
          if (_this.state.empty && e.keyCode >= 48 && !e.metaKey) {
            return _this.hide();
          }
        });
        this.el.bind("paste.ph", function(e) {
          return setTimeout(function() {
            return _this.checkLength();
          });
        });
        this.el.bind("focus.ph", function(e) {
          return setTimeout(function() {
            return _this.checkLength();
          });
        });
        this.el.bind("blur.ph", function(e) {
          if (_this.state.noblur) {
            return _this.checkLength();
          }
        });
        this.container.bind("click.ph", function(e) {
          return _this.el.focus();
        });
        this.container.bind("mousedown.ph", function(e) {
          if (_this.isFocused()) {
            _this.state.noblur = true;
            if (_this.state.empty) {
              return e.preventDefault();
            }
          }
        });
        return this;
      };
  
      PlaceholderShim.prototype.hide = function() {
        var _ref1;
        if (!this.state.empty) {
          return this;
        }
        delete this.state.empty;
        this.container.removeClass("empty");
        if ((_ref1 = this.options.onhide) != null) {
          _ref1.call(null);
        }
        return this;
      };
  
      PlaceholderShim.prototype.show = function() {
        var _ref1;
        if (this.state.empty) {
          return this;
        }
        this.state.empty = true;
        this.container.addClass("empty");
        if ((_ref1 = this.options.onshow) != null) {
          _ref1.call(null);
        }
        return this;
      };
  
      PlaceholderShim.prototype.checkLength = function() {
        if (!this.el.val() || this.el.val().length === 0) {
          if (!this.options.focus_only) {
            this.show();
          } else {
            if (this.isFocused()) {
              this.show();
            } else {
              this.hide();
            }
          }
        } else {
          this.hide();
        }
        delete this.state.noblur;
        return this;
      };
  
      PlaceholderShim.prototype.isFocused = function() {
        return this.el[0] === document.activeElement;
      };
  
      PlaceholderShim.prototype.setText = function(text) {
        var sel, styles;
        if (text == null) {
          text = this.orig_text;
        }
        this.text = text;
        if (PLACEHOLDER_SUPPORT) {
          this.el.attr("placeholder", text);
        } else {
          sel = "#" + this.id + ".empty:after";
          styles = {};
          styles[sel] = {
            content: "'" + this.text + "'"
          };
          this.css(styles);
        }
        return this;
      };
  
      PlaceholderShim.prototype.setStyles = function() {
        var selector, specific_styles, styles;
        styles = {};
        selector = "#" + this.id;
        specific_styles = {};
        if (this.options.group) {
          if (!cache.hasOwnProperty(this.options.group)) {
            cache[this.options.group] = this.setSpecificStyles();
          }
          specific_styles = cache[this.optins.group];
        } else {
          specific_styles = this.setSpecificStyles();
        }
        styles[selector] = {
          'display': this.el.css("display") || 'inline-block',
          'position': 'relative'
        };
        if (styles[selector]['display'] === 'inline') {
          styles[selector]["display"] = "inline-block";
        }
        selector = "" + selector + ".empty:after";
        styles[selector] = $.extend({
          'font-weight': 'normal',
          'font-size': '13px',
          'display': 'block',
          'content': "'" + this.text + "'",
          'position': 'absolute',
          'top': '0',
          'left': '0',
          'right': '0',
          'bottom': '0',
          'opacity': '.8',
          'text-indent': '1px',
          'background-color': 'transparent',
          'border-color': 'transparent',
          'border-style': 'solid',
          'color': '#AAA',
          'text-align': 'left'
        }, specific_styles, this.options.css || {});
        this.css(styles);
        return this;
      };
  
      PlaceholderShim.prototype.setSpecificStyles = function() {
        var border_width, el_styles, styles;
        el_styles = computedStyle(this.el.get(0), null);
        styles = {
          'line-height': el_styles['lineHeight'],
          'padding-top': el_styles['paddingTop'],
          'padding-left': el_styles['paddingLeft'],
          'padding-right': el_styles['paddingRight'],
          'padding-bottom': el_styles['paddingBottom'],
          'margin-top': el_styles['marginTop'],
          'margin-left': el_styles['marginLeft'],
          'margin-right': el_styles['marginRight'],
          'margin-bottom': el_styles['marginBottom'],
          'font-size': el_styles['fontSize']
        };
        border_width = '0px';
        try {
          border_width = el_styles['borderWidth'] || '0px';
        } catch (_error) {
          ex = _error;
          border_width = "0px";
        }
        styles["border-width"] = border_width;
        return styles;
      };
  
      PlaceholderShim.prototype.css = function(css_obj, vendor) {
        var each_prop, obj, selector, sheet_id, style_el, style_obj, styles, val, _ref1, _ref2, _results;
        if (vendor == null) {
          vendor = "";
        }
        sheet_id = "ph_shim_stylesheet";
        if (document.getElementById(sheet_id)) {
          style_obj = (_ref1 = document.getElementById(sheet_id)) != null ? _ref1.sheet : void 0;
        } else {
          style_el = document.createElement("style");
          style_el.id = sheet_id;
          style_el.type = "text/css";
          document.getElementsByTagName("head")[0].appendChild(style_el);
          style_obj = (_ref2 = document.getElementById(sheet_id)) != null ? _ref2.sheet : void 0;
        }
        if (!style_obj) {
          style_obj = document.styleSheets[document.styleSheets.length - 1];
        }
        if (css_obj) {
          _results = [];
          for (selector in css_obj) {
            if (css_obj.hasOwnProperty(selector)) {
              styles = "";
              val = "";
              if (typeof css_obj[selector] === "object") {
                obj = css_obj[selector];
                for (each_prop in obj) {
                  if (obj.hasOwnProperty(each_prop)) {
                    val = obj[each_prop];
                    val = val.replace(/_vendor_/g, vendor);
                    each_prop = each_prop.replace(/_vendor_/g, vendor);
                    styles += each_prop + ": " + val + "; ";
                  }
                }
                obj = null;
              } else {
                val = css_obj[selector];
                val = val.replace(/_vendor_/g, vendor);
                styles += val;
              }
              selector = selector.replace(/_vendor_/g, vendor);
              try {
                if (style_obj.insertRule) {
                  _results.push(style_obj.insertRule(selector + " {" + styles + "}", style_obj.cssRules.length));
                } else {
                  if (style_obj.addRule) {
                    _results.push(style_obj.addRule(selector, styles, -1));
                  } else {
                    _results.push(void 0);
                  }
                }
              } catch (_error) {}
            } else {
              _results.push(void 0);
            }
          }
          return _results;
        }
      };
  
      return PlaceholderShim;
  
    })();
  
  }).call(this);