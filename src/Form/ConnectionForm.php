<?php

namespace Drupal\replicado\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ConnectionForm.
 */
class ConnectionForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'replicado.connection',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'connection_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('replicado.connection');
    $form['database_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Database Name'),
      '#maxlength' => 64,
      '#size' => 20,
      '#default_value' => $config->get('database_name'),
    ];
    $form['database_port'] = [
      '#type' => 'number',
      '#title' => $this->t('Database Port'),
      '#default_value' => $config->get('database_port'),
    ];
    $form['database_host'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Database Host'),
      '#default_value' => $config->get('database_host'),
    ];
    $form['database_user'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Database User'),
      '#default_value' => $config->get('database_user'),
    ];
    $form['database_password'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Database password'),
      '#maxlength' => 64,
      '#size' => 20,
      '#default_value' => $config->get('database_password'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('replicado.connection')
      ->set('database_name', $form_state->getValue('database_name'))
      ->set('database_port', $form_state->getValue('database_port'))
      ->set('database_host', $form_state->getValue('database_host'))
      ->set('database_user', $form_state->getValue('database_user'))
      ->set('database_password', $form_state->getValue('database_password'))
      ->save();
  }

}
