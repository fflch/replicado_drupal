<?php

namespace Drupal\replicado;

use Drupal\Core\Config\Entity\ConfigEntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Provides a listing of Query entity entities.
 */
class QueryEntityListBuilder extends ConfigEntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['label'] = $this->t('Consulta');
    $header['route'] = $this->t('Endereço');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['label'] = $entity->label();
    $row['route'] = "/listas".$entity->getRoute();
    // You probably want a few more properties here...
    return $row + parent::buildRow($entity);
  }

}
