/*
    name : cookie
    file : jquery.cookie.js
    author : gregory tomlinson
    Dual licensed under the MIT and GPL licenses.
    ///////////////////////////
    ///////////////////////////        
    dependencies : jQuery 1.4.2
    ///////////////////////////
    ///////////////////////////
    
*/

(function($) {
    
    $.extend({
        
        cookie : {
            
            get : function( name ) {
                var r = document.cookie.match("\\b" + name + "=([^;]*)\\b");
                return r ? r[1] : undefined;                
            },
            
            write : function( name, value, days ) {
                if (days) {
                    var date = new Date();
                    date.setTime(date.getTime()+(days*24*60*60*1000) );
                    var expires = "; expires="+date.toGMTString();
                }
                else var expires = "";
                document.cookie = name+"="+value+expires+"; path=/";                
            },
            
            debug : function() {
                console.log(document.cookie);
            }
            
            
            
        }
        
        
    });

})(jQuery);