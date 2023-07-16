<?php

namespace Drupal\custom_config_form\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Form\FormBase;

/**
 * Creates a generic form with form validation.
 */
class CustomConfigForm extends FormBase {

  /**
   * @inheritDoc
   */
  public function getFormId() {
    return 'Custom_form';
  }

  /**
   * @inheritDoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type'      => 'textfield',
      '#title'     => 'FullName',
      '#maxlength' => 64,
      '#size'      => 64,
      '#weight'    => '0',
    ];

    $form['phone'] = [
      '#type'   => 'tel',
      '#title'  => 'Phone Number',
      '#weight' => '0',
    ];

    $form['email'] = [
      '#type'   => 'email',
      '#title'  => 'E-mail',
      '#weight' => '0',
    ];

    $form['gender'] = [
      '#type' => 'radios',
      '#title' => $this
        ->t('Gender'),
      '#default_value' => 1,
      '#options' => [
        1 => $this
          ->t('Male'),
        2 => $this
          ->t('Female'),
      ],
    ];

    $form['submit'] = [
      '#type'  => 'submit',
      '#value' => $this->t('SUBMIT'),
    ];
    return $form;
  }

  /**
   * @inheritDoc
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Validation for empty fields.
    foreach ($form_state->getValues() as $key => $val) {
      if (empty($val)) {
        $form_state->setErrorByName($key, $this->t("%key shouldn\'t be empty", ['%key' => $key]));
      }
    }

    // Validating mail id.
    $mailId = $form_state->getValue('email');
    if (!\Drupal::service('email.validator')->isValid($mailId)) {
      $form_state->setErrorByName('email', t('The email address %mail is not valid.', ['%mail' => $mailId]));
    }
    elseif (!preg_match("/^[a-z]{2,}@(yahoo|gmail|yahoo).com$/", $mailId)) {
      $form_state->setErrorByName('email', t('Only yahoo, gmail and outlook are allowed', ['%mail' => $mailId]));
    }

    // Validating phone no.
    $phoneNo = $form_state->getValue('phone');
    if (!preg_match("/^[6-9][0-9]{9}$/", $phoneNo)) {
      $form_state->setErrorByName('phone', t('The phone number %phone is not valid.', ['%phone' => $phoneNo]));
    }
  }

  /**
   * @inheritDoc
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage(t('Form submitted successfully'));
  }

}
