/**
* jQuery Cookie plugin
*
* Copyright (c) 2010 Klaus Hartl (stilbuero.de)
* Dual licensed under the MIT and GPL licenses:
* http://www.opensource.org/licenses/mit-license.php
* http://www.gnu.org/licenses/gpl.html
*
*/
jQuery.cookie = function (key, value, options) {

    // key and at least value given, set cookie...
    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = jQuery.extend({}, options);

        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        value = String(value);

        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : encodeURIComponent(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

    // key and possibly options given, get cookie...
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};

$(document).ready(function(){    
    
    
    /* Jquery Tabs */
    var tabs = $('.tabs div.tabContent');
    var hash = window.location.hash.replace("_tab","");
    
    // On page load check for hash else show :first
    if($(hash).length != 0) {
        tabs.hide();
        $(hash).show();
        $('ul.tabmenu li.'+hash.replace(/#/,'')+' a').addClass('selected');
    } else {
        tabs.hide().filter('div:first').show();
        $('ul.tabmenu li:eq(0) a').addClass('selected');
    }

    $('ul.tabmenu a').click(function(e) {
        tabs.hide();
        tabs.filter(this.hash).show();
        
        $('ul.tabmenu a').removeClass('selected');
        $(this).addClass('selected');
        
        // Prefix with _tab to prevent browser jump on page load.
        window.location.hash = this.hash+'_tab';
        
        $.cookie('tab', this.hash+'_tab');
        
        e.preventDefault();
    }); 

}); 