<?php

/**
 * @file
 * Lists available colors and color schemes for the used_cars theme.
 */

$info = [
  // Available colors and color labels used in theme.
  'fields' => [
    'top' => t('Header background top'),
    'bg' => t('Main background'),
    'menu_hover' => t('Main menu hover'),
    'elements_color' => t('Elements color'),
    'color_button' => t('Color buttons'),
    'color_button_hover' => t('Color buttons hover'),
    'footer' => t('Footer background'),
    'titleslogan' => t('Title and slogan'),
    'text' => t('Text color'),
    'link' => t('Link color'),
    'sidebar' => t('Sidebar background'),
  ],
  // Pre-defined color schemes.
  'schemes' => [
    'default' => [
      'title' => t('White'),
      'colors' => [
        'top' => '#ffffff',
        'bg' => '#f8f8f8',
        'menu_hover' => '#003e55',
        'elements_color' => '#d50124',
        'color_button' => '#d50125',
        'color_button_hover' => '#000000',
        'footer' => '#003e55',
        'titleslogan' => '#fffeff',
        'text' => '#fffff3',
        'link' => '#000002',
        'sidebar' => '#ffffff',
      ],
    ],
    'blue' => [
      'title' => t('Blue'),
      'colors' => [
        'top' => '#398cf2',
        'bg' => '#066490',
        'menu_hover' => '#000000',
        'elements_color' => '#12abf1',
        'color_button' => '#000001',
        'color_button_hover' => '#202020',
        'footer' => '#2c2c28',
        'titleslogan' => '#fffeff',
        'text' => '#fffff1',
        'link' => '#fffff2',
        'sidebar' => '#12abf2',
      ],
    ],

    'firehouse' => [
      'title' => t('Red'),
      'colors' => [
        'top' => '#e40028',
        'bg' => '#942205',
        'menu_hover' => '#000000',
        'elements_color' => '#d14242',
        'color_button' => '#000000',
        'color_button_hover' => '#202020',
        'footer' => '#2c2c28',
        'titleslogan' => '#fffeff',
        'text' => '#ffffff',
        'link' => '#ffffff',
        'sidebar' => '#e40028',
      ],
    ],
    'ice' => [
      'title' => t('Green'),
      'colors' => [
        'top' => '#029f25',
        'bg' => '#03b72e',
        'menu_hover' => '#000000',
        'elements_color' => '#03b72d',
        'color_button' => '#000001',
        'color_button_hover' => '#202020',
        'footer' => '#2c2c28',
        'titleslogan' => '#000002',
        'text' => '#ffffff',
        'link' => '#fffff1',
        'sidebar' => '#029f26',
      ],
    ],
    'plum' => [
      'title' => t('Light Green'),
      'colors' => [
        'top' => '#7cd01b',
        'bg' => '#579c06',
        'menu_hover' => '#000000',
        'elements_color' => '#8bc34a',
        'color_button' => '#000000',
        'color_button_hover' => '#202020',
        'footer' => '#2c2c28',
        'titleslogan' => '#ffffff',
        'text' => '#ffffff',
        'link' => '#ffffff',
        'sidebar' => '#7cd01b',
      ],
    ],
    'slate' => [
      'title' => t('Orange'),
      'colors' => [
        'top' => '#ff7b15',
        'bg' => '#ad4b00',
        'menu_hover' => '#000000',
        'elements_color' => '#ff7b15',
        'color_button' => '#000000',
        'color_button_hover' => '#202020',
        'footer' => '#2c2c28',
        'titleslogan' => '#ffffff',
        'text' => '#ffffff',
        'link' => '#ffffff',
        'sidebar' => '#ff7b15',
      ],
    ],


  ],

  // CSS files (excluding @import) to rewrite with new color scheme.
  'css' => [
    'css/os-colors.css',
  ],

  // Files to copy.
  'copy' => [
    'logo.svg',
  ],

  // Gradient definitions.
  'gradients' => [
    [
      // (x, y, width, height).
      'dimension' => [0, 0, 0, 0],
      // Direction of gradient ('vertical' or 'horizontal').
      'direction' => 'vertical',
      // Keys of colors to use for the gradient.
      'colors' => ['top', 'bottom'],
    ],
  ],

  // Preview files.
  'preview_library' => 'used_cars/os-color.preview',
  'preview_html' => 'color/preview.html',

  // Attachments.
  '#attached' => [
    'drupalSettings' => [
      'color' => [
        // Put the logo path into JavaScript for the live preview.
        'logo' => theme_get_setting('logo.url', 'used_cars'),
      ],
    ],
  ],
];
