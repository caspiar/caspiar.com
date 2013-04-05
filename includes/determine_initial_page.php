<?php

/**
 * Define initial page content
 * The htaccess file rewrites any url as a $_GET parameter.
 * This script checks for a match between the url parameter and the predefined pages (writen in all_page_content.php)
 *
 **/

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