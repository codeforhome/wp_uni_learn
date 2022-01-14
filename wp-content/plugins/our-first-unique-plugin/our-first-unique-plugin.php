<?php

/*
    Plugin Name: Our Test Plugin
	Description:  A Truly amazin plugin
	version: 1.0
	Author: Brad
	Author URI: http://www.testplugin.com
 */

add_filter('the_content','addToEndofPost');

function addToEndofPost($content){
	if(is_single() && is_main_query()){
		return $content.'<p>My name is Brad</p>';
	}

	return $content;


}