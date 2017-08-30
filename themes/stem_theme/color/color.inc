<?php

/**
 * @file
 * Lists available colors and color schemes for the stem theme.
 */

$info = array(
  // Available colors and color labels used in theme.
  'fields' => array(
    'color' => t('Color Scheme'),
	'bg' => t('Main background'),
	'text' => t('Text color'),
  ),
  // Pre-defined color schemes.
  'schemes' => array(
    'default' => array(
      'title' => t('Default'),
      'colors' => array(
        'color' => '#e7d553',
		'bg' => '#ffffff',
		'text' => '#555555',
      ),
    ),
    'yellow' => array(
      'title' => t('Yellow'),
      'colors' => array(
        'color' => '#f8b632',
		'bg' => '#ffffff',
		'text' => '#555555',
      ),
    ),

    'blue' => array(
      'title' => t('Blue'),
      'colors' => array(
        'color' => '#31b9e0',
		'bg' => '#ffffff',
		'text' => '#555555',
      ),
    ),
	
    'green' => array(
      'title' => t('Green'),
      'colors' => array(
        'color' => '#1b880b',
		'bg' => '#ffffff',
		'text' => '#555555',
      ),
    ),
	
    'pink' => array(
      'title' => t('Pink'),
      'colors' => array(
        'color' => '#d0515c',
		'bg' => '#ffffff',
		'text' => '#555555',
      ),
    ),
	
    'orange' => array(
      'title' => t('Orange'),
      'colors' => array(
        'color' => '#e13800',
		'bg' => '#ffffff',
		'text' => '#555555',
      ),
    ),

    'red' => array(
      'title' => t('Red'),
      'colors' => array(
        'color' => '#cf0a2c',
		'bg' => '#ffffff',
		'text' => '#555555',
      ),
    ),

    'brown' => array(
      'title' => t('Brown'),
      'colors' => array(
        'color' => '#5b4035',
		'bg' => '#ffffff',
		'text' => '#555555',
      ),
    ),		
	
  ),

  // CSS files (excluding @import) to rewrite with new color scheme.
  'css' => array(
    'assets/css/colors.css',
  ),

  // Files to copy.
  'copy' => array(
    'logo.svg',
  ),

  // Gradient definitions.
  'gradients' => array(
    array(
      // (x, y, width, height).
      'dimension' => array(0, 0, 0, 0),
      // Direction of gradient ('vertical' or 'horizontal').
      'direction' => 'vertical',
      // Keys of colors to use for the gradient.
      'colors' => array('top', 'bottom'),
    ),
  ),

  // Preview files.
  'preview_library' => 'stem_theme/color.preview',
  'preview_html' => 'color/preview.html',

  // Attachments.
  '#attached' => [
    'drupalSettings' => [
      'color' => [
        // Put the logo path into JavaScript for the live preview.
        'logo' => theme_get_setting('logo.url', 'stem_theme'),
      ],
    ],
  ],
);
