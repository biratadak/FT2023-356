<?php

namespace Drupal\hook_test\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Creates a simple form using FromBase class.
 */
class HookTest extends FormBase {

  /**
   * Returns id of the form.
   */
  public function getFormId() {
    return 'myFormId';
  }

  /**
   * Builds the form fields.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => '',
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('SUBMIT'),
    ];
    return $form;
  }

  /**
   * Displays the submitted results.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    \Drupal::messenger()->addMessage('YOUR SUBMITTED VALUES ,');
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . $value);
    }
  }

}
