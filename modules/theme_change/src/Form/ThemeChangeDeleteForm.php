<?php

namespace Drupal\theme_change\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ThemeChangeDeleteForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'theme_change_delete_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $db_conn = \Drupal::database();
    $value = \Drupal::request()->query->get('value');
    if ($value != '') {
      $date = date('Y-m-d', $from_date);
      $delete_query = $db_conn->select('theme_change', 'tc');
      $delete_query->fields('tc', array('value'));
      $delete_query->condition('value', $value);
      $delete_result = $delete_query->execute()->fetchAll();
      if ($delete_result) {
        $form['date_markup'] = array(
          '#markup' => t('Are you sure to delete <b>:value</b>?', array(':value' => $value)),
        );
        $form['value'] = array(
          '#type' => 'hidden',
          '#value' => $value,
        );
        $form['delete'] = array(
          '#type' => 'submit',
          '#value' => t('Yes'),
        );
        $form['no'] = array(
          '#type' => 'submit',
          '#value' => t('No'),
        );
      }
      else {
        $form['value'] = array(
          '#markup' => t('Unable to delete :value as it was not found.', array(':value' => $value)),
        );
        $form['return'] = array(
          '#type' => 'submit',
          '#value' => t('Return'),
        );
      }
      return $form;
    }
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
    $db_conn = \Drupal::database();
    $op = (string) $values['op'];
    // Delete Value.
    if ($op == $this->t('Yes')) {
      $db_conn->delete('theme_change')
          ->condition('value', $values['value'])
          ->execute();
      drupal_set_message(t('Selected Route/Path deleted'));
      $form_state->setRedirect('theme_change.list_page');
    }
    // Go-to Listing Page.
    if (($op == $this->t('No')) || ($op == $this->t('Return'))) {
      $form_state->setRedirect('theme_change.list_page');
    }
  }

}
