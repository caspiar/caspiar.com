<?php

/**
 * Host switch
 * Define your host-specific settings here. 
 * 
 **/

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