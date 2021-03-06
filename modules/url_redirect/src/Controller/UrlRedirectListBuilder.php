<?php

namespace Drupal\url_redirect\Controller;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of UrlRedirect.
 */
class UrlRedirectListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Label');
    $header['path'] = $this->t('Path');
    $header['redirect_path'] = $this->t('Redirect Path');
    $header['checked_for'] = $this->t('Checked for');
    $header['message'] = $this->t('Display Message');
    $header['status'] = $this->t('Status');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $this->getLabel($entity);
    $row['path'] = $entity->get_path();
    $row['redirect_path'] = $entity->get_redirect_path();
    $row['checked_for'] = $entity->get_checked_for();
    $row['message'] = $entity->get_message();
    if($entity->get_status()){
      $status = t('Enabled');
    }
    else{
      $status = t('Disabled');
    }
    $row['status'] = $status;

    // You probably want a few more properties here...

    return $row + parent::buildRow($entity);
  }

}
