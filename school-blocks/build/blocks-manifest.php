<?php
// This file is generated. Do not modify it manually.
return array(
	'animate-on-scroll' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'school-blocks/animate-on-scroll',
		'version' => '0.1.0',
		'title' => 'Animate on Scroll',
		'category' => 'widgets',
		'icon' => 'calendar',
		'description' => 'Wrap any block to animate when scrolled into the viewport.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'animation' => array(
				'type' => 'string',
				'default' => 'fade'
			)
		),
		'textdomain' => 'animate-on-scroll',
		'editorScript' => 'file:./index.js',
		'style' => 'file:./style-index.css',
		'viewScript' => 'file:./view.js'
	)
);
