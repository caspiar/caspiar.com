<?php

/**
 * Home page
 * Master script for all pages. The htaccess file redirects all requests through here.
 * This script prints initial page content, which is then manipulated by the referenced js files after pageload.
 * 
 **/

/* Turn off caching */
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
 
/* Define web-root of AWS images */
$img_base = 'https://s3.amazonaws.com/caspiar/img/';

/* Define host-specific settings */
require_once 'includes/host_specific_settings.php';

/* Define all page content */
require_once 'includes/all_page_content.php';

/* Determine which page should be loaded initially */
require_once 'includes/determine_initial_page.php';

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php print $all_pages[$page_chosen]['title'].' | '.$site_name;?></title>
    <base href="<?php print $ws_root; ?>" target="_self" />
    <meta http-equiv="content-language" content="en-us" />
    <meta name="description" content="<?php print $all_pages[$page_chosen]['meta_description']; ?>" />
    <meta name="keywords" content="<?php print $all_pages[$page_chosen]['meta_description']; ?>" />
    <meta property="og:title" content="<?php print  $all_pages[$page_chosen]['title']; ?>" />
    <meta property="og:url" content="http://<?php print $site_url.'/'.$og_url; ?>" />
    <meta property="og:image" content="<?php print $img_base.'medium/'.$all_pages[$page_chosen]['url'].'.jpg'; ?>" />
    <meta property="og:description" content="<?php print $all_pages[$page_chosen]['meta_description']; ?>" />
    <meta property="og:site_name" content="<?php print $site_name; ?>" />
    <link type="image/x-icon" rel="shortcut icon"  href="favicon.ico" />  
    <link href='http://fonts.googleapis.com/css?family=Maven+Pro:500' rel='stylesheet' type='text/css' /> 
    <link type="text/css" href="css/reset.css" rel="stylesheet" />		
    <link type="text/css" href="css/style.css?randkey=<?php print rand(1,000).time();?>" rel="stylesheet" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/detect_ie.js"></script>
    <script type="text/javascript" src="js/core.js?randkey=<?php print rand(1,000).time();?>"></script>
    <script type="text/javascript" src="js/analytics.js"></script>

    <!--[if lt IE 9]>
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <link type="text/css" href="css/ie.css?randkey=<?php print rand(1,000).time();?>" rel="stylesheet" />
    <![endif]-->   
</head>
<body id="body">
    <img id="loading_icon" src="img/loading.gif"  alt="Loading" />
    <div id="banner">
        <img id="logo" src="img/logo.png" alt="Caspiar logo" />
        <div id="main_menu">
            <div class="element" id="main_menu_home">
                <div class="background">Home</div>
            </div>
            <div class="element" id="main_menu_about">
                <div class="background">What We Do</div>
            </div>
            <div class="element" id="main_menu_contact">
                <div class="background">Contact Us</div>
            </div>
            <div class="element" id="main_menu_careers">
                <div class="background">Careers</div>
            </div>
            <div class="element" id="main_menu_login">
                <div class="background">Client Login</div>
            </div>
            <div class="element" id="main_menu_ftw">
                <div class="background">#FTW</div>
            </div>
        </div>
    </div>
    <div id="blurb">
        <div id="headline"><?php print $all_pages[$page_chosen]['headline']; ?></div>
        <div id="blurb_content"><?php print $all_pages[$page_chosen]['blurb']; ?></div>
    </div>
    <input type="hidden" name="hidden_site_name" id="hidden_site_name" value="<?php print $site_name; ?>" />
    <input type="hidden" name="hidden_site_url" id="hidden_site_url" value="<?php print $site_url; ?>" />
    <input type="hidden" name="hidden_site_rel_base" id="hidden_site_rel_base" value="<?php print $ws_relative_base; ?>" />
    <input type="hidden" name="hidden_img_base" id="hidden_img_base" value="<?php print $img_base; ?>" />
    <input type="hidden" name="hidden_ws_root" id="hidden_ws_root" value="<?php print $ws_root; ?>" />
    <input type="hidden" name="hidden_initial_page" id="hidden_initial_page" value="<?php print $page_chosen; ?>" />
    <input type="hidden" name="hidden_current_page" id="hidden_current_page" value="<?php print $page_chosen; ?>" />
    <?php
    foreach($all_pages as $key => $values){
        $value = json_encode($values); 
        print '<input type="hidden" name="hidden_page_content_'.$key.'" id="hidden_page_content_'.$key.'" value=\''.$value.'\' />'.PHP_EOL;
    }
    ?>
</body>
</html>