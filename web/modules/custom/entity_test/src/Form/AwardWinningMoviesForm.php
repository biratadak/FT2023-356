<?php

declare(strict_types = 1);

namespace Drupal\entity_test\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Award winning movies form.
 */
final class AwardWinningMoviesForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state): array {

    $form = parent::form($form, $form_state);

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Award Title'),
      '#maxlength' => 255,
      '#default_value' => $this->entity->label(),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $this->entity->id(),
      '#machine_name' => [
        'exists' => [$this, 'checkExistance'],
      ],
      '#disabled' => !$this->entity->isNew(),
    ];

    $form['status'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enabled'),
      '#default_value' => $this->entity->status(),
    ];

    $form['movie'] = [
      '#type' => 'entity_autocomplete',
      '#required' => TRUE,
      '#target_type' => 'node',
      '#selection_handler' => 'default:node',
      '#selection_settings' => [
        'target_bundles' => ['movie'],
      ],
      '#title' => $this->t('movie'),
      '#default_value' => \Drupal::entityTypeManager()->getStorage('node')->load($this->entity->get('movie') ?? ''),
    ];

    $form['movie_year'] = [
      '#type' => 'date',
      '#title' => $this->t('Year of award'),
      '#default_value' => $this->entity->get('movie_year'),
      '#required' => TRUE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): int {
    $result = parent::save($form, $form_state);
    $message_args = ['%label' => $this->entity->label()];
    $this->messenger()->addStatus(
      match($result) {
        \SAVED_NEW => $this->t('Created new Award config %label.', $message_args),
        \SAVED_UPDATED => $this->t('Updated Awards config %label.', $message_args),
      }
    );
    $form_state->setRedirectUrl($this->entity->toUrl('collection'));
    return $result;
  }

  /**
   * Checking existance of machine name for the award winning entities.
   */
  public function checkExistance($id) {
    return \Drupal::entityTypeManager()->getStorage('award_winning_movies')
      ->getQuery()
      ->condition('id', $id)
      ->execute();

  }

}
