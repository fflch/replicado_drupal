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
    $build['consulta'] = array(
      '#theme' => 'consulta',
      '#content' => $consulta,           
    );
    return $build;
  }

}
