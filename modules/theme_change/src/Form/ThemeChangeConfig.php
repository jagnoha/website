<?php

namespace Drupal\theme_change\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure paths for Theme Change.
 */
class ThemeChangeConfig extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'theme_change_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['type'] = [
      '#type' => 'select',
      '#title' => $this->t('Select Route/Path'),
      '#options' => ['route' => 'Route', 'path' => 'Path'],
    ];
    $form['route'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Route'),
      '#description' => $this->t("Enter route to change theme."),
      '#states' => [
        'visible' => ['select[name=type]' => ['value' => 'route']],
      ],
    ];
    $form['path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Path'),
      '#description' => $this->t("Enter Path to change theme. And also Supports wildcards like(user/*, node/*)"),
      '#states' => [
        'visible' => ['select[name=type]' => ['value' => 'path']],
      ],
    ];
    $list_themes = [];
    $themes = \Drupal::service('theme_handler')->listInfo();
    foreach ($themes as $key => $value) {
      $list_themes[$key] = \Drupal::service('theme_handler')->getName($key);
    }
    $form['themes'] = [
      '#type' => 'select',
      '#title' => $this->t('Select Theme'),
      '#options' => $list_themes,
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    $route = $form_state->getValue('route');
    $path = $form_state->getValue('path');
    $type = $form_state->getValue('type');
    $route_provider = \Drupal::service('router.route_provider');
    $exists = count($route_provider->getRoutesByNames([$route])) === 1;
    // If no route exists.
    if ($type == 'route' && $route && !$exists) {
      $form_state->setErrorByName('route', $this->t('%route Route Doesnot exists', ['%route' => $route]));
    }
    // If type is route and path value is filled.
    if ($type == 'route' && !$route && $path) {
      $form_state->setErrorByName('type', $this->t("Select type as Path"));
    }
    // If type is path and route value is filled.
    if ($type == 'path' && !$path && $route) {
      $form_state->setErrorByName('type', $this->t("Select type as Route"));
    }
    // If route and path values are not filled.
    if (!$route && !$path) {
      $form_state->setErrorByName('route', $this->t('Route/Path Required'));
      $form_state->setErrorByName('path');
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $type = $form_state->getValue('type');
    $route = $form_state->getValue('route');
    $theme = $form_state->getValue('themes');
    $path = $form_state->getValue('path');
    if (substr($path, 0, 1) != "/") {
      $path = '/' . $path;
    }
    if ($route && $type == 'route') {
      $value = $route;
    }
    else if ($path && $type == 'path') {
      $value = $path;
    }
    $db_conn = \Drupal::database();
    $db_conn->merge('theme_change')
        ->key(
            array(
              'value' => $value,
        ))
        ->fields(
            array(
              'type' => $type,
              'theme' => $theme,
            )
        )->execute();
    drupal_set_message($this->t("The configuration have been saved."));
  }

}
