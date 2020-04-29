<?php

namespace Drupal\replicado\Controller;

use Drupal\Core\Controller\ControllerBase;
use Uspdev\Replicado\DB;
use Uspdev\Replicado\Uteis;

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
  public function output($route) {


    /*** 1. Conexão com o banco de dados ***/
    $config = \Drupal::service('config.factory')->getEditable('replicado.connection');
    $database_name = $config->get('database_name');
    $database_port = $config->get('database_port');
    $database_host = $config->get('database_host');
    $database_user = $config->get('database_user');
    $database_password = $config->get('database_password');

    /* TODO: Verificar se conexação ok */
    putenv("REPLICADO_HOST={$database_host}");
    putenv("REPLICADO_PORT={$database_port}");
    putenv("REPLICADO_DATABASE={$database_name}");
    putenv("REPLICADO_USERNAME={$database_user}");
    putenv("REPLICADO_PASSWORD={$database_password}");

    /*** 2. Buscar query para rota dada ***/
    $storage = \Drupal::entityTypeManager()->getStorage('query_entity'); 
    $nids = \Drupal::entityQuery('query_entity')->condition('route', '/'.$route, '=')->execute();

    foreach($nids as $nid) {
        /*só vou entrar uma vez aqui*/

        $entity = $storage->load($nid); 
        $query = $entity->getSql();

        if (
            (strpos(strtoupper($query), 'DROP') !== false) or
            (strpos(strtoupper($query), 'CREATE') !== false) or
            (strpos(strtoupper($query), 'SELECT') === false) or
            (strpos($query, ';') !== false)
        ) {
          drupal_set_message(t('SQL inseguro'), 'error');
          break;
        }

        $label = $entity->label();
        $description = $entity->getDescription();

        /*** 3. Executa query ***/    
        $result = DB::fetchAll($query);
        $result = Uteis::utf8_converter($result);
        //echo "<pre>"; var_dump($result); die();

        return [
          '#theme' => 'replicado',
          '#content' => $result,
          '#label' => $label,    
          '#description' => $description,  
          '#cache' => [
            'max-age' => 86400,
          ],  
          '#attached' => [
            'library' => [
              'replicado/replicado',
            ],
          ],       
        ];
    }

    return [
      '#markup' => $this->t('Consulta desconhecida'),
    ];
    
  }

}
