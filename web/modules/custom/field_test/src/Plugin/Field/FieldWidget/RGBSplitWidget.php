<?php

namespace Drupal\field_test\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'rgb_split' widget.
 *
 * @FieldWidget(
 *   id = "rgb_split",
 *   label = @Translation("RGB Split Text"),
 *   field_types = {
 *     "rgb_item",
 *   }
 * )
 */
class RGBSplitWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element['red'] = [
      '#title' => $this->t('Red Value'),
      '#type' => 'textfield',
      '#size' => 3,
      '#maxlength' => 3,
      '#default_value' => isset($items[$delta]->value) ? substr($items[$delta]->value, 0, 3) : NULL,
      '#element_validate' => [
        [static::class, 'validate'],
      ],
    ];
    $element['green'] = [
      '#title' => $this->t('Green Value'),
      '#type' => 'textfield',
      '#size' => 3,
      '#maxlength' => 3,
      '#default_value' => isset($items[$delta]->value) ? "#" . substr($items[$delta]->value, 3, 2) : NULL,
      '#element_validate' => [
        [static::class, 'validate'],
      ],
    ];
    $element['blue'] = [
      '#title' => $this->t('Blue Value'),
      '#type' => 'textfield',
      '#size' => 3,
      '#maxlength' => 3,
      '#default_value' => isset($items[$delta]->value) ? "#" . substr($items[$delta]->value, 5, 2) : NULL,
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
    // If value is empty return.
    if (strlen($value) == 0) {
      $form_state->setValueForElement($element, '');
      return;
    }
    // Validate the color value.
    if (!preg_match('/^#([a-f0-9]{2})$/iD', strtolower($value))) {
      $form_state->setError($element, t("Color must be a 2-digit hexadecimal value, suitable for CSS(#00-#ff)."));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function massageFormValues(array $values, array $form, FormStateInterface $form_state) {
    // Combining and storng splitted values into one variable.
    foreach ($values as $key => $value) {
      $values[$key]['value'] = $value['red'] . substr($value['green'], 1,) . substr($value['blue'], 1,);
    }
    return $values;
  }

}
