<?php

namespace Drupal\field_test\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgb_combined' widget.
 *
 * @FieldWidget(
 *   id = "rgb_combined",
 *   label = @Translation("RGB Combined Text"),
 *   field_types = {
 *     "rgb_item",
 *   }
 * )
 */
class RGBCombinedWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['value'] = [
      '#title' => $this->t('RGB Value'),
      '#type' => 'textfield',
      '#size' => 7,
      '#maxlength' => 7,
      '#default_value' => isset($items[$delta]->value) ? $items[$delta]->value : NULL,
      '#element_validate' => [
        [static::class, 'validate'],
      ],
    ];
    return $element;
  }

  /**
   * Validate the color text field.
   */
  public static function validate($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    if (strlen($value) == 0) {
      $form_state->setValueForElement($element, '');
      return;
    }
    // Validate the color value.
    if (!preg_match('/^#([a-f0-9]{6})$/iD', strtolower($value))) {
      $form_state->setError($element, t("Color must be a 7-digit hexadecimal value, suitable for CSS(#000000-#ffffff)."));
    }
  }

}
