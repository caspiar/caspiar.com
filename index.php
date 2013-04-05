<?php

/* Define AWS settings */
$img_base = 'https://s3.amazonaws.com/caspiar/img/';

/* Define sites-specific settings */
switch($_SERVER['HTTP_HOST'])
	{
	// localhost
	case 'localhost:8888' :
	case 'localhost' :	
            $site_name = 'Caspiar';
            $site_url = 'caspiar.com';
            $ws_root = 'http://localhost:8888/caspiar/';
            $ws_relative_base = '/caspiar/';
	break;

	// caspiar.com
	case 'caspiar.com' :
	case 'www.caspiar.com' :	
            $site_name = 'Caspiar';
            $site_url = 'caspiar.com';
            $ws_root = 'http://caspiar.com/';
            $ws_relative_base = '/';
	break;
	
	}

/* Load in all page content */
## WARNING: DON'T PUT IN UNESCAPED APOSTROPHES
$all_pages = array(
  'home' => array(
    'url' => 'home',
    'title' => 'Winning feels awesome. We&#39;ll get you there!',
    'blurb' => '<a class="call_to_action" href="about">We&#39;ll get you there.</a>',
    'headline' => '<span class="white">Winning<br />Feels<br />Awesome.</span>',
    'meta_description' => 'Welcome to Caspiar, a full-service marketing agency in San Francisco. We specialize in web-development, app development, and campaign management. Contact us today to start a conversation.'
    ),
  'about' => array(
    'url' => 'about',
    'title' => 'A full service marketing agency',
    'blurb' => '<p>Sites, apps, campaigns.<br />Whatever you need.</p><a class="call_to_action" href="contact">Bring us your ideas.</a>',
    'headline' => 'Full Service<br />Marketing',
    'meta_description' => 'If you&#39;ve got a tech idea, Caspiar has a solution. We believe in agile software development, effective campaign managent, and responsive customer service. Whether you need a little advice, or a large team, Caspiar can help.'
    ),
  'contact' => array(
    'url' => 'contact',
    'title' => 'Start a conversation',
    'blurb' => '<p>1.800.390.7805</p><p>50 California st.<br />Suite #1538<br />San Francisco, CA 94111</p><p>info@caspiar.com</p>',
    'headline' => 'Start a<br />Conversation',
    'meta_description' => 'Reach out and contact us anytime. Our offices are located at 50 California St. Suite #1538. San Francisco, CA 94111. Or feel free to give us a call, shoot us an email, or send us a tweet.'
    ),
  'careers' => array(
    'url' => 'careers',
    'title' => 'Join us for a sprint',
    'blurb' => '<p>Got talent? Tweet at us:</p><a class="call_to_action" href="http://twitter.com/team_caspiar" target="_blank">@team_caspiar</a><p>If you can&#39;t explain why <br />you&#39;re awesome in less<br />than 140 characters,<br />you don&#39;t belong in<br />marketing.</p>',
    'headline' => 'Sprint with Us',
    'meta_description' => 'Caspiar is now hiring talented engineers, creative marketers, aggressive sales people, and aspiring interns. Contact us for more information.'
    ),
  'login' => array(
    'url' => 'login',
    'title' => 'Access your account',
    'blurb' => '<p>Coming soon...</p>',
    'headline' => 'Access Your<br />Account',
    'meta_description' => 'Login to access your Caspiar account. If you&#39;ve forgotted your username or password, please contact us.'
    ),
  'ftw' => array(
    'url' => 'ftw',
    'title' => '#FTW! Our For the Win, For the Week!',
    'blurb' => '<p>This week, we&#39;d like to<br />shoutout:</p><a class="call_to_action" href="http://lucidchart.com" target="_blank">LucidChart.com</a><p>...for their elegant<br />HTML5 flowcharting tool.<br /><br />Very impressive.</p>',
    'headline' => '#FTW OF THE WEEK',
    'meta_description' => 'Every week, we post the most awesome, amazballs, #ftw thing we&#39;ve come across. This weeks winner: LucidChart!'
    )
);


/* Determine which page should be loaded initially */
$page_chosen = null;
if(isset($_GET['url'])){
    foreach($all_pages as $key => $values){
        if(preg_replace("/[^a-zA-Z0-9\_\-]/","", $_GET['url']) == $values['url']){
            $page_chosen = $values['url'];
        }
    }
}
$page_chosen = ($page_chosen ? $page_chosen : 'home');
$og_url = (($all_pages[$page_chosen]['url'] == 'home') ? '' : $all_pages[$page_chosen]['url']);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title><?php print $all_pages[$page_chosen]['title'].' | '.$site_name;?></title>
    <base href="<?php print $ws_root; ?>" target="_self">
    <meta http-equiv="content-language" content="en-us" />
    <meta name="description" content="<?php print $all_pages[$page_chosen]['meta_description']; ?>" />
    <meta name="keywords" content="<?php print $all_pages[$page_chosen]['meta_description']; ?>" />
    <meta property="og:title" content="<?php print  $all_pages[$page_chosen]['title']; ?>" />
    <meta property="og:url" content="http://<?php print $site_url.'/'.$og_url; ?>" />
    <meta property="og:image" content="<?php print $img_base.'medium/'.$all_pages[$page_chosen]['url'].'.jpg'; ?>" />
    <meta property="og:description" content="<?php print $all_pages[$page_chosen]['meta_description']; ?>" />
    <meta property="og:site_name" content="<?php print $site_name; ?>" />
    <link type="image/x-icon" rel="shortcut icon"  href="favicon.ico" />  
    <link href='http://fonts.googleapis.com/css?family=Maven+Pro:500' rel='stylesheet' type='text/css'> 
    <link type="text/css" href="css/reset.css" rel="stylesheet" />		
    <link type="text/css" href="css/style.css" rel="stylesheet" />
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/core.js"></script>
    <script type="text/javascript" src="js/analytics.js"></script>
    <!--[if lt IE 9]>
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->   
</head>
<body>
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