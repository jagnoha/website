<?php

namespace Drupal\theme_change\Form;

use Drupal\Component\Utility\Html;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;

class ThemeChangeListForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'theme_change_list_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $value = \Drupal::request()->query->get('value');
    $type = \Drupal::request()->query->get('type');
    $theme = \Drupal::request()->query->get('theme');
    $db_conn = \Drupal::database();
    $db_query = $db_conn->select('theme_change', 'tc');
    $db_query->fields('tc');
    if ($value) {
      $db_query->condition('value', "%" . $db_query->escapeLike($value) . "%", 'LIKE');
    }
    if ($type) {
      $db_query->condition('type', $type, '=');
    }
    if ($theme) {
      $db_query->condition('theme', $theme, '=');
    }
    $queryresult = $db_query->execute()->fetchAll(\PDO::FETCH_ASSOC);
    $headers = ['Type', 'Value', 'Theme', ''];
    $rows = [];
    foreach ($queryresult as $values) {
      $row = [];
      $row['type'] = $values['type'];
      $row['value'] = $values['value'];
      $row['theme'] = $values['theme'];
      $delete = Html::escape($base_url . '/admin/config/user-interface/theme-change/delete?value=' . $row['value']);
      $row['delete'] = Markup::create('<a href="' . $delete . '">Delete</a>');
      $rows[] = $row;
    }
    $form['type'] = [
      '#type' => 'select',
      '#title' => $this->t('Select Type'),
      '#options' => ['route' => 'Route', 'path' => 'Path'],
      '#default_value' => isset($type) ? $type : '',
    ];
    $form['route'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Route'),
      '#description' => $this->t("Enter route to change theme."),
      '#states' => [
        'visible' => ['select[name=type]' => ['value' => 'route']],
      ],
      '#default_value' => isset($value) ? $value : '',
    ];
    $form['path'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Enter Path'),
      '#description' => $this->t("Enter Path to change theme."),
      '#states' => [
        'visible' => ['select[name=type]' => ['value' => 'path']],
      ],
      '#default_value' => isset($value) ? $value : '',
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
      '#default_value' => isset($theme) ? $theme : '',
    ];
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => 'Filter',
    );
    $form['reset'] = array(
      '#type' => 'submit',
      '#value' => 'Reset',
    );
    $form['data'] = array(
      '#theme' => 'table',
      '#header' => $headers,
      '#rows' => $rows
    );
    $form['pager'] = array(
      '#type' => 'pager'
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $op = (string) $values['op'];
    // Goto current path if reset.
    if ($op == $this->t('Reset')) {
      $form_state->setRedirect('theme_change.list_page');
    }
    // Pass values to url.
    if ($op == $this->t('Filter')) {
      $type = $values['type'];
      if ($type == 'path') {
        $value = $values['path'];
        $params['value'] = Html::escape($value);
      }
      elseif ($type == 'route') {
        $value = $values['route'];
        $params['value'] = Html::escape($value);
      }
      $theme = $values['themes'];
      $params['type'] = Html::escape($type);
      $params['theme'] = Html::escape($theme);
      $form_state->setRedirect('theme_change.list_page', array($params));
    }
  }

}
