<?php

namespace Drupal\replicado\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Query entity entity.
 *
 * @ConfigEntityType(
 *   id = "query_entity",
 *   label = @Translation("Consulta"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\replicado\QueryEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\replicado\Form\QueryEntityForm",
 *       "edit" = "Drupal\replicado\Form\QueryEntityForm",
 *       "delete" = "Drupal\replicado\Form\QueryEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\replicado\QueryEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "query_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/replicado/queries/query_entity/{query_entity}",
 *     "add-form" = "/admin/config/replicado/queries/query_entity/add",
 *     "edit-form" = "/admin/config/replicado/queries/query_entity/{query_entity}/edit",
 *     "delete-form" = "/admin/config/replicado/queries/query_entity/{query_entity}/delete",
 *     "collection" = "/admin/config/replicado/queries/query_entity"
 *   }
 * )
 */
class QueryEntity extends ConfigEntityBase implements QueryEntityInterface {

  /**
   * The Query entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Query entity label.
   *
   * @var string
   */
  protected $label;
  protected $sql;
  protected $route;
  protected $description;

  public function setSql($sql) {
    $this->sql = $sql;
  }

  public function getSql() {
    return $this->sql;
  }

  public function setRoute($route) {
    $this->route = $route;
  }

  public function getRoute() {
    return $this->route;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function getDescription() {
    return $this->description;
  }

}
