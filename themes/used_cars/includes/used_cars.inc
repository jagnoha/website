<?php

/**
 * @file
 * Used_cars.inc.
 *
 * Filename:     used_cars.inc
 * Website:      http://www.ordasoft.com
 * Description:  template
 * Author:       ordasoft dev team ordasoft.com.
 */

/**
 * Get theme functionalities.
 */
function used_cars_get_theme(&$variables) {
  used_cars_load_debuggers($variables);
  used_cars_add_libraries();
}

/**
 * Get the path to the static files folder in the theme.
 */
function used_cars_get_staticpath($addprefix = FALSE, $theme_key = 'used_cars') {
  $ret = '';
  if ($addprefix) {
    $ret = '/';
  }
  $ret .= drupal_get_path('theme', $theme_key) . '/static/';
  return $ret;
}

/**
 * Add meta tags to the html header.
 */
function used_cars_add_head_items() {
  $viewport = theme_get_setting('ft_viewport');
  if (!empty($viewport)) {
    $user_scalable = theme_get_setting('ft_viewport_user_scaleable');
    $initial_scale = theme_get_setting('ft_viewport_initial_scale');
    $minimum_scale = theme_get_setting('ft_viewport_minimum_scale');
    $maximum_scale = theme_get_setting('ft_viewport_maximum_scale');
    $content = "width=device-width, initial-scale=" . $initial_scale . ", minimum-scale=" . $minimum_scale . ", maximum-scale=" . $maximum_scale . ", user-scalable=" . $user_scalable;
    $element = [
      '#tag' => 'meta',
      '#attributes' => [
        'name' => 'viewport',
        'content' => $content,
      ],
    ];
    drupal_add_html_head($element, 'ft-viewport');
  }

  $cleartype = theme_get_setting('ft_cleartype');
  if (!empty($cleartype)) {
    $meta = [
      '#tag' => 'meta',
      '#attributes' => ['http-equiv' => 'cleartype', 'content' => 'on'],
    ];

    drupal_add_html_head($meta, 'ft-cleartype');
  }
}
