<?php

declare(strict_types=1);

namespace Drupal\database_test\Form;

use Drupal\Core\Cache\Cache;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a My Form form.
 */
final class MyForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'my_form_my';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {

    $form['field_taxonomy_tags'] = [
      '#type' => 'entity_autocomplete',
      '#target_type' => 'taxonomy_term',
      '#selection_settings' => [
        'target_bundles' => ['event_types'],
      ],
      '#title' => ('Taxonomy terms'),
    ];

    $form['actions'] = [
      '#type'  => 'actions',
      'submit' => [
        '#type'  => 'submit',
        '#value' => $this->t('Save'),
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    try {
      $tid = $form_state->getValue('field_taxonomy_tags');
      \Drupal::messenger()->addMessage($this->t('Data Retrived Successfully.'));
      Cache::invalidateTags(['tax-page']);
      $form_state->setRedirect('database_test.taxonomy_details_page', ['tid' => $tid]);
    }
    catch (\Exception $ex) {
      \Drupal::logger('taxonomy-form')->error($ex->getMessage());
    }
  }

}
