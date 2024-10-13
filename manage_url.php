<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include 'connection.php';

$error_message = isset($_GET['err']) ? $_GET['err'] : '';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Database connection code here
$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = $_SESSION['username'];

// Use a prepared statement to prevent SQL injection
$query = "SELECT * FROM redirects
JOIN urls ON redirects.qr_id = urls.id
WHERE urls.user_id = ? AND redirects.added_ = 0";
$stmt = $connection->prepare($query);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();

// Close the statement and connection
$stmt->close();
mysqli_close($connection);
?>

<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="utf-8">
    <link rel="preload"
        href="https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/cache/fvm/min/1687458765-cssf896c874918969d9d20a777bf47d8a5b01d174508c20d246abd8b88559021.css"
        as="style" media="all">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta class="foundation-mq">
    <title>URL Shortener - Short URLs & Custom Free Link Shortener | Bitly</title>
    <meta name="description"
        content="Bitly’s Connections Platform is more than a free URL shortener, with robust link management software, advanced QR Code features, and a Link-in-bio solution.">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="URL Shortener - Short URLs & Custom Free Link Shortener | Bitly">
    <meta property="og:description"
        content="Bitly’s Connections Platform is more than a free URL shortener, with robust link management software, advanced QR Code features, and a Link-in-bio solution.">
    <meta property="og:url" content="https://bitly.com/">
    <meta property="og:site_name" content="Bitly">
    <meta property="article:publisher" content="https://www.facebook.com/bitly">
    <meta property="article:modified_time" content="2023-06-15T21:16:22+00:00">
    <meta property="og:image"
        content="https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/uploads/2022/08/home-hero-social-sharing.png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:type" content="image/png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="URL Shortener - Short URLs & Custom Free Link Shortener | Bitly">
    <meta name="twitter:description"
        content="Bitly’s Connections Platform is more than a free URL shortener, with robust link management software, advanced QR Code features, and a Link-in-bio solution.">
    <meta name="twitter:image"
        content="https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/uploads/2022/08/home-hero-social-sharing.png">
    <meta name="twitter:site" content="@Bitly">
    <script type="application/ld+json" class="yoast-schema-graph">
        {
            "@context": "https://schema.org",
            "@graph": [{
                "@type": "WebPage",
                "@id": "https://bitly.com/pages/",
                "url": "https://bitly.com/pages/",
                "name": "URL Shortener - Short URLs & Custom Free Link Shortener | Bitly",
                "isPartOf": {
                    "@id": "https://bitly.com/pages/#website"
                },
                "about": {
                    "@id": "https://bitly.com/pages/#organization"
                },
                "datePublished": "2022-10-25T20:13:42+00:00",
                "dateModified": "2023-06-15T21:16:22+00:00",
                "description": "Bitly’s Connections Platform is more than a free URL shortener, with robust link management software, advanced QR Code features, and a Link-in-bio solution.",
                "breadcrumb": {
                    "@id": "https://bitly.com/pages/#breadcrumb"
                },
                "inLanguage": "en-US",
                "potentialAction": [{
                    "@type": "ReadAction",
                    "target": ["https://bitly.com/pages/"]
                }]
            }, {
                "@type": "BreadcrumbList",
                "@id": "https://bitly.com/pages/#breadcrumb",
                "itemListElement": [{
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Home"
                }]
            }, {
                "@type": "WebSite",
                "@id": "https://bitly.com/pages/#website",
                "url": "https://bitly.com/pages/",
                "name": "Bitly",
                "description": "Harness the click",
                "publisher": {
                    "@id": "https://bitly.com/pages/#organization"
                },
                "potentialAction": [{
                    "@type": "SearchAction",
                    "target": {
                        "@type": "EntryPoint",
                        "urlTemplate": "https://bitly.com/pages/?s={search_term_string}"
                    },
                    "query-input": "required name=search_term_string"
                }],
                "inLanguage": "en-US"
            }, {
                "@type": "Organization",
                "@id": "https://bitly.com/pages/#organization",
                "name": "Bitly, Inc.",
                "url": "https://bitly.com/pages/",
                "logo": {
                    "@type": "ImageObject",
                    "inLanguage": "en-US",
                    "@id": "https://bitly.com/pages/#/schema/logo/image/",
                    "url": "https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/uploads/2019/02/cropped-Logo_orange1.png",
                    "contentUrl": "https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/uploads/2019/02/cropped-Logo_orange1.png",
                    "width": 310,
                    "height": 152,
                    "caption": "Bitly, Inc."
                },
                "image": {
                    "@id": "https://bitly.com/pages/#/schema/logo/image/"
                },
                "sameAs": ["https://www.facebook.com/bitly", "https://twitter.com/Bitly", "https://www.instagram.com/bitly/", "https://www.linkedin.com/company/bitly/", "https://www.youtube.com/channel/UCXqBik7fDW6jzp9PBXwiIQQ", "https://en.wikipedia.org/wiki/Bitly"]
            }]
        }
    </script>
    <link rel="canonical" href="https://bitly.com/">
    <meta name="updated-canonical" value="true">
    <meta name="google-site-verification" content="VxdtAjqaA6XhwRJO86fcIZtRDqJAzUqlgS8AwZHmd3o">
    <meta name="google-site-verification" content="v0y6aY7uUXw-qQm9w0YTh4VBwOMfELJ-YKG7pCd5RoQ">
    <link rel="preload" fetchpriority="low" id="fvmfonts-css"
        href="https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/cache/fvm/min/1687458765-css7ec7df5f16631b30de39c3ed0a4afc5dee09846929d22c1bf8cd1a835ca6b.css"
        as="style" media="all" onload="this.rel='stylesheet';this.onload=null">
    <link rel="stylesheet"
        href="asset/static/1687458771/pages/wp-content/cache/fvm/min/1687458765-cssf896c874918969d9d20a777bf47d8a5b01d174508c20d246abd8b88559021.css"
        media="all">
    <script data-cfasync="false"
        src="asset/static/1687458771/pages/wp-content/themes/JointsWP-CSS-master/assets/scripts/jquery.min.js"></script>
    <script defer
        src="asset/static/1687458771/pages/wp-content/cache/fvm/min/1687458765-js33dea76949edd6f99c859959b54125ec8fae8fa3bb05f2ae6d42121e07ad1e.js"></script>
    <link rel="icon"
        href="https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/uploads/2019/02/favicon.ico">
    <script id="optimizelyscript">
        var a = 1;
    </script>
    <style id="safe-svg-svg-icon-style-inline-css" type="text/css" media="all">
        .safe-svg-cover .safe-svg-inside {
            display: inline-block;
            max-width: 100%
        }

        .safe-svg-cover svg {
            height: 100%;
            max-height: 100%;
            max-width: 100%;
            width: 100%
        }
    </style>
    <style id="global-styles-inline-css" type="text/css" media="all">
        
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body {
            font-family: 'Poppins';
        }

        .inner-content {
            font-family: 'Poppins', sans-serif;
        }

        .icon-wrapper {
            background-color: #007BFF;
            color: white;
            font-size: 24px;
            /* Reduced font size */
            padding: 15px;
            /* Reduced padding */
            border-radius: 50%;
            margin-bottom: 20px;
            display: inline-block;
        }

        h5 {
            font-size: 24px;
            color: #333;
            padding-bottom: 20px;
        }

        .redirect-url {
            font-size: 16px;
            color: #555;
            padding-bottom: 10px;
            display: inline-block;
        }

        .fancy-box {
            background: linear-gradient(135deg, #f3f4f6, #ffffff);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .fancy-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
        }


        .fancy-button {
            background-color: #007BFF;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .fancy-button:hover {
            background-color: #0056b3;
        }



        body {
            --wp--preset--color--black: #000000;
            --wp--preset--color--cyan-bluish-gray: #abb8c3;
            --wp--preset--color--white: #ffffff;
            --wp--preset--color--pale-pink: #f78da7;
            --wp--preset--color--vivid-red: #cf2e2e;
            --wp--preset--color--luminous-vivid-orange: #ff6900;
            --wp--preset--color--luminous-vivid-amber: #fcb900;
            --wp--preset--color--light-green-cyan: #7bdcb5;
            --wp--preset--color--vivid-green-cyan: #00d084;
            --wp--preset--color--pale-cyan-blue: #8ed1fc;
            --wp--preset--color--vivid-cyan-blue: #0693e3;
            --wp--preset--color--vivid-purple: #9b51e0;
            --wp--preset--gradient--vivid-cyan-blue-to-vivid-purple: linear-gradient(135deg, rgba(6, 147, 227, 1) 0%, rgb(155, 81, 224) 100%);
            --wp--preset--gradient--light-green-cyan-to-vivid-green-cyan: linear-gradient(135deg, rgb(122, 220, 180) 0%, rgb(0, 208, 130) 100%);
            --wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange: linear-gradient(135deg, rgba(252, 185, 0, 1) 0%, rgba(255, 105, 0, 1) 100%);
            --wp--preset--gradient--luminous-vivid-orange-to-vivid-red: linear-gradient(135deg, rgba(255, 105, 0, 1) 0%, rgb(207, 46, 46) 100%);
            --wp--preset--gradient--very-light-gray-to-cyan-bluish-gray: linear-gradient(135deg, rgb(238, 238, 238) 0%, rgb(169, 184, 195) 100%);
            --wp--preset--gradient--cool-to-warm-spectrum: linear-gradient(135deg, rgb(74, 234, 220) 0%, rgb(151, 120, 209) 20%, rgb(207, 42, 186) 40%, rgb(238, 44, 130) 60%, rgb(251, 105, 98) 80%, rgb(254, 248, 76) 100%);
            --wp--preset--gradient--blush-light-purple: linear-gradient(135deg, rgb(255, 206, 236) 0%, rgb(152, 150, 240) 100%);
            --wp--preset--gradient--blush-bordeaux: linear-gradient(135deg, rgb(254, 205, 165) 0%, rgb(254, 45, 45) 50%, rgb(107, 0, 62) 100%);
            --wp--preset--gradient--luminous-dusk: linear-gradient(135deg, rgb(255, 203, 112) 0%, rgb(199, 81, 192) 50%, rgb(65, 88, 208) 100%);
            --wp--preset--gradient--pale-ocean: linear-gradient(135deg, rgb(255, 245, 203) 0%, rgb(182, 227, 212) 50%, rgb(51, 167, 181) 100%);
            --wp--preset--gradient--electric-grass: linear-gradient(135deg, rgb(202, 248, 128) 0%, rgb(113, 206, 126) 100%);
            --wp--preset--gradient--midnight: linear-gradient(135deg, rgb(2, 3, 129) 0%, rgb(40, 116, 252) 100%);
            --wp--preset--duotone--dark-grayscale: url('#wp-duotone-dark-grayscale');
            --wp--preset--duotone--grayscale: url('#wp-duotone-grayscale');
            --wp--preset--duotone--purple-yellow: url('#wp-duotone-purple-yellow');
            --wp--preset--duotone--blue-red: url('#wp-duotone-blue-red');
            --wp--preset--duotone--midnight: url('#wp-duotone-midnight');
            --wp--preset--duotone--magenta-yellow: url('#wp-duotone-magenta-yellow');
            --wp--preset--duotone--purple-green: url('#wp-duotone-purple-green');
            --wp--preset--duotone--blue-orange: url('#wp-duotone-blue-orange');
            --wp--preset--font-size--small: 13px;
            --wp--preset--font-size--medium: 20px;
            --wp--preset--font-size--large: 36px;
            --wp--preset--font-size--x-large: 42px;
            --wp--preset--spacing--20: 0.44rem;
            --wp--preset--spacing--30: 0.67rem;
            --wp--preset--spacing--40: 1rem;
            --wp--preset--spacing--50: 1.5rem;
            --wp--preset--spacing--60: 2.25rem;
            --wp--preset--spacing--70: 3.38rem;
            --wp--preset--spacing--80: 5.06rem
        }

        :where(.is-layout-flex) {
            gap: .5em
        }

        body .is-layout-flow>.alignleft {
            float: left;
            margin-inline-start: 0;
            margin-inline-end: 2em
        }

        body .is-layout-flow>.alignright {
            float: right;
            margin-inline-start: 2em;
            margin-inline-end: 0
        }

        body .is-layout-flow>.aligncenter {
            margin-left: auto !important;
            margin-right: auto !important
        }

        body .is-layout-constrained>.alignleft {
            float: left;
            margin-inline-start: 0;
            margin-inline-end: 2em
        }

        body .is-layout-constrained>.alignright {
            float: right;
            margin-inline-start: 2em;
            margin-inline-end: 0
        }

        body .is-layout-constrained>.aligncenter {
            margin-left: auto !important;
            margin-right: auto !important
        }

        body .is-layout-constrained>:where(:not(.alignleft):not(.alignright):not(.alignfull)) {
            max-width: var(--wp--style--global--content-size);
            margin-left: auto !important;
            margin-right: auto !important
        }

        body .is-layout-constrained>.alignwide {
            max-width: var(--wp--style--global--wide-size)
        }

        body .is-layout-flex {
            display: flex
        }

        body .is-layout-flex {
            flex-wrap: wrap;
            align-items: center
        }

        body .is-layout-flex>* {
            margin: 0
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em
        }

        .has-black-color {
            color: var(--wp--preset--color--black) !important
        }

        .has-cyan-bluish-gray-color {
            color: var(--wp--preset--color--cyan-bluish-gray) !important
        }

        .has-white-color {
            color: var(--wp--preset--color--white) !important
        }

        .has-pale-pink-color {
            color: var(--wp--preset--color--pale-pink) !important
        }

        .has-vivid-red-color {
            color: var(--wp--preset--color--vivid-red) !important
        }

        .has-luminous-vivid-orange-color {
            color: var(--wp--preset--color--luminous-vivid-orange) !important
        }

        .has-luminous-vivid-amber-color {
            color: var(--wp--preset--color--luminous-vivid-amber) !important
        }

        .has-light-green-cyan-color {
            color: var(--wp--preset--color--light-green-cyan) !important
        }

        .has-vivid-green-cyan-color {
            color: var(--wp--preset--color--vivid-green-cyan) !important
        }

        .has-pale-cyan-blue-color {
            color: var(--wp--preset--color--pale-cyan-blue) !important
        }

        .has-vivid-cyan-blue-color {
            color: var(--wp--preset--color--vivid-cyan-blue) !important
        }

        .has-vivid-purple-color {
            color: var(--wp--preset--color--vivid-purple) !important
        }

        .has-black-background-color {
            background-color: var(--wp--preset--color--black) !important
        }

        .has-cyan-bluish-gray-background-color {
            background-color: var(--wp--preset--color--cyan-bluish-gray) !important
        }

        .has-white-background-color {
            background-color: var(--wp--preset--color--white) !important
        }

        .has-pale-pink-background-color {
            background-color: var(--wp--preset--color--pale-pink) !important
        }

        .has-vivid-red-background-color {
            background-color: var(--wp--preset--color--vivid-red) !important
        }

        .has-luminous-vivid-orange-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-orange) !important
        }

        .has-luminous-vivid-amber-background-color {
            background-color: var(--wp--preset--color--luminous-vivid-amber) !important
        }

        .has-light-green-cyan-background-color {
            background-color: var(--wp--preset--color--light-green-cyan) !important
        }

        .has-vivid-green-cyan-background-color {
            background-color: var(--wp--preset--color--vivid-green-cyan) !important
        }

        .has-pale-cyan-blue-background-color {
            background-color: var(--wp--preset--color--pale-cyan-blue) !important
        }

        .has-vivid-cyan-blue-background-color {
            background-color: var(--wp--preset--color--vivid-cyan-blue) !important
        }

        .has-vivid-purple-background-color {
            background-color: var(--wp--preset--color--vivid-purple) !important
        }

        .has-black-border-color {
            border-color: var(--wp--preset--color--black) !important
        }

        .has-cyan-bluish-gray-border-color {
            border-color: var(--wp--preset--color--cyan-bluish-gray) !important
        }

        .has-white-border-color {
            border-color: var(--wp--preset--color--white) !important
        }

        .has-pale-pink-border-color {
            border-color: var(--wp--preset--color--pale-pink) !important
        }

        .has-vivid-red-border-color {
            border-color: var(--wp--preset--color--vivid-red) !important
        }

        .has-luminous-vivid-orange-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-orange) !important
        }

        .has-luminous-vivid-amber-border-color {
            border-color: var(--wp--preset--color--luminous-vivid-amber) !important
        }

        .has-light-green-cyan-border-color {
            border-color: var(--wp--preset--color--light-green-cyan) !important
        }

        .has-vivid-green-cyan-border-color {
            border-color: var(--wp--preset--color--vivid-green-cyan) !important
        }

        .has-pale-cyan-blue-border-color {
            border-color: var(--wp--preset--color--pale-cyan-blue) !important
        }

        .has-vivid-cyan-blue-border-color {
            border-color: var(--wp--preset--color--vivid-cyan-blue) !important
        }

        .has-vivid-purple-border-color {
            border-color: var(--wp--preset--color--vivid-purple) !important
        }

        .has-vivid-cyan-blue-to-vivid-purple-gradient-background {
            background: var(--wp--preset--gradient--vivid-cyan-blue-to-vivid-purple) !important
        }

        .has-light-green-cyan-to-vivid-green-cyan-gradient-background {
            background: var(--wp--preset--gradient--light-green-cyan-to-vivid-green-cyan) !important
        }

        .has-luminous-vivid-amber-to-luminous-vivid-orange-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-amber-to-luminous-vivid-orange) !important
        }

        .has-luminous-vivid-orange-to-vivid-red-gradient-background {
            background: var(--wp--preset--gradient--luminous-vivid-orange-to-vivid-red) !important
        }

        .has-very-light-gray-to-cyan-bluish-gray-gradient-background {
            background: var(--wp--preset--gradient--very-light-gray-to-cyan-bluish-gray) !important
        }

        .has-cool-to-warm-spectrum-gradient-background {
            background: var(--wp--preset--gradient--cool-to-warm-spectrum) !important
        }

        .has-blush-light-purple-gradient-background {
            background: var(--wp--preset--gradient--blush-light-purple) !important
        }

        .has-blush-bordeaux-gradient-background {
            background: var(--wp--preset--gradient--blush-bordeaux) !important
        }

        .has-luminous-dusk-gradient-background {
            background: var(--wp--preset--gradient--luminous-dusk) !important
        }

        .has-pale-ocean-gradient-background {
            background: var(--wp--preset--gradient--pale-ocean) !important
        }

        .has-electric-grass-gradient-background {
            background: var(--wp--preset--gradient--electric-grass) !important
        }

        .has-midnight-gradient-background {
            background: var(--wp--preset--gradient--midnight) !important
        }

        .has-small-font-size {
            font-size: var(--wp--preset--font-size--small) !important
        }

        .has-medium-font-size {
            font-size: var(--wp--preset--font-size--medium) !important
        }

        .has-large-font-size {
            font-size: var(--wp--preset--font-size--large) !important
        }

        .has-x-large-font-size {
            font-size: var(--wp--preset--font-size--x-large) !important
        }

        .wp-block-navigation a:where(:not(.wp-element-button)) {
            color: inherit
        }

        :where(.wp-block-columns.is-layout-flex) {
            gap: 2em
        }

        .wp-block-pullquote {
            font-size: 1.5em;
            line-height: 1.6
        }
    </style>
    <style type="text/css" id="wp-custom-css" media="all">
        @media all and (min-width:1024px) {

            .plan-names.is-stuck,
            .pricing-row.is-stuck {
                z-index: 200001
            }
        }

        @media all and (max-width:1099px) {
            .hero-content {
                background-position: bottom right
            }
        }

        @media all and (max-width:1023px) {
            section.comparison-tables table tr.pricing-row a {
                width: auto
            }

            section.pricing-tables.version-v2 .plan-column .plan-cta {
                text-align: left
            }

            section.pricing-tables .plan-column .plan-cta a.button {
                width: auto
            }

            #stickytable .pricing-row.sticky>td:first-child {
                color: #828387;
                font-weight: 400
            }

            section.comparison-tables table tbody tr.pricing-row>td:first-child {
                font-weight: 400
            }
        }

        @media all and (max-width:400px) {
            section.pricing-tables .plan-column .plan-cta a.button {
                width: 100%
            }
        }

        .home .entry-content>.cards-block:first-child {
            padding: 30px 0;
            margin-bottom: 40px
        }

        #sidemenu.menu .button {
            position: relative;
            padding: 0
        }

        #sidemenu.menu .button a,
        #sidemenu.menu .button a:hover {
            color: white !important;
            padding: .7rem 1rem
        }

        .home .entry-content>.cards-block:first-child .card h5,
        .home .entry-content>.cards-block:first-child .card .card-image {
            display: none
        }

        .home .entry-content>.cards-block:first-child .card {
            background: transparent;
            border: 0;
            margin: 0
        }

        .home .entry-content>.cards-block:first-child .card p {
            margin: 0;
            color: #fff
        }

        .home .entry-content>.cards-block:first-child .card .card-section {
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center
        }

        .home .entry-content>.cards-block:first-child .inner-content>.cell {
            width: 46%
        }

        .home .entry-content>.cards-block:first-child .inner-content>.cell:first-child {
            width: 30%;
            padding-left: 0
        }

        .home .entry-content>.cards-block:first-child .inner-content>.cell:last-child {
            width: 15%;
            padding-right: 0
        }

        .home .entry-content>.cards-block:first-child .inner-content>.cell:last-child .card-section {
            justify-content: flex-end
        }

        .home .entry-content>.cards-block:first-child {
            padding: 30px 0
        }

        @media all and (max-width:1023px) {
            .home .entry-content>.cards-block:first-child .inner-content>.cell:last-child {
                display: none
            }

            .home .entry-content>.cards-block:first-child .inner-content>.cell {
                width: 50%
            }

            .home .entry-content>.cards-block:first-child .inner-content>.cell:first-child {
                width: 40%
            }
        }

        @media all and (max-width:767px) {
            .home .entry-content>.cards-block:first-child .inner-content>.cell:first-child {
                display: none
            }

            .home .entry-content>.cards-block:first-child .inner-content>.cell {
                width: 100%;
                padding: 0 30px
            }
        }

        section.press-releases>.grid-container>.grid-x {
            display: none
        }

        section.press-releases {
            padding-top: 2rem
        }

        section.testimonial-block .header-m {
            max-width: 80%;
            margin: 0 auto
        }

        .resource-content blockquote {
            border: 0;
            color: #2A2E30;
            font-family: 'ProximaNova ExtraBold', 'Helvetica Neue', Helvetica, Arial, sans-serif !important;
            font-size: 32px;
            font-weight: 800;
            letter-spacing: 0;
            line-height: 32px;
            padding: 0;
            margin: 30px 0
        }

        @media all and (min-width:1100px) {
            .resource-content blockquote {
                margin-left: -10%;
                margin-right: -10%;
                padding: 0 5%;
                padding-right: 1%
            }
        }

        .resource-content blockquote p {
            color: #2A2E30;
            line-height: 35px
        }

        @media all and (max-width:767px) {
            section.testimonial-block .testimonials .testimonial-content p {
                margin: 0;
                line-height: 39px;
                font-size: 20px;
                line-height: 23px
            }

            .home .hero-content h2+p a.button-large {
                margin-top: 5px
            }
        }

        ul.gallery {
            list-style: none !important
        }

        .page section.accordion-block .accordion-item .accordion-title::before {
            color: #777
        }

        section.comparison-tables table tr.pricing-row span strong {
            text-align: center;
            width: 100%
        }

        @media all and (max-width:1023px) {
            section.comparison-tables table tr.pricing-row span strong {
                text-align: right;
                width: 100%;
                padding-right: 5px
            }
        }

        .hide-site {
            display: none
        }

        .home .hide-home {
            display: none
        }

        .home .hide-site {
            display: block
        }

        .page-template-landing-pages-promo .menu-icon {
            display: none
        }

        .show-on-pricing {
            display: none
        }

        .page-pricing .show-on-pricing,
        .parent-pageid-60 .show-on-pricing {
            display: block
        }

        .page-pricing .hide-site,
        .parent-pageid-60 .hide-site {
            display: none
        }

        .page-pricing .hide-home,
        .parent-pageid-60 .hide-home {
            display: none
        }

        .mktoMobileShow .mktoForm,
        .mktoForm a {
            padding: 0 !important
        }

        .submenu a,
        .submenu.menu .active a {
            font-family: "ProximaNova Medium", "Helvetica Neue", Helvetica, Arial, sans-serif
        }

        .submenu a .menu-item-description,
        .submenu.menu .active a .menu-item-description {
            font-family: "ProximaNova Regular", "Helvetica Neue", Helvetica, Arial, sans-serif
        }

        section.two-columns.text-content li {
            font-size: 18px;
            line-height: 24px;
            margin-bottom: 10px
        }

        #wow-modal-window-2 {
            box-shadow: 0 10px 10px 0 rgba(0, 0, 0, .13), 0 14px 28px 0 rgba(0, 0, 0, .12) !important;
            bottom: 45px !important;
            right: 43px !important
        }

        span.wow-modal-close-2 {
            position: absolute;
            right: 20px;
            top: 20px;
            cursor: pointer
        }

        #menu-item-6529 svg {
            width: 24px;
            height: 24px
        }

        @media all and (max-width:767px) {
            #g2-crowd-widget-testimonial-14599 {
                height: 3800px !important
            }
        }

        .page-id-7868 .cards-block .card {
            border: 0;
            overflow: visible
        }

        .page-id-7868 .cards-block .card .card-section {
            padding: 0
        }

        @media all and (min-width:1150px) {
            .page-id-7868 .cards-block .cell h5 {
                white-space: nowrap;
                margin-top: 20px
            }

            .page-id-7868 .cards-block .cell {
                padding-right: 0;
                margin-right: 0
            }
        }

        @media all and (max-width:768px) {
            .page-id-7868 .cards-block .card .card-cta {
                text-align: center
            }

            .page-id-7868 .block-intro h3 {
                padding: 0 30px
            }
        }

        @media all and (min-width:1130px) {
            .page-id-60 h1 {
                font-size: 50px
            }
        }
    </style>
    <style media="all">
        .announcements {
            display: none
        }

        .home .announcements {
            display: block
        }

        .page-home .announcements {
            display: block
        }

        .page-cp .announcements {
            display: block
        }

        .announcements {
            color: #000;
            background-color: #CEDAFA;
            padding: 10px 0;
            font-family: 'ProximaNova Medium', 'Helvetica Neue', Helvetica, Arial, sans-serif
        }

        .announcements p {
            margin: 0
        }

        .announcements a {
            color: #000;
            text-decoration: underline
        }

        .top-bar-right.show-for-small ul.menu .menu-icon::after {
            background-image: url(https://www.svgrepo.com/show/532200/menu-alt.svg)
        }

        .top-bar-right.formobile ul.menu .menu-icon::after {
            background-image: url(https://www.svgrepo.com/show/532200/menu-alt.svg)
        }
    </style>
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-768371374" type="fvmdelay"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'AW-768371374');
    </script>
    <script type="fvmdelay">
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=!0;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f)})(window,document,'script','dataLayer','GTM-MWZVBR2')
</script>
    <style media="all">
        .bottom-cta {
            display: none
        }
    </style>
</head>

<body class="home page-template-default page page-id-9570 wp-custom-logo page-home-2"> <a class="show-for-sr"
        href="https://bitly.com/#content">Skip Navigation</a>
    <div class="off-canvas-wrapper" data-sticky-container>
        <div class="off-canvas position-right" id="off-canvas" data-off-canvas>
            <div class="top-bar" id="top-bar-menu-off-canvas">
                <div class="top-bar-left formobile">
                    <div class="branding" style="padding-bottom: 10%"></div>
                </div>
                <div class="top-bar-right formobile">
                    <ul class="menu">
                        <li><button class="menu-icon" type="button" data-toggle="off-canvas">aaaaaaa</button></li>
                    </ul>
                </div>
            </div>
            <ul id="offcanvas-nav" class="vertical menu accordion-menu" data-accordion-menu data-multi-open="false">

                <li id="menu-item-8815"
                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8815">
                    <a id="offcanvas-nav-products-2" href="index.php">Home</a>
                </li>
                <?php if (!isset($_SESSION['username'])) { ?>
                    <li id="menu-item-10676"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-10676"><a
                            id="offcanvas-nav-10676" href="login.php">Login</a></li> <?php } else { ?>
                    <li id="menu-item-10676"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-10676"><a
                            id="offcanvas-nav-10676" href="logout.php">Logout</a></li> <?php } ?>
                <?php if (!isset($_SESSION['username'])) { ?>
                    <li id="menu-item-8807"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-8807">
                        <a id="offcanvas-nav-resources-4" href="signup.php">Signup</a> <?php } ?>
                </li>
                <?php if (isset($_SESSION['username'])) { ?>
                    <li id="menu-item-8807"
                        class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-8807">
                        <a id="offcanvas-nav-resources-4" href="manage_url.php">Manage</a> <?php } ?>
                </li>
                <li id="menu-item-8815"
                    class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-8815">
                    <a id="offcanvas-nav-products-2" href="about.php">About</a>
                </li>
            </ul>
            <div id="text-7" class="widget widget_text">
                <div class="textwidget"></div>
            </div>
        </div>
        <div class="off-canvas-content" data-off-canvas-content>
            <header class="header sticky is-stuck" role="banner" data-sticky data-options="marginTop:0;"
                data-sticky-on="small" data-check-every="0">
                <div class="grid-container">
                    <div class="top-bar" id="top-bar-menu">
                        <div class="top-bar-left float-left branding"></div>
                        <div class="top-bar-right show-for-large">
                            <div class="nav-wrap">
                                <ul id="main-nav" class="medium-horizontal menu"
                                    data-responsive-menu="accordion medium-dropdown" data-closing-time="50">


                                </ul>
                                <ul id="sidemenu" class="medium-horizontal menu">
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-70"><a
                                            id="sidemenu-login" href="index.php">Home</a></li>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-70"><a
                                            id="sidemenu-login" href="about.php">About</a></li>
                                    <?php if (!isset($_SESSION['username'])) { ?>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-70"><a
                                                id="sidemenu-login" href="login.php">Log in</a></li>
                                        <li
                                            class="button menu-item menu-item-type-custom menu-item-object-custom menu-item-8991">
                                            <a id="sidemenu-get-a-quote-2" href="signup.php">Sign up</a>
                                        </li>
                                    <?php } else { ?>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-70"><a
                                                id="sidemenu-login" href="logout.php">Log out</a></li><?php } ?>
                                    <?php if (isset($_SESSION['username'])) { ?>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-70"><a
                                                id="sidemenu-login" href="manage_url.php">Manage</a></li><?php } ?>
                                    <!-- <?php if (isset($_SESSION['username'])) { ?>
                                        <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-70"><a
                                                id="sidemenu-login" href="all_ads.php">Ads Panel</a></li><?php } ?> -->

                                </ul>
                            </div>
                        </div>
                        <div class="top-bar-right float-right show-for-small hide-for-large">
                            <ul class="menu">
                                <li><button class="menu-icon" type="button" data-toggle="off-canvas">Menu</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>
            <hero>
                <div class="mobile-hero-wrap slim-special"> <img
                        src="https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/uploads/2022/10/homepage-hero-a-bit-closer-desktop-v2.png">
                </div>
            </hero>
            <div class="content" id="content">
                <div class="inner-content">
                    <main class="main" role="main">
                        <article id="post-9570" class="post-9570 page type-page status-publish hentry" role="article"
                            itemscope itemtype="http://schema.org/WebPage">
                            <div class="entry-content" itemprop="text">
                                <section class="free-hook-block V1">
                                    <div class="grid-container">
                                        <div class="block-intro"> </div>
                                        <center>
                                            <h5>Manage your QR codes and NFC's</h5>
                                        </center>

                                    </div>
                                </section>
                                <section class="three-columns text-content fancy-list rounded-cards"
                                    style="background-image:url();">

                                    <div class="grid-container" style="margin-top: 15px;">
                                        <div class="inner-content grid-x grid-margin-x grid-padding-x">
                                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                                <div class="cell large-4">
                                                    <div class="fancy-box">
                                                        <center>
                                                            <div class="icon-wrapper">
                                                                <i class="fas fa-qrcode"></i>
                                                            </div>
                                                            <span
                                                                class="redirect-url"><?php echo $row['redirect_url']; ?></span>
                                                        </center>
                                                        <p><a id="pricing_clicked_link_management"
                                                                class="button button-wide fancy-button"
                                                                href="edit_url.php?url_id=<?php echo $row['qr_id'] ?>">Edit</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>


                                        <?php if (mysqli_num_rows($result) == 0) { ?>
                                            <a id="pricing_clicked_link_management" class="button button-wide"
                                                href="add_url.php">Add new url</a>
                                        </div>
                                    <?php } ?>
                                </section>
                                <section class="content-divider">
                                    <div class="grid-container">
                                        <div class="cell">
                                            <hr>
                                        </div>
                                    </div>
                                </section>
                                <section class="content-divider">
                                    <div class="grid-container">
                                        <div class="cell">
                                            <hr>
                                        </div>
                                    </div>
                                </section>
                                <section class="content-divider">
                                    <div class="grid-container">
                                        <div class="cell">
                                            <hr>
                                        </div>
                                    </div>
                                </section>
                                <section class="content-divider">
                                    <div class="grid-container">
                                        <div class="cell">
                                            <hr>
                                        </div>
                                    </div>
                                </section>

                            </div>
                        </article>
                    </main>
                </div>
            </div>
            <section class="bottom-cta">
                <div id="custom_html-2" class="widget_text page-bottom widget widget_custom_html">
                    <div class="textwidget custom-html-widget">
                    </div>
                </div>
            </section>
            <footer class="footer" role="contentinfo">
                <div class="grid-container"> </div>
            </footer>
        </div>
    </div>
    <script src="asset/s/js/unauth.shorten.js" id="anon-short-js-v3-js" type="fvmdelay"></script>
    <script
        src="asset/static/1687458771/pages/wp-content/themes/JointsWP-CSS-master/assets/scripts/anonshort-script-v3.js"
        id="shorten-script-js-js"></script>
    <script src="asset/static/1687458771/pages/wp-content/themes/JointsWP-CSS-master/assets/scripts/back.min.js"
        id="back-js-js"></script>
    <script src="asset/static/1687458771/pages/wp-content/themes/JointsWP-CSS-master/assets/scripts/freehook.js"
        id="freehook-js3-js"></script>
    <script id="profitwell-js" data-pw-auth="36daba674ba5cfc0ff20888a386b766b" type="fvmdelay">
        (function(i,s,o,g,r,a,m){i[o]=i[o]||function(){(i[o].q=i[o].q||[]).push(arguments)};a=s.createElement(g);m=s.getElementsByTagName(g)[0];a.async=1;a.src=r+'?auth='+s.getElementById(o+'-js').getAttribute('data-pw-auth');m.parentNode.insertBefore(a,m)})(window,document,'profitwell','script','https://public.profitwell.com/js/profitwell.js');profitwell('start',{})
</script>
    <div class="icon-bag"></div>
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MWZVBR2" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <script id="hs-script-loader" async defer src="asset/26740822.js"></script>
    <div class="hide">
        <li class="promo-customize" style="display:none">
            <h5>Need more redirects, custom back-half links, or QR Codes?</h5> <a class="button button-primary"
                href="https://bitly.com/pages/pricing">Check out Starter Plan</a>
        </li>
    </div>
    <div class="reveal" id="qr-modal" aria-labelledby="modal-header" data-reveal>
        <div class="inner">
            <p class="lead" style="text-align:center"><img
                    src="https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/uploads/2022/06/qr-generator.png"
                    class="qr-img"></p>
            <h4 id="modal-header">Taking you to QR Code Generator, part of the Bitly family</h4>
            <div class="secondary progress" role="progressbar" aria-valuenow="0" aria-valuemin="0"
                aria-valuetext="0 percent" aria-valuemax="100">
                <div class="progress-meter"></div>
            </div>
            <p class="lead-off" style="text-align:center"><a
                    href="https://login.qr-code-generator.com/signup/?utm_source=bitly&utm_medium=referral&utm_campaign=brand-campaign-2022&utm_content=home"
                    style="color:#1d1f21;text-decoration:underline" class="qr-link">Click here if you don’t redirect in
                    5 seconds</a></p>
            <p class="lead-off" style="text-align:center"><img
                    src="https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/uploads/2021/08/bitly_logo.svg"
                    class="" alt="Bitly Logo" width="80"></p>
        </div>
    </div>
    <style media="all">
        .hero-content.slim-special {
            min-height: 435px
        }

        @media all and (max-width:1023px) {
            .slim-special img {
                opacity: 0;
                height: 100px
            }
        }

        .mobile-hero-wrap>img {
            margin: 0 auto
        }

        .scroll-for-more {
            display: none
        }

        h1.header-xl,
        h1,
        .header-xl {
            font-size: 28px;
            line-height: 32px
        }

        @media all and (min-width:992px) {

            h1.header-xl,
            h1,
            .header-xl {
                font-size: 40px;
                line-height: 48px
            }
        }

        .announcements {
            display: block
        }

        @media all and (max-height:770px) and (min-width:1024px) {
            .page-v2 .hero-content {
                min-height: 500px
            }
        }
    </style>
</body>

</html>