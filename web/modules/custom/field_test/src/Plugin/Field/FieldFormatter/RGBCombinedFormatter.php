<?php

namespace Drupal\field_test\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'RGB Combined' formatter.
 *
 * @FieldFormatter(
 *   id = "rgb_combined",
 *   label = @Translation("RGB Combined Formatter"),
 *   field_types = {
 *     "rgb_item",
 *   }
 * )
 */
class RGBCombinedFormatter extends FormatterBase {

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
