if (!window.Bitly) { window.Bitly = {}; }

(function(Bitly) {
    var banner = '',
        bannerSpacer = '<div id="banner-spacer" class="sitebanner--spacer"></div>';

    var closeBannerCallbacks = [];

    function findCookie(cookies, cookieString) {
        return (cookies.filter(function(itm) { return (itm.indexOf(cookieString) >= 0); }).length > 0);
    }

    function getCookieConsent() {
        var cookies = document.cookie.split(';');
        if (findCookie(cookies, 'optout=1')) return -1
        if (findCookie(cookies, 'cookie_banner=1')) return 1;
        return 0;
    }

    function activateScripts() {
        var activateScript = function(fromScript) {
            var tag = document.createElement("script");
            fromScript.parentNode.insertBefore(tag, fromScript);
            tag.type = 'text/javascript';
            if (fromScript.src) { tag.src = fromScript.src; }
            if (fromScript.text) { tag.text = fromScript.text; }
            return tag;
        }

        Array.prototype.slice.call(document.querySelectorAll('script[data-cookie-setter]'), 0).map(activateScript);
    }

    function handleBannerClick(e) {
        e.preventDefault();
        var expiresInSixMonths = new Date();
        expiresInSixMonths.setTime(expiresInSixMonths.getTime() + 180 * 24 * 60 * 60 * 1000);
        document.cookie = 'cookie_banner=1; expires=' + expiresInSixMonths.toUTCString() + '; path=/';
        bannerClose();
    }

    function handlePageLoad(e) {
        var cookieConsent = getCookieConsent();
        if (cookieConsent === 0) {
            var body = document.querySelector('body')
            var bannerElement = document.createElement('div');
            body.insertBefore(bannerElement, body.children[0]);
            bannerElement.outerHTML = banner;
            document.querySelector('#banner-cookie--button').addEventListener('click', handleBannerClick);

            var bannerSpacerElement = document.createElement('div');
            body.insertBefore(bannerSpacerElement, body.children[0]);
            bannerSpacerElement.outerHTML = bannerSpacer;
        }

        if (cookieConsent !== -1) {
            activateScripts();
        }
    }

    function bannerClose() {
        var body = document.querySelector('body')
        body.removeChild(document.querySelector('#banner-spacer'));
        body.removeChild(document.querySelector('#banner-cookie'));

        closeBannerCallbacks.map(function(cb) { cb(); });
    }

    function onCloseBanner(cb) {
        closeBannerCallbacks.push(cb);
    }

    Bitly.activateScripts = activateScripts;
    Bitly.getCookieConsent = getCookieConsent;
    Bitly.handlePageLoad = handlePageLoad;
    Bitly.onCloseBanner = onCloseBanner;
})(window.Bitly);

document.addEventListener('DOMContentLoaded', window.Bitly.handlePageLoad);