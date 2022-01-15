<?php

/*
    Plugin Name: Our Test Plugin
	Description:  A Truly amazin plugin
	version: 1.0
	Author: Brad
	Author URI: http://www.testplugin.com
 */

//add_filter('the_content','addToEndofPost');
//
//function addToEndofPost($content){
//	if(is_single() && is_main_query()){
//		return $content.'<p>My name is Brad</p>';
//	}
//
//	return $content;
//
//
//}

class WordCountAndTimePlugin {
	function __construct(){
		add_action('admin_menu',array($this, 'adminPage'));
		add_action('admin_init',array($this, 'settings'));
	}

	function settings() {
		add_settings_section('wcp_first_section', null, null, 'word-count-setting-page');
		add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-setting-page', 'wcp_first_section');
		register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => 'sanitize_text_field', 'default' => '0'));
	}

	function adminPage() {
		add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-setting-page', array($this, 'ourHTML'));
	}

	function ourHTML() { ?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="POST">
				<?php
				settings_fields('wordcountplugin');
				do_settings_sections('word-count-setting-page');
				submit_button();
				?>
            </form>
        </div>
	<?php }



	function locationHTML(){ ?>

        <select name="wcp_location" >
            <option value="0">Beginning of post</option>
            <option value="1">End of post</option>
        </select>

	<?php }

}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();




