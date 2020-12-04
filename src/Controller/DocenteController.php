<?php

namespace Drupal\replicado\Controller;

use Drupal\Core\Controller\ControllerBase;
use Uspdev\Replicado\DB;
use Uspdev\Replicado\Uteis;
use Uspdev\Replicado\Lattes;

/**
 * Class QueryOutputController.
 */
class DocenteController extends ControllerBase {

  /**
   * Output.
   *
   * @return string
   *   Return Hello string.
   */
  public function docente($codpes) {
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
    
    $label = 'Docente';
    $description = 'Informações do Docente';


    $content['resumo'] = Lattes::getResumoCV($codpes);
    $content['livros'] = Lattes::getLivrosPublicados($codpes);
    $content['linhas_pesquisa'] = Lattes::getLinhasPesquisa($codpes);
    $content['artigos'] = Lattes::getArtigos($codpes);

        return [
          '#theme' => 'docente',
          '#content' => $content,
          '#label' => $label,    
          '#description' => $description,  
          '#cache' => [
            'max-age' => 0,
          ],  
          '#attached' => [
            'library' => [
              'replicado/replicado',
            ],
          ],       
        ];
  }

}
