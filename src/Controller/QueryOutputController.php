<?php

namespace Drupal\replicado\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class QueryOutputController.
 */
class QueryOutputController extends ControllerBase {

  /**
   * Output.
   *
   * @return string
   *   Return Hello string.
   */
  public function output($consulta) {

    $a = \Drupal::entityTypeManager()->getStorage('query_entity');

    $build['consulta'] = array(
      '#title' => 'teste',
      '#theme' => 'consulta',
      '#content' => $consulta,           
    );
    return $build;
  }

}
