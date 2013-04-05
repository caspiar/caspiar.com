<?php

/**
 * Define all page content
 * The site uses no database or datafile to store page-content. It is all hardcoded in here.
 *
 * WARNING: Don't write unescaped apostrophes in your array.
 * 
 **/


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