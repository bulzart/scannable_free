<!-- <?php
// Error reporting settings
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Starting the session
include 'connection.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $targetDir = "uploads/";

    // Ensure the uploads directory exists
    if (!file_exists($targetDir) && !mkdir($targetDir, 0777, true)) {
        die("Failed to create directory: $targetDir");
    }

    $fileName = basename($_FILES["fileToUpload"]["name"]);
    $targetFile = $targetDir . $fileName;
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check file size (limit to 5MB)
    if ($_FILES["fileToUpload"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Check file type
    $allowedFileTypes = ["mp4", "mov", "avi", "jpg", "jpeg", "png", "gif"];
    if (!in_array($fileType, $allowedFileTypes)) {
        echo "Sorry, only MP4, MOV, AVI, JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Generate a unique file name to avoid overwriting existing files
        $uniqueFileName = uniqid() . "_" . $fileName;
        $uniqueTargetFile = $targetDir . $uniqueFileName;

        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uniqueTargetFile)) {
            // Sanitize user input to prevent SQL injection
            $displayCount = filter_var($_POST['displayCount'], FILTER_VALIDATE_INT);

            if ($displayCount === false) {
                echo "Invalid display count.";
            } else {
                // Insert file details into the database using prepared statements
                $insertQuery = "INSERT INTO ad_files (file_name, file_type, display_count) VALUES (?, ?, ?)";
                $stmt = $connection->prepare($insertQuery);
                $stmt->bind_param("ssi", $uniqueFileName, $fileType, $displayCount);

                if ($stmt->execute()) {
                    echo "The file $fileName has been uploaded and will be displayed $displayCount times. Stored in the database.";
                } else {
                    echo "Sorry, there was an error uploading your file to the database.";
                }

                $stmt->close();
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

mysqli_close($connection);
?>

<!DOCTYPE HTML>
<html lang="en-US">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge" http-equiv="X-UA-Compatible" />
    <meta name="referrer" content="origin" />
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
            background-image: url(https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/themes/JointsWP-CSS-master/assets/foundation-icons/svgs/feather-icon-menu.svg)
        }

        .top-bar-right.formobile ul.menu .menu-icon::after {
            background-image: url(https://docrdsfx76ssb.cloudfront.net/static/1687458771/pages/wp-content/themes/JointsWP-CSS-master/assets/foundation-icons/svgs/feather-icon-x.svg)
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>All Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            padding: 20px;
            background-color: #fff;
            margin-top: 100px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #ddd;
        }

        .button-create {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .title {
            font-size: 24px;
            margin: 0;
        }

        .create-button {
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* Media Query for Phones */
        @media (max-width: 767px) {
            .container {
                margin-top: 50px;
            }

            .header,
            .button-create {
                padding: 10px;
            }

            .title {
                font-size: 20px;
            }

            .create-button {
                padding: 6px 12px;
            }
        }
    </style>

    <title>Artwear</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container-header {
            background-color: #fff;
            padding: 20px;
            text-align: center;
        }

        .container-box {
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
        }

        input[type="file"],
        input[type="number"],
        input[type="submit"] {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 100%;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>



    <link rel="icon" type="image/png" href="" />

    <meta name="viewport" content="width=device-width,minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">


    <link rel="stylesheet" href="asset/bitly2/17BADEBB7C21D5F4FD125352FB4499EFABC75663.css">












</head>

<body class="registration-pages sign_in">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.success-banner').fadeIn('slow');
            setTimeout(function () {
                $('.success-banner').fadeOut('slow');
            }, 3000);
        });
        $(document).ready(function () {
            $('.success-banner2').fadeIn('slow');
            setTimeout(function () {
                $('.success-banner2').fadeOut('slow');
            }, 3000);
        });
    </script>

    <noscript>
        <img src="https://ad.doubleclick.net/ddm/activity/src=12389169;type=conve0;cat=signu0;u1=[Plan Tier];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;tfua=;npa=;gdpr=${GDPR};gdpr_consent=${GDPR_CONSENT_755};ord=1?"
            width="1" height="1" alt="" />
    </noscript>

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
                                        <a id="sidemenu-get-a-quote-2" href="signup.php">Sign up</a></li>
                                <?php } else { ?>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-70"><a
                                            id="sidemenu-login" href="logout.php">Log out</a></li><?php } ?>
                                <?php if (isset($_SESSION['username'])) { ?>
                                    <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-70"><a
                                            id="sidemenu-login" href="manage_url.php">Manage</a></li><?php } ?>
                                <!-- <?php if (isset($_SESSION['username'])) { ?><li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-70"><a id="sidemenu-login" href="all_ads.php">Multimedia</a></li><?php } ?> -->

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

<div class="container-header">
    <h2 class=""><a href="https://artwear.co.za" style="text-decoration:none; color:black" rel="nofollow">Artwear</a>
    </h2>
    <div class="signup-flow-container hidden">
        <span class="signup-flow-elem em">Create an <br class="signup-flow-br">account</span>
        <hr>
        <span class="signup-flow-elem"> Enter payment <br class="signup-flow-br">information</span>
        <hr>
        <span class="signup-flow-elem">Get your free <br class="signup-flow-br">domain</span>
    </div>
</div>
<div class="signup-flow-container hidden post-header">
    <span class="signup-flow-elem em">Create an <br class="signup-flow-br">account</span>
    <hr>
    <span class="signup-flow-elem"> Enter payment <br class="signup-flow-br">information</span>
    <hr>
    <span class="signup-flow-elem">Get your free <br class="signup-flow-br">domain</span>
</div>
<div class="container-box title">

    <div class="t-center">

        <span class="switch to-sign-in" tabindex="8">
            <span class="gray-link">Already have an account?</span>
            <br class="br">
            <a id="sign-in-link" href="https://bitly.com//a/sign_in">Log in</a>
            <span>&bull;</span>
            <span class="switch"><a id="sso-sign-in-link-top" href="https://bitly.com//sso/url_slug" tabindex="9">Log in
                    with SSO</a></span>
        </span>
    </div>
</div>
<div class="container-box">

    <?php if (!empty($errorMessage)): ?>
        <div class="error-message">
            <?php echo $errorMessage; ?>
        </div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">


        <input type="file" name="fileToUpload" id="fileToUpload">
        <br>
        Number of times to display: <input type="number" name="displayCount" min="1">
        <input type="submit" name="submit" class="button button-primary sign-up-in" value="Upload">

    </form>

</div>
</div>




<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="asset/bitly2/FAA16645610A1B983A0D2D86A506687C1273062F.js"></script>
<script type="text/javascript" src="asset/bitly2/F2646B87E57084653A49DC39069E1F63751169F4.js"></script>
<script type="text/javascript" src="asset/bitly2/DC48A284F7A5AC5604D42ED052CAD24392789DCB.js"></script>
<script type="text/javascript" src="asset/bitly2/132D7290946D6B91858A8479F5D7E2E479A2F090.js"></script>
<script type="text/javascript" src="asset/bitly2/D0BB1779B2B982C44A0324259497832B80101BDE.js"></script>
<script type="text/javascript" src="asset/bitly2/2071816E49F66173069ABF96EC1CCDB1CA98AD0D.js"></script>





<script type="text/javascript">
    (function (i, s, o, g, r, a, m) {
        i["GoogleAnalyticsObject"] = r; i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date(); a = s.createElement(o),
            m = s.getElementsByTagName(o)[0]; a.async = 1; a.src = g; m.parentNode.insertBefore(a, m)
    })(window, document, "script", "//www.google-analytics.com/analytics.js", "ga");

    (function (w, d) {

        var gaId = "UA-25224921-3";



        w.ga("create", gaId, "auto");



        var accountType = "user";


        w.ga("set", "dimension2", accountType);


        w.ga("send", "pageview");
    })(window, document);
</script>



<script async src="https://www.googletagmanager.com/gtag/js?id=G-567GCTL9BB"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() { window.dataLayer.push(arguments); }
    gtag("js", new Date());
    gtag("config", "G-567GCTL9BB", {
        send_page_view: true
    });
    gtag("config", "AW-768371374");
    gtag("config", "DC-12998045");

    gtag("config", "DC-12389169");
</script>


<script>
    !function (f, b, e, v, n, t, s) {
        if (f.fbq) return; n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = "2.0";
        n.queue = []; t = b.createElement(e); t.async = !0;
        t.src = v; s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window, document, "script",
        "https://connect.facebook.net/en_US/fbevents.js");
    fbq("init", "575684804151769");
    fbq("track", "PageView");
</script>
<noscript>
    <img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=575684804151769&ev=PageView&noscript=1" />
</noscript>
<script type="text/javascript">
    _linkedin_partner_id = "3409844";
    window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
    window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script>
<script type="text/javascript">
    (function (l) {
        if (!l) {
            window.lintrk = function (a, b) { window.lintrk.q.push([a, b]) };
            window.lintrk.q = []
        }
        var s = document.getElementsByTagName("script")[0];
        var b = document.createElement("script");
        b.type = "text/javascript"; b.async = true;
        b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
        s.parentNode.insertBefore(b, s);
    })(window.lintrk);
</script>
<noscript>
    <img height="1" width="1" style="display:none;" alt=""
        src="https://px.ads.linkedin.com/collect/?pid=3409844&fmt=gif" />
</noscript>

<script>
    !function (e, t, n, s, u, a) {
        e.twq || (s = e.twq = function () {
            s.exe ? s.exe.apply(s, arguments) : s.queue.push(arguments);
        }, s.version = '1.1', s.queue = [], u = t.createElement(n), u.async = !0, u.src = '//static.ads-twitter.com/uwt.js',
            a = t.getElementsByTagName(n)[0], a.parentNode.insertBefore(u, a))
    }(window, document, 'script');

    twq("init", "o2pdk");
    twq("track", "PageView");
</script>

<script>

    (function (w, d) {
        var id = 'pdst-capture', n = 'script';
        if (!d.getElementById(id)) {
            w.pdst =
                w.pdst ||
                function () {
                    (w.pdst.q = w.pdst.q || []).push(arguments);
                };
            var e = d.createElement(n); e.id = id; e.async = 1;
            e.src = 'https://cdn.pdst.fm/ping.min.js';
            var s = d.getElementsByTagName(n)[0];
            s.parentNode.insertBefore(e, s);
        }
        w.pdst('conf', { key: "96312ad4d097468aab67dc86ba4c34fd" });
        w.pdst('view');
    })(window, document);
</script>


<script>

    (function (w, d, t, r, u) {
        var f, n, i;
        w[u] = w[u] || [], f = function () {
            var o = { ti: "", enableAutoSpaTracking: true };
            o.q = w[u], w[u] = new UET(o), w[u].push("pageLoad")
        },
            n = d.createElement(t), n.src = r, n.async = 1, n.onload = n.onreadystatechange = function () {
                var s = this.readyState;
                s && s !== "loaded" && s !== "complete" || (f(), n.onload = n.onreadystatechange = null)
            },
            i = d.getElementsByTagName(t)[0], i.parentNode.insertBefore(n, i)
    })
        (window, document, "script", "//bat.bing.com/bat.js", "uetq");

</script>

</body>

</html>










<script>

    var inputs = $('#sign-in').find('input');
    var errorMessage = $('.error-message');


    function clearErrors() {
        errorMessage.addClass('hidden');
    }


    inputs.on('input', clearErrors);
</script> -->