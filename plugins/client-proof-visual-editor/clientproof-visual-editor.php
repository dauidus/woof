<?php
/*
Plugin Name: Client-proof Visual Editor
Plugin URI: http://github.com/hugobaeta/client-proof-visual-editor
Version: 1.3
Author: Hugo Baeta
Author URI: http://hugobaeta.com
Description: Simple, option-less, plugin to make TinyMCE - the WordPress Visual Editor - easier for clients and n00bs.
*/

function clientproof_visual_editor( $mceInit ) {
	//@see http://wiki.moxiecode.com/index.php/TinyMCE:Control_reference
	$mceInit['block_formats'] = 'Header 2=h2;Header 3=h3;Header 4=h4;Paragraph=p;Code=code';
	$mceInit['toolbar1'] = 'bold,italic,strikethrough,formatselect,bullist,numlist,blockquote,link,unlink,hr,wp_more,wp_fullscreen';
	$mceInit['toolbar2'] = '';
	$mceInit['toolbar3'] = '';
	$mceInit['toolbar4'] = '';
	$mceInit['paste_as_text'] = 'true';

	return $mceInit;
}

add_filter('tiny_mce_before_init', 'clientproof_visual_editor');
?>