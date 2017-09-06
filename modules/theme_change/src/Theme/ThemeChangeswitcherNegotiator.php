<?php

namespace Drupal\theme_change\Theme;

use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Theme\ThemeNegotiatorInterface;

class ThemeChangeswitcherNegotiator implements ThemeNegotiatorInterface {

  public function applies(RouteMatchInterface $route_match) {
    $applies = FALSE;
    // Get Current Path.
    $current_path = \Drupal::service('path.current')->getPath();
    // Get Alias of path.
    $pathAlias = \Drupal::service('path.alias_manager')->getAliasByPath($current_path);
    // Get Current Route name.
    $route_name = \Drupal::routeMatch()->getRouteName();
    // Get All route names.
    $routes = $this->_get_route_names();
    // Get all path values.
    $paths = $this->_get_path_values();
    // Get all wildcard path values.
    $wildcard_paths = $this->_get_path_wildcard_values();
    foreach ($wildcard_paths as $wildcard_path) {
      $path_matches = \Drupal::service('path.matcher')->matchPath($current_path, $wildcard_path);
      if ($path_matches) {
        $wilcard = TRUE;
      }
    }
    if ($routes && in_array($route_name, $routes)) {
      $applies = TRUE;
    }
    else if ($paths && (in_array($current_path, $paths) || in_array($pathAlias, $paths))) {
      $applies = TRUE;
    }
    else if ($wilcard) {
      $applies = TRUE;
    }
    // Use this theme negotiator.
    return $applies;
  }

  /**
   * {@inheritdoc}
   */
  public function determineActiveTheme(RouteMatchInterface $route_match) {
    $current_path = \Drupal::service('path.current')->getPath();
    // Get Alias of path.
    $pathAlias = \Drupal::service('path.alias_manager')->getAliasByPath($current_path);
    // Get Current Route name.
    $route_name = \Drupal::routeMatch()->getRouteName();
    // Get All route names.
    $routes = $this->_get_route_names();
    // Get all path values.
    $paths = $this->_get_path_values(); // Get all wildcard path values.
    $wildcard_paths = $this->_get_path_wildcard_values();
    foreach ($wildcard_paths as $wildcard_path) {
      $path_matches = \Drupal::service('path.matcher')->matchPath($current_path, $wildcard_path);
      if ($path_matches) {
        $wilcard = TRUE;
        $wilcard_theme = $wildcard_path;
        break;
      }
    }
    if ($routes && in_array($route_name, $routes)) {
      $theme = $this->_get_theme($route_name);
      return $theme;
    }
    else if ($paths && (in_array($current_path, $paths) || in_array($pathAlias, $paths))) {
      if ($current_path) {
        $theme = $this->_get_theme($current_path);
        return $theme;
      }
      elseif ($pathAlias) {
        $theme = $this->_get_theme($current_path);
        return $theme;
      }
    }
    else if ($wilcard && $wilcard_theme) {
      $theme = $this->_get_theme($wilcard_theme);
      return $theme;
    }
  }

  /**
   * Get all route name(s).
   */
  public function _get_route_names() {
    $db_conn = \Drupal::database();
    $query = $db_conn->select('theme_change', 'tc');
    $query->fields('tc', ['value']);
    $query->condition('type', 'route', '=');
    $result = $query->execute()->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($result as $value) {
      $routes[$value['value']] = $value['value'];
    }
    return $routes;
  }

  /**
   * Get all path value(s).
   */
  public function _get_path_values() {
    $db_conn = \Drupal::database();
    $query = $db_conn->select('theme_change', 'tc');
    $query->fields('tc', ['value']);
    $query->condition('type', 'path', '=');
    $result = $query->execute()->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($result as $value) {
      $paths[$value['value']] = $value['value'];
    }
    return $paths;
  }

  /**
   * Get all wildcard path value(s).
   */
  public function _get_path_wildcard_values() {
    $db_conn = \Drupal::database();
    $query = $db_conn->select('theme_change', 'tc');
    $query->fields('tc', ['value']);
    $query->condition('type', 'path', '=');
    $db_or = $query->orConditionGroup();
    $db_or->condition('value', "%" . $query->escapeLike('/*') . "%", 'LIKE');
    $db_or->condition('value', "%" . $query->escapeLike('/%') . "%", 'LIKE');
    $query->condition($db_or);
    $result = $query->execute()->fetchAll(\PDO::FETCH_ASSOC);
    foreach ($result as $value) {
      $paths[$value['value']] = $value['value'];
    }
    return $paths;
  }

  /**
   * Get theme based on path/route.
   */
  public function _get_theme($value) {
    $db_conn = \Drupal::database();
    $query = $db_conn->select('theme_change', 'tc');
    $query->fields('tc', ['theme']);
    $query->condition('value', $value, '=');
    $theme = $query->execute()->fetchField();
    return $theme;
  }

}
