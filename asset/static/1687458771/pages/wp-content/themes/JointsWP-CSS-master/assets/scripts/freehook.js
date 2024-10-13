//freehook.js
jQuery(document).ready(function($) {


    $.ajaxSetup({
        cache: false,
        timeout: 12000,
        type: 'POST',
        dataType: 'json',
        traditional: true
    });


    var _xsrf = document.cookie.match("\\b\_xsrf=([^;]*)\\b"),
        _xsrf = (_xsrf ? _xsrf[1] : undefined);

    function _escapeHtml(unsafe) {
        return unsafe.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
    }

    function _sanitizeInput(input) {
        return jQuery('<div />').text(input).html();
    }

    function _escapeHtmlAndSanitize(input) {
        return _escapeHtml(_sanitizeInput(input));
    }

    function isUrlValid(url) {
        return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(url);
    }


    function getFriendlyError(code) {
        var errorCode = code || 'DEFAULT';

        //console.log('code:' + code);


        var messages = {
            'MISSING_ANON_USER_COOKIE': 'We didn\'t detect a valid browser cookie. Please refresh the page and try again.',
            'FAILED_COOKIE_CHECK': 'We didn\'t detect a valid browser cookie. Please refresh the page and try again.',
            'FAILED_ABUSE_CHECK': 'This URL is blocked due to prohibited content. Review our <a href="https://bitly.com/pages/acceptable-use" target="_blank">Acceptable Use Policy</a>.',
            'INVALID_SERVICE': 'Please select the link, QR Code, or Link-in-bio tab and try again.',
            'INVALID_LONG_URL_AND_KEYWORD': 'We\'ll need a valid URL, like "super-long-link.com/shorten-it"|Only letters, numbers, hyphens (-), and underscores (_) allowed.',
            'INVALID_LONG_URL_AND_KEYWORD_EXISTS': 'We\'ll need a valid URL, like "super-long-link.com/shorten-it"|Someone is using bit.ly/XXX. :( You can try something else or leave it blank.',
            'ALREADY_A_BITLY_LINK_AND_INVALID_KEYWORD': 'Already a bitly link|Only letters, numbers, hyphens (-), and underscores (_) allowed.',
            'ALREADY_A_BITLY_LINK_AND_KEYWORD_EXISTS': 'Already a bitly link|Someone is using bit.ly/XXX. :( You can try something else or leave it blank.',
            'ALREADY_A_BITLY_LINK': 'Already a bitly link',
            'INVALID_ARG_LONG_URL': 'We\'ll need a valid URL, like "super-long-link.com/shorten-it"',
            'INVALID_ARG_KEYWORD': 'Only letters, numbers, hyphens (-), and underscores (_) allowed.',
            'KEYWORD_ALREADY_EXISTS': 'Someone is using bit.ly/XXX. :( You can try something else or leave it blank.',
            'INTERNAL_ERROR': 'An error occurred, try again later',
            'DEFAULT': 'An error occurred'
        };

        message = messages[errorCode];

        if (!message) {
            message = messages['DEFAULT'];
        }
        return message;
    }


    $(document).on('keydown', function(event) {

        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }

    });


    $(document).on('keyup', '.error', function(e) {
        //console.log('changed');
        $(this).removeClass('error');
        $(this).parents('.cell').find('.errormessage').empty();
        $(this).parents('.cell').next('.errormessage').empty();
        errors = $(this).parents('form').find('.error');
        //console.log(errors.length);
        if (errors.length == 0) {
            $(this).parents('form').find('.button').removeAttr('disabled');
        }
    });

    $('form.freehook-form .button').on('click', function(e) {

        e.preventDefault();
        //$('.error').removeClass('error');
        //$('.errormessage').empty();
        //$(this).parents('form').find('button').removeAttr('disabled');

        $thisbutton = $(this);
        $form = $(this).parents('form');
        $hook_type_field = $form.find('.hook_type');
        $hook_backhalf_field = $form.find('.hook_backhalf');
        $hook_backhalf_error = $form.find('.errormessage.for-hook_backhalf');
        $hook_url_field = $form.find('.hook_url');
        $hook_url_error = $form.find('.errormessage.for-hook_url');

        $rd_field = $form.find('input[name="rd"]');

        $hook_type = _escapeHtmlAndSanitize($hook_type_field.val());
        $hook_url = _escapeHtmlAndSanitize($hook_url_field.val());
        $hook_backhalf = _escapeHtmlAndSanitize($hook_backhalf_field.val());
        $rd = _sanitizeInput($rd_field.val());;

            //console.log($hook_backhalf.indexOf('.'));
        if ($hook_type != 'launchpads' && $hook_url.trim() == '') {
            //console.log('bad link');
            $target = $hook_url_field;
            $target_error = $hook_url_error;

            errormsg = 'We\'ll need a valid URL, like "super-long-link.com/shorten-it"';

            if ($hook_type == 'qrcodes') {
                errormsg = 'We\'ll need a valid URL, like "super-long-link.com"';
            }

            $form.find('.button').attr('disabled', '');
            $target.addClass('error');
            $target_error.html(errormsg);

        
        } else if($hook_backhalf != undefined && $hook_backhalf.indexOf('.') != -1 ){
             //console.log('bad keyword');
             //console.log($hook_backhalf);
             //console.log($hook_backhalf.indexOf('.'));

             errormsg ='Only letters, numbers, hyphens (-), and underscores (_) allowed.';

             $target = $hook_backhalf_field;
             $target_error = $hook_backhalf_error;
             
             $form.find('.button').attr('disabled', '');
             $target.addClass('error');
             $target_error.html(errormsg);

        } else {
                //console.log('hooktype val ' + $hook_type);
                //console.log('backhalf val ' + $hook_backhalf);
                //console.log('long url val ' + $hook_url);
                //console.log('rd val ' + $rd);

                if ($hook_backhalf == undefined) {
                    $hook_backhalf = '';
                }

                //data/free_hook/[service]
                endPointURL = '/data/free_hook/link';

                if ($hook_type == 'launchpads') {
                    endPointURL = '/data/free_hook/lib';
                }

                if ($hook_type == 'qrcodes') {
                    endPointURL = '/data/free_hook/qr';
                }

                var options = {
                    url: endPointURL,
                    data: {
                        long_url: $hook_url,
                        keyword: $hook_backhalf
                    },
                    beforeSend: function(XMLHttpRequest) {
                        XMLHttpRequest.setRequestHeader('X-XSRFToken', _xsrf);
                    },
                    success: function(res) {
                        if (res) {
                            //console.log(res);

                            if (res.keyword) {
                                $hook_backhalf = res.keyword;
                            }

                            if (res.long_url) {
                                $hook_url = res.long_url;
                            }


                            if ($hook_backhalf == '') {
                                $hook_backhalf = 'null';
                            }


                            $getstring = $rd + '?hook_url=' + $hook_url + '&hook_backhalf=' + $hook_backhalf + '&hook_type=' + $hook_type + '&free_hook=true';
                            $rd_field.val($getstring);

                            /*
                             if (typeof gtag != 'undefined') {
                                labeltext =  $thisbutton.val();
                                //console.log('buttotn ' + $thisbutton[0]);

                                gtag("event", "freehook_" + $hook_type + "_created", {
                                  category: 'free_hook_cta',
                                  label: labeltext,
                                });
                           
                                var dataLayer = window.dataLayer || [];
                                dataLayer.push({
                                    'formaction':'freehook submit';
                                    'hook_type':$hook_type
                                })
                          
                            
                             } else {
                                //console.log('no GTAG')
                             }
                             */

                            //alert('submit-success');
                            $form.submit();

                        } else {
                            //console.log('reponse 200 with error');
                            //console.log(res);
                        }
                    },
                    error: function(res) {

                        //console.log(res);
                        statuscode = res.status;
                        //console.log('status: ' + statuscode);

                        try {
                            statustxt = res.responseJSON.message;
                            //console.log('status txt: ' + statustxt);

                        } catch (error) {
                            statustxt = 'INTERNAL_ERROR';
                            //console.log('caught error: ' + statustxt);

                        }


                        if (statuscode == 500) {
                            statustxt = 'INTERNAL_ERROR';
                        }

                        errormsg = getFriendlyError(statustxt);
                        //console.log('friendly error:' + errormsg);

                        $form.find('.button').attr('disabled', '');



                        if ($hook_type == 'launchpads') {
                            errormsg = errormsg.replace('XXX', 'm/' + $hook_backhalf);
                        } else {
                            errormsg = errormsg.replace('XXX', $hook_backhalf);
                        }

                        temp = errormsg.split('|');
                        //console.log('raw message array: ' + temp);
                        //console.log('raw message array length: ' + temp.length)

                        if (temp.length == 1) {
                            $target = $hook_url_field;
                            $target_error = $hook_url_error;

                            if (statustxt.includes('KEYWORD') || $hook_type == 'launchpads') {
                                $target = $hook_backhalf_field;
                                $target_error = $hook_backhalf_error;
                            }

                            if (statustxt == 'INVALID_ARG_LONG_URL' && $hook_type == 'qrcodes') {
                                errormsg = 'We\'ll need a valid URL, like "super-long-link.com"';
                            }

                            $target.addClass('error');
                            $target_error.html(errormsg);

                        } else {

                            errormsg = temp[0];
                            errormsg2 = temp[1];

                            $target = $hook_url_field;
                            $target.addClass('error');

                            $target_error = $hook_url_error;
                            $target_error.html(errormsg);

                            $target2 = $hook_backhalf_field;
                            $target2.addClass('error');

                            $target_error2 = $hook_backhalf_error;
                            $target_error2.html(errormsg2);

                        }

                    }
                };

                $.ajax(options);

        }// end if links not empty
    });

});