<?php

namespace Drupal\menu_test\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Creates a config form for storing movie budget.
 */
class MovieBudgetForm extends ConfigFormBase {
  const SETTINGS = 'movie_test.movie_budget';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'movie_budget_form';
  }

  /**
   * {@inheritdoc}
   */
  public function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);

    $form['movie_budget'] = [
      '#type' => 'number',
      '#title' => $this->t('Movie Budget'),
      '#default_value' => $config->get('movie_budget'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);
    $config->set('movie_budget', $form_state->getValue('movie_budget'));
    \Drupal::messenger()->addMessage('Movie budget updated successfully.');
    $config->save();
  }

}
