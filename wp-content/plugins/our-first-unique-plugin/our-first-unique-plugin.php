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
		add_filter('the_content',array($this, 'ifWrap'));
	}

	function ifWrap($content){
	    if((is_main_query() AND is_single()) AND (
	            get_option('wcp_wordcount','1') OR
                get_option('wcp_readtime','1') OR
                get_option('wcp_charactercount','1')
            )){

	        return $this->createHTML($content);
        }
	    return $content;
    }

    function createHTML($content){
	    $html = '<h3>'.esc_html(get_option('wcp_headline', 'Post Statistics')).'</h3><p>';

	    //get word count once because both wordcount and read time will need it
	    if( get_option('wcp_wordcount','1') OR  get_option('wcp_readtime','1')){
		    $wordcount = str_word_count(strip_tags($content));

	    }

	    if(get_option('wcp_wordcount', '1')){
            $html .= 'This post had '. $wordcount . ' words.<br>';
        }
	    if(get_option('wcp_charactercount', '1')){
		    $html .= 'This post had '. strlen(strip_tags($content)) . ' Characters.<br>';
	    }

	    if(get_option('wcp_readtime', '1')){
		    $html .= 'This post will take about  '. round($wordcount/225,1) . ' minute(s) to read.<br>';
	    }

	    $html .= '</p>';
	    if(get_option('wcp_location','0') == '0'){
	        return $html. $content;
        }
	    return  $content.$html;
    }

	function settings() {
		add_settings_section('wcp_first_section', null, null, 'word-count-settings-page');

		add_settings_field('wcp_location', 'Display Location', array($this, 'locationHTML'), 'word-count-settings-page', 'wcp_first_section');
		register_setting('wordcountplugin', 'wcp_location', array('sanitize_callback' => array($this,'sannitizeLocation'), 'default' => '0'));

		add_settings_field('wcp_headline', 'Headline Text', array($this, 'headlineHTML'), 'word-count-settings-page', 'wcp_first_section');
		register_setting('wordcountplugin', 'wcp_headline', array('sanitize_callback' => 'sanitize_text_field', 'default' => 'Post Statistic'));

		add_settings_field('wcp_wordcount', 'Word Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_wordcount'));
		register_setting('wordcountplugin', 'wcp_wordcount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

		add_settings_field('wcp_charactercount', 'Character Count', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_charactercount'));
		register_setting('wordcountplugin', 'wcp_charactercount', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));

		add_settings_field('wcp_readtime', 'Read Time', array($this, 'checkboxHTML'), 'word-count-settings-page', 'wcp_first_section', array('theName' => 'wcp_readtime'));
		register_setting('wordcountplugin', 'wcp_readtime', array('sanitize_callback' => 'sanitize_text_field', 'default' => '1'));


	}

	function sannitizeLocation($input){
	    if($input != '0' AND $input != '1'){
	        add_settings_error('wcp_location','wcp_location_error','Display location must be either beginning or end.');
            return get_option('wcp_location');
	    }
	    return $input;
    }

	function headlineHTML(){?>
        <input type="text" name="wcp_headline" value="<?php echo esc_attr(get_option('wcp_headline')) ?>">

  <?php  }

    //reusable checkbox function
    function checkboxHTML($args){ ?>
        <input type="checkbox" name="<?php echo $args['theName'] ?>" value="1" <?php checked(get_option($args['theName']), '1') ?>>
   <?php }

    /*
    function wordcountHTML(){?>
        <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount'), '1') ?>>
    <?php }

	function charactercountHTML(){?>
        <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount'), '1') ?>>
	<?php }

	function wcp_readtimeHTML(){?>
        <input type="checkbox" name="wcp_wordcount" value="1" <?php checked(get_option('wcp_wordcount'), '1') ?>>
	<?php }
*/


	function adminPage() {
		add_options_page('Word Count Settings', 'Word Count', 'manage_options', 'word-count-settings-page', array($this, 'ourHTML'));
	}

	function ourHTML() { ?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="POST">
				<?php
				settings_fields('wordcountplugin');
				do_settings_sections('word-count-settings-page');
				submit_button();
				?>
            </form>
        </div>
	<?php }



	function locationHTML(){ ?>

        <select name="wcp_location" >
            <option value="0" <?php selected(get_option('wcp_location', '0')); ?>>Beginning of post</option>
            <option value="1" <?php selected(get_option('wcp_location', '1')); ?>>End of post</option>
        </select>



	<?php }

}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();




