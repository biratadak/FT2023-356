<?php

namespace Drupal\field_test\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'RGB Color Formatter' formatter.
 *
 * @FieldFormatter(
 *   id = "rgb_color",
 *   label = @Translation("RGB color Formatter"),
 *   field_types = {
 *     "rgb_item",
 *   }
 * )
 */
class RGBColorFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    foreach ($items as $delta => $item) {
      // Render output using rgb_default theme.
      $source = [
        '#theme' => 'rgb_default',
        '#value' => $item->value,
      ];
      $elements[$delta] = ['#markup' => \Drupal::service('renderer')->render($source)];
    }
    return $elements;
  }

}
