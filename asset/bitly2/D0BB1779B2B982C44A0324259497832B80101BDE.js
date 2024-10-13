  (function() {
    var PUSHSTATE_SUPPORT, SUSIRouter, SUSIView, URLParams, _ref, _ref1,
      __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; },
      __hasProp = {}.hasOwnProperty,
      __extends = function(child, parent) { for (var key in parent) { if (__hasProp.call(parent, key)) child[key] = parent[key]; } function ctor() { this.constructor = child; } ctor.prototype = parent.prototype; child.prototype = new ctor(); child.__super__ = parent.prototype; return child; };

    PUSHSTATE_SUPPORT = window.history && window.history.pushState;

    window.App = {};

    App.analyticsEvents = {
      '#sso-sign-in-link': {
        event: 'sign_in_sso_option_clicked',
        event_category: 'account_sign_in',
        event_label: 'Sign In with SSO',
        event_type: 'login',
        event_method: 'sso',
        snowplow: {
          category: 'button',
          action: 'login_with_sso_clicked',
          label: 'log_in_with_sso'
        }
      },
      '#sign-up-link': {
        event: 'no_account_sign_up_clicked',
        event_category: 'account_sign_in',
        event_label: 'Sign Up from Sign In Page'
      },
      '#social-login-google': {
        event: 'sign_in_clicked_google',
        event_category: 'account_sign_in',
        event_label: 'Sign In with Google',
        event_type: 'login',
        event_method: 'google'
      },
      '#social-login-twitter': {
        event: 'sign_in_clicked_twitter',
        event_category: 'account_sign_in',
        event_label: 'Sign In with Twitter',
        event_type: 'login',
        event_method: 'twitter'
      },
      '#social-login-facebook': {
        event: 'sign_in_clicked_facebook',
        event_category: 'account_sign_in',
        event_label: 'Sign In with Facebook',
        event_type: 'login',
        event_method: 'facebook'
      },
      '#social-login-apple': {
        event: 'sign_in_clicked_apple',
        event_category: 'account_sign_in',
        event_label: 'Sign In with Apple',
        event_type: 'login',
        event_method: 'apple'
      },
      '#sso-sign-in-link-top': {
        event: 'sign_in_sso_option_clicked',
        event_category: 'account_sign_in',
        event_label: 'Sign In with SSO',
        snowplow: {
          category: 'button',
          action: 'login_with_sso_clicked',
          label: 'log_in_with_sso'
        }
      },
      '#google-sign-up': {
        snowplow: {
          category: 'button',
          action: 'sign_up_with_google_clicked',
          label: 'sign_up_with_google'
        }
      },
      '#acceptable-use-link': {
        snowplow: {
          category: 'button',
          action: 'acceptable_use_policy_clicked',
          label: 'acceptable_use_policy'
        }
      },
      '#privacy-policy-link': {
        snowplow: {
          category: 'button',
          action: 'privacy_policy_clicked',
          label: 'privacy_policy'
        }
      },
      '#terms-of-service-link': {
        snowplow: {
          category: 'button',
          action: 'terms_of_service_clicked',
          label: 'terms_of_service'
        }
      }
    };

    URLParams = (function() {
      function URLParams() {
        this.polyfill = __bind(this.polyfill, this);
        this.get = __bind(this.get, this);
        this.has = __bind(this.has, this);
      }

      URLParams.prototype.supported = typeof window !== 'undefined' && 'URLSearchParams' in window;

      URLParams.prototype.params = function(custom) {
        if (this.supported) {
          return new URLSearchParams(custom || decodeURIComponent(location.search));
        }
        return null;
      };

      URLParams.prototype.has = function(param) {
        if (this.supported) {
          return this.params().has(param);
        } else {
          if (this.polyfill(param)) {
            return true;
          } else {
            return false;
          }
        }
      };

      URLParams.prototype.get = function(param) {
        if (this.supported) {
          return this.params().get(param);
        } else {
          return this.polyfill(param);
        }
      };

      URLParams.prototype.polyfill = function(param) {
        var regex, regexS, results;
        param = param.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
        regexS = '[\\?&]' + param + '=([^&#]*)';
        regex = new RegExp(regexS);
        results = regex.exec(location.href);
        if (results === null) {
          return null;
        } else {
          return results[1];
        }
      };

      return URLParams;

    })();

    SUSIView = (function(_super) {
      __extends(SUSIView, _super);

      function SUSIView() {
        this.ssoSignIn = __bind(this.ssoSignIn, this);
        this.signUp = __bind(this.signUp, this);
        this.signIn = __bind(this.signIn, this);
        this.clearErrors = __bind(this.clearErrors, this);
        this.toggle = __bind(this.toggle, this);
        this.render = __bind(this.render, this);
        this.displayPaymentFlowHeader = __bind(this.displayPaymentFlowHeader, this);
        this.addPasswordToggle = __bind(this.addPasswordToggle, this);
        this.sendTwitterEvent = __bind(this.sendTwitterEvent, this);
        this.sendBingEvent = __bind(this.sendBingEvent, this);
        this.sendGA4Event = __bind(this.sendGA4Event, this);
        this.sendUAEvent = __bind(this.sendUAEvent, this);
        this.events = __bind(this.events, this);
        _ref = SUSIView.__super__.constructor.apply(this, arguments);
        return _ref;
      }

      SUSIView.prototype.initialize = function() {
        var plan, split_url, url;
        url = window.location.href;
        split_url = url.split('%');
        plan = split_url.length > 1 ? split_url[5].replace('3D', '') : 'free';
        this.sendGA4Event('conversion', {
          allow_custom_scripts: true,
          send_to: 'DC-12998045/signu0/frees0+standard'
        });
        this.sendGA4Event('conversion', {
          allow_custom_scripts: true,
          u1: plan,
          send_to: 'DC-12389169/conve0/signu0+standard'
        });
        this.input_event = 'oninput' in window ? "input" : "propertychange";
        this.analyticsLinks = Object.keys(App.analyticsEvents).join(',');
        this.$sign_up = this.$('#sign-up');
        this.$sign_up_password_label = this.$('#sign-up label[for="password"]');
        this.$sign_up_password_error = this.$('#sign-up input[name="password"] + .error-message');
        this.$sso_sign_up = this.$('#sso-sign-up');
        this.$sso_sign_up_password_label = this.$('#sso-sign-up label[for="password"]');
        this.$sso_sign_up_password_error = this.$sso_sign_up_password_label.find('.error-message');
        this.$sso_sign_up_password2_label = this.$('#sso-sign-up label[for="password2"]');
        this.$sso_sign_up_password2_error = this.$sso_sign_up_password2_label.find('.error-message');
        this.$sso_sign_up.find('input[placeholder]').each(function(i, el) {
          return new App.Lib.PlaceholderShim(el);
        });
        this.$sign_in = this.$('#sign-in');
        this.$sign_in_username_label = this.$('#sign-in label[for="username"]');
        this.$sign_in_password_label = this.$('#sign-in label[for="password"]');
        this.$sign_in_password_error = this.$('input[name="password"] + .error-message');
        this.$sso_sign_in = this.$('#sso-sign-in');
        this.$sso_sign_in_password_label = this.$('#sso-sign-in label[for="password"]');
        this.$sso_sign_in_password_error = this.$sso_sign_in_password_label.find('.error-message');
        this.$sso_sign_in.find('input[placeholder]').each(function(i, el) {
          return new App.Lib.PlaceholderShim(el);
        });
        this.focusFirstField();
        this.displayPaymentFlowHeader();
        this.checkRateLimited()
        return this.render();
      };

      SUSIView.prototype.checkRateLimited = function() {
        var queryString = window.location.search;
        var params = new URLSearchParams(queryString);

        if (params.get("limited") === 'true') {
          this.$sign_in_password_error.removeClass('hidden');
          this.$sign_in_password_error.html("Too many sign-in attempts! Please try again in a few minutes.");
        }
        return params;
      }

      SUSIView.prototype.events = function() {
        var _events;
        _events = {};
        _events['click .switch'] = function(e) {
          var href, protocol;
          href = $(e.currentTarget).attr('href');
          protocol = document.location.protocol + '//';
          if (href && href.slice(protocol.length) !== protocol) {
            this.trackPageView(href);
            if (!PUSHSTATE_SUPPORT) {
              return;
            }
            e.preventDefault();
            Backbone.history.navigate(href);
            return this.toggle();
          }
        };
        _events['click #sign-up-link'] = function(e) {
          var signUpLink;
          signUpLink = document.getElementById('sign-up-link');
          return signUpLink.href += location.search;
        };
        _events['click #sign-in-link'] = function(e) {
          var signInLink;
          signInLink = document.getElementById('sign-in-link');
          return signInLink.href += location.search;
        };
        _events['click #sso-sign-in-link'] = function(e) {
          var ssoSigninLink;
          ssoSigninLink = document.getElementById('sso-sign-in-link');
          return ssoSigninLink.href += location.search;
        };
        _events['click #sso-sign-in-link-top'] = function(e) {
          var ssoSigninLink;
          ssoSigninLink = document.getElementById('sso-sign-in-link-top');
          return ssoSigninLink.href += location.search;
        };
        _events['submit #sign-in'] = 'signIn';
        _events['submit #sign-up'] = 'signUp';
        _events['submit #sso-sign-in'] = 'ssoSignIn';
        _events['click '.concat(this.analyticsLinks)] = function(e) {
          var id, link, payload, url;
          e.preventDefault();
          link = $(e.currentTarget);
          id = '#'.concat(link.prop('id'));
          url = link.prop('href');
          payload = App.analyticsEvents[id];
          this.sendUAEvent(payload, function() {
            return window.location = url;
          });
          if (payload.event_type) {
            return this.sendGA4Event(payload.event_type, {
              method: payload.event_method
            });
          }
        };
        return _events;
      };

      SUSIView.prototype.sendUAEvent = function(analyticsEvent, cb) {
        var cbTimeout;
        cbTimeout = 1000;
        if (window.snowplow && analyticsEvent.snowplow) {
          window.snowplow('trackStructEvent', analyticsEvent.snowplow);
          if (!analyticsEvent.event) {
            cbTimeout = 100;
          }
        }
        setTimeout(cb, cbTimeout);
        if (window.ga && analyticsEvent.event) {
          return window.ga('send', {
            hitType: 'event',
            eventCategory: analyticsEvent.event_category,
            eventAction: analyticsEvent.event,
            eventLabel: analyticsEvent.event_label,
            hitCallback: this.sendGA4Event(analyticsEvent.event, {
              event_category: analyticsEvent.event_category,
              event_label: analyticsEvent.event_label,
              event_callback: cb
            })
          });
        }
      };

      SUSIView.prototype.sendGA4Event = function(eventType, payload) {
        if (window.gtag) {
          return window.gtag('event', eventType, payload);
        }
      };

      SUSIView.prototype.sendTwitterEvent = function(eventType, payload) {
        if (window.twq) {
          window.twq('init', 'obv70');
          return window.twq('track', eventType, payload);
        }
      };

      SUSIView.prototype.sendBingEvent = function() {
        if (window.uetq) {
          return window.uetq.push('event', 'Free Plan Sign Up', { currency: 'USD' })
        }
      };

      SUSIView.prototype.addPasswordToggle = function(eventId) {
        var _this = this;
        return document.querySelector("" + eventId + " .password-toggle") && document.querySelector("" + eventId + " .password-toggle").addEventListener('click', function(e) {
          var inputField, toggleText;
          inputField = document.querySelector("" + eventId + " .pw");
          toggleText = document.querySelector("" + eventId + " .password-toggle .password-toggle-text");
          if (inputField.type === "password") {
            inputField.type = "text";
            return toggleText.innerText = 'Hide';
          } else {
            inputField.type = "password";
            return toggleText.innerText = 'Show';
          }
        });
      };

      SUSIView.prototype.displayPaymentFlowHeader = function() {
        var headers, paymentForm, signInContainers, signInHeaderElems, tagline, url,
          _this = this;
        url = new URLParams;
        paymentForm = url.has('payment_form') && JSON.parse(url.get('payment_form'));
        if (paymentForm) {
          tagline = document.querySelector('h3.switch.to-sign-in.tagline');
          tagline.innerText = 'Create an account';
          signInHeaderElems = document.querySelectorAll(".sign_in .signup-flow-elem.em");
          if (signInHeaderElems.length) {
            signInHeaderElems.forEach(function(el) {
              return el.innerText = 'Log in';
            });
          }
          signInContainers = document.querySelectorAll(".sign_in .signup-flow-container");
          if (signInContainers.length) {
            signInContainers.forEach(function(container) {
              return container.classList.add('login-flow');
            });
          }
          headers = document.querySelectorAll(".signup-flow-container");
          headers.forEach(function(header) {
            return header.classList.remove('hidden');
          });
        }
      };

      SUSIView.prototype.render = function(e) {
        this.addPasswordToggle('#sign-up');
        return this.addPasswordToggle('#sign-in');
      };

      SUSIView.prototype.toggle = function() {
        this.$el.toggleClass('sign_in sign_up');
        return this.focusFirstField();
      };

      SUSIView.prototype.focusFirstField = function() {
        return this.$el.find("input[type='text']:visible").first().focus();
      };

      SUSIView.prototype.clearErrors = function() {
        this.$('label.error').removeClass('error');
        this.$('input.text.input-error').removeClass('input-error');
        this.$('.error-message').html('');
        return this.$sign_in_password_error.addClass('hidden');
      };

      SUSIView.prototype.signIn = function(e) {
        var field, params, _i, _len, _ref1,
          _this = this;
        if (this.full_submit_enabled) {
          return;
        }
        e.preventDefault();
        if (window.snowplow) {
          window.snowplow('trackStructEvent', {
            category: 'button',
            action: 'login_clicked',
            label: 'log_in'
          });
        }
        this.sign_in_locked = true;
        this.clearErrors();
        params = {};
        _ref1 = this.$sign_in.serializeArray();
        for (_i = 0, _len = _ref1.length; _i < _len; _i++) {
          field = _ref1[_i];
          params[field.name] = field.value;
        }
        params.verification = true;
        return BITLY.post('/a/sign_in', params).done(function(data) {
          _this.sign_in_locked = false;
          _this.full_submit_enabled = true;
          _this.sendGA4Event('login', {
            method: 'email'
          });
          return _this.sendUAEvent({
            event: 'sign_in_clicked_email',
            event_category: 'account_sign_in',
            event_label: 'Sign In with Email'
          }, function() {
            return this.$("#sign-in").submit();
          });
        }).fail(function(data) {
          var inputs;
          _this.sign_in_locked = false;
          _this.$sign_in_password_error.removeClass('hidden');

          inputs = _this.$sign_in.find('input');
          inputs.one("" + _this.input_event + ".error", _this.clearErrors);

          var errors_to_user_txt = {
            "ACCOUNT_DEACTIVATED": "Account deactivated.",
            "ACCOUNT_SUSPENDED": "Account suspended.",
            "RATE_LIMIT_EXCEEDED": "Too many sign in attempts!  Please try again in a few minutes.",
            "VALIDATION_ERROR": "Email/username or password is incorrect. Try again.",
            "ACCOUNT_DORMANT": "Your account has been locked due to inactivity. We have sent an email with a link to reset your password and unlock the account.",
            "INTERNAL_ERROR": "Bitly generated a mysterious error. Please give us a moment and try again."
          }

          if (data.hasOwnProperty('responseJSON') && data.responseJSON.hasOwnProperty('message') && errors_to_user_txt[data.responseJSON.message]) {
            return _this.$sign_in_password_error.html(errors_to_user_txt[data.responseJSON.message]);
          } else if (data != null && data.hasOwnProperty('responseJSON') &&  data.responseJSON.hasOwnProperty('description')) {
            return _this.$sign_in_password_error.html(data.responseJSON.description);
          }

          return _this.$sign_in_password_error.html(errors_to_user_txt['VALIDATION_ERROR']);
        });
      };

      SUSIView.prototype.signUp = function(e) {
        var field, params, _i, _len, _ref1,
          _this = this;
        e.preventDefault();
        if (this.sign_up_locked) {
          return;
        }
        this.sign_up_locked = true;
        this.clearErrors();
        params = {};
        _ref1 = this.$sign_up.serializeArray();
        for (_i = 0, _len = _ref1.length; _i < _len; _i++) {
          field = _ref1[_i];
          params[field.name] = field.value;
        }
        if (window.snowplow) {
          window.snowplow('trackSelfDescribingEvent', {
            event: {
              schema: 'iglu:ly.bit/sign_up/jsonschema/1-0-0',
              data: {
                username: params.username,
                email_address: params.email
              }
            }
          });
        }
        return BITLY.post('/a/sign_up', params).done(function(data) {
          var action, qp, tier, url;
          _this.sign_up_locked = false;
          qp = data && data.redirect_url;
          url = new URLParams;
          params = url.params(qp && qp.substring(qp.indexOf('?'), qp.length));
          tier = params.get('tier') || 'free';
          action = tier === 'free' ? 'sign_up_free_succeeded_email' : 'sign_up_succeeded_email';
          _this.sendGA4Event('conversion', {
            send_to: 'AW-768371374/vCTICJ2g1f0CEK7Vse4C',
            transaction_id: ''
          });
          _this.sendGA4Event('sign_up', {
            method: 'email',
            rate_plan_name: tier
          });
          _this.sendTwitterEvent(action, {
            method: 'email'
          });
          _this.sendBingEvent();
          _this.sendUAEvent({
            event: action,
            event_category: 'account_creation',
            event_label: 'Sign Up with Email'
          }, function() {
            var redirect;
            redirect = data && data.redirect_url;
            if (redirect) {
              return location.href = redirect;
            } else {
              return location.reload();
            }
          });
          _this.sendGA4Event('conversion', {
            allow_custom_scripts: true,
            send_to: 'DC-12998045/signu0/frees0+standard'
          });
          return _this.sendGA4Event('conversion', {
            allow_custom_scripts: true,
            u1: tier,
            send_to: 'DC-12389169/conve0/signu00+standard'
          });
        }).fail(function(data) {
          var err, _ref2;
          _this.sign_up_locked = false;
          data = data.responseJSON
          if ((data != null ? data.message : void 0) === "RATE_LIMIT_EXCEEDED") {
            _this.$sign_up.find('input[name="email"] + .error-message').removeClass('hidden').html("Too many sign up attempts or an unsupported address!  Please try again in a few minutes.");
          }
          if ((_ref2 = data) != null ? _ref2.errors : void 0) {
            err = data.errors;
            if (err.password) {
              _this.$sign_up_password_label.addClass("error");
              _this.$sign_up_password_error.removeClass('hidden').html(err.password);
              _this.$sign_up_password_label.find('input[type="password"]').one("" + _this.input_event + ".error", _this.clearErrors);
              _this.$sign_up.find('input[name="password"]').addClass("input-error");
            }
            if (err.email) {
              _this.$sign_up.find('label[for="email"]').addClass("error").find('input').one("" + _this.input_event + ".error", _this.clearErrors).end();
              _this.$sign_up.find('input[name="email"]').addClass("input-error");
              _this.$sign_up.find('input[name="email"] + .error-message').removeClass('hidden').html(err.email);
            }
            if (err.username) {
              _this.$sign_up.find('label[for="username"]').addClass("error").find('input').one("" + _this.input_event + ".error", _this.clearErrors).end();
              _this.$sign_up.find('input[name="username"]').addClass("input-error");
              _this.$sign_up.find('input[name="username"] + .error-message').removeClass('hidden').html(err.username);
            }
            if (err.captcha) {
              _this.$sign_up.find('.g-recaptcha.error-message').html(err.captcha);
            }
            return _this.logFormError(err);
          }
        });
      };

      SUSIView.prototype.ssoSignIn = function(e) {
        var field, params, _i, _len, _ref1,
          _this = this;
        if (this.full_submit_enabled) {
          return;
        }
        e.preventDefault();
        this.sign_in_locked = true;
        this.clearErrors();
        params = {};
        _ref1 = this.$sso_sign_in.serializeArray();
        for (_i = 0, _len = _ref1.length; _i < _len; _i++) {
          field = _ref1[_i];
          params[field.name] = field.value;
        }
        params.verification = true;
        return BITLY.post('/sso/link_sign_in', params).done(function(data) {
          _this.sign_in_locked = false;
          _this.full_submit_enabled = true;
          return _this.$("#sso-sign-in").submit();
        }).fail(function(data) {
          var inputs;
          _this.sign_in_locked = false;
          _this.$sso_sign_in_password_label.addClass("error");
          if ((data != null ? data.status_txt : void 0) === 'ACCOUNT_DEACTIVATED') {
            _this.$sso_sign_in_password_error.html('Account deactivated');
          } else if ((data != null ? data.status_txt : void 0) === 'ACCOUNT_SUSPENDED') {
            _this.$sso_sign_in_password_error.html('Account suspended');
          } else {
            _this.$sso_sign_in_password_error.html('Nope. Try again.');
          }
          inputs = _this.$sso_sign_in.find('input');
          inputs.one("" + _this.input_event + ".error", _this.clearErrors);
          if (data.status_txt === 'VALIDATION_ERROR') {
            return _this.$sso_sign_in_password_error.html('Nope. Try again.');
          } else {
            return _this.$sso_sign_in_password_error.html(data.data);
          }
        });
      };

      SUSIView.prototype.logFormError = function(err) {
        var ERROR_LABELS, e, err_msg, error_actions_by_priority, ga_label, _i, _len, _ref1, _results;
        if (window.ga) {
          error_actions_by_priority = ['username', 'email', 'password', 'captcha'];
          ERROR_LABELS = {
            'Letter & numbers only. 4–32 characters.': 'invalid',
            'That username is already in use.': 'in use',
            'Password must be at least 6 characters': 'too short',
            'Please include a valid email address.': 'invalid',
            'An account with that email already exists.': 'in use',
            'Password is not strong enough. Try including uppercase letters, numbers, special characters or using a longer password.': 'weak password',
            "Password can't match username": 'weak password',
            "You can't leave this empty": 'empty',
            'Completing the CAPTCHA is required.': 'failed captcha'
          };
          _results = [];
          for (_i = 0, _len = error_actions_by_priority.length; _i < _len; _i++) {
            e = error_actions_by_priority[_i];
            if (err[e]) {
              err_msg = (_ref1 = ERROR_LABELS[err[e]]) != null ? _ref1 : 'unknown';
              ga_label = "" + e + " - " + err_msg;
              window.ga('send', 'event', 'SignUpForm', 'error', ga_label);
              break;
            } else {
              _results.push(void 0);
            }
          }
          return _results;
        }
      };

      SUSIView.prototype.trackPageView = function(url) {
        if (window.ga) {
          window.ga('set', 'page', url);
          return window.ga('send', 'pageview');
        }
      };

      return SUSIView;

    })(Backbone.View);

    SUSIRouter = (function(_super) {
      __extends(SUSIRouter, _super);

      function SUSIRouter() {
        _ref1 = SUSIRouter.__super__.constructor.apply(this, arguments);
        return _ref1;
      }

      SUSIRouter.prototype.routes = {
        'a/sign_up': 'toggle',
        'a/sign_in': 'toggle',
        'sso/link_sign_in': 'toggle'
      };

      SUSIRouter.prototype.toggle = function() {
        return App.SUSI.toggle();
      };

      return SUSIRouter;

    })(Backbone.Router);

    $(function() {
      App.SUSI = new SUSIView({
        el: 'body'
      });
      App.SUSIr = new SUSIRouter;
      App.SUSI.on('all', function() {
        return console.log(arguments);
      });
      App.SUSIr.on('all', function() {
        return console.log(arguments);
      });
      if (PUSHSTATE_SUPPORT) {
        return Backbone.history.start({
          pushState: true,
          silent: true,
          hashChange: false
        });
      }
    });

  }).call(this);