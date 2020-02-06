<?php

namespace Drupal\replicado\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class QueryEntityForm.
 */
class QueryEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $query_entity = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $query_entity->label(),
      '#description' => $this->t("Label for the Query entity."),
      '#required' => TRUE,
    ];

    $form['description'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Descrição da página'),
      '#default_value' => $query_entity->getDescription(),
    ];

    $form['sql'] = [
      '#type' => 'textarea',
      '#title' => $this->t('SQL'),
      '#default_value' => $query_entity->getSql(),
      '#required' => TRUE,
    ];

    $form['route'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Endereço'),
      '#maxlength' => 255,
      '#default_value' => $query_entity->getRoute(),
      '#description' => $this->t("Exemplo: /docentes"),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $query_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\replicado\Entity\QueryEntity::load',
      ],
      '#disabled' => !$query_entity->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $query_entity = $this->entity;
    $status = $query_entity->save();

    switch ($status) {
      case SAVED_NEW:
        $this->messenger()->addMessage($this->t('Created the %label Query entity.', [
          '%label' => $query_entity->label(),
        ]));
        break;

      default:
        $this->messenger()->addMessage($this->t('Saved the %label Query entity.', [
          '%label' => $query_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($query_entity->toUrl('collection'));
  }

}
